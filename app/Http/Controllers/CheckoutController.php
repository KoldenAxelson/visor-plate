<?php

namespace App\Http\Controllers;

use App\Jobs\SendOrderConfirmationEmail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;

class CheckoutController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config("services.stripe.secret"));
    }

    /**
     * Create Stripe Checkout Session (US-ONLY)
     */
    public function createCheckoutSession(Request $request)
    {
        $request->validate([
            "quantity" => "required|integer|min:1|max:100",
        ]);

        $quantity = $request->quantity;
        $pricePerUnit = 3500; // $35.00 in cents
        $totalAmount = $pricePerUnit * $quantity;

        try {
            $checkoutSession = StripeSession::create([
                "payment_method_types" => ["card"],
                "line_items" => [
                    [
                        "price_data" => [
                            "currency" => "usd",
                            "product_data" => [
                                "name" =>
                                    "VisorPlate - Premium No-Drill License Plate Holder",
                                "description" =>
                                    "Velcro visor-mounted front license plate holder",
                                "images" => [asset("images/Display.jpg")],
                            ],
                            "unit_amount" => $pricePerUnit,
                        ],
                        "quantity" => $quantity,
                    ],
                ],
                "mode" => "payment",
                "success_url" =>
                    route("checkout.success") .
                    "?session_id={CHECKOUT_SESSION_ID}",
                "cancel_url" => route("checkout.cancel"),

                // ⚠️ US-ONLY RESTRICTIONS
                // Require billing address and restrict to US only
                "billing_address_collection" => "required",

                // Restrict shipping addresses to US only
                "shipping_address_collection" => [
                    "allowed_countries" => ["US"],
                ],

                "customer_email" => $request->email ?? null,
                "metadata" => [
                    "quantity" => $quantity,
                ],
            ]);

            return response()->json([
                "id" => $checkoutSession->id,
                "url" => $checkoutSession->url,
            ]);
        } catch (\Exception $e) {
            // Add context for Flare error tracking
            context([
                "error_type" => "stripe_checkout_creation",
                "quantity" => $quantity,
                "total_amount" => $totalAmount,
                "customer_email" => $request->email ?? null,
            ]);

            Log::error(
                "Stripe checkout session creation failed: " . $e->getMessage(),
            );

            return response()->json(
                [
                    "error" =>
                        "Unable to create checkout session. Please try again.",
                ],
                500,
            );
        }
    }

    /**
     * Success page after payment
     */
    public function success(Request $request)
    {
        $sessionId = $request->query("session_id");

        if (!$sessionId) {
            return redirect()->route("shop");
        }

        try {
            // Retrieve the session from Stripe
            $session = StripeSession::retrieve($sessionId);

            // Get shipping details from either location (Stripe API changed this)
            $shippingDetails =
                $session->shipping_details ??
                ($session->collected_information->shipping_details ?? null);

            // Double-check US-only (extra safety net)
            if (
                $shippingDetails &&
                $shippingDetails->address->country !== "US"
            ) {
                Log::warning("Non-US order attempted: " . $sessionId);
                return redirect()
                    ->route("shop")
                    ->with("error", "We only ship within the United States.");
            }

            // Find or create the order
            $order = Order::firstOrCreate(
                ["stripe_checkout_session_id" => $sessionId],
                [
                    "email" => $session->customer_details->email,
                    "name" => $session->customer_details->name,
                    "quantity" => $session->metadata->quantity ?? 1,
                    "amount_cents" => $session->amount_total,
                    "status" =>
                        $session->payment_status === "paid"
                            ? "completed"
                            : "pending",
                    "shipping_address" => $shippingDetails
                        ? [
                            "name" => $shippingDetails->name,
                            "line1" => $shippingDetails->address->line1,
                            "line2" => $shippingDetails->address->line2 ?? "",
                            "city" => $shippingDetails->address->city,
                            "state" => $shippingDetails->address->state,
                            "postal_code" =>
                                $shippingDetails->address->postal_code,
                            "country" => $shippingDetails->address->country,
                        ]
                        : null,
                ],
            );

            return view("checkout.success", [
                "order" => $order,
                "session" => $session,
            ]);
        } catch (\Exception $e) {
            // Add context for Flare error tracking
            context([
                "error_type" => "checkout_success_page",
                "stripe_session_id" => $sessionId,
            ]);

            Log::error(
                "Error retrieving checkout session: " . $e->getMessage(),
            );

            return redirect()
                ->route("shop")
                ->with("error", "Unable to retrieve order details.");
        }
    }

    /**
     * Cancel page when user cancels checkout
     */
    public function cancel()
    {
        return view("checkout.cancel");
    }

    /**
     * Stripe webhook handler
     *
     * IMPORTANT: This endpoint must be excluded from CSRF protection
     * Add to app/Http/Middleware/VerifyCsrfToken.php:
     * protected $except = [
     *     'stripe/webhook',
     * ];
     */
    public function webhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header("Stripe-Signature");
        $webhookSecret = config("services.stripe.webhook_secret");

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sigHeader,
                $webhookSecret,
            );
        } catch (SignatureVerificationException $e) {
            // Add context for security monitoring
            context([
                "error_type" => "webhook_signature_verification",
                "ip_address" => $request->ip(),
                "user_agent" => $request->userAgent(),
                "payload_size" => strlen($payload),
            ]);

            Log::error(
                "Webhook signature verification failed: " . $e->getMessage(),
            );

            return response()->json(["error" => "Invalid signature"], 400);
        }

        // Handle the event
        switch ($event->type) {
            case "checkout.session.completed":
                $this->handleCheckoutSessionCompleted($event->data->object);
                break;

            case "payment_intent.succeeded":
                $this->handlePaymentIntentSucceeded($event->data->object);
                break;

            case "payment_intent.payment_failed":
                $this->handlePaymentIntentFailed($event->data->object);
                break;

            default:
                Log::info("Unhandled webhook event: " . $event->type);
        }

        return response()->json(["status" => "success"]);
    }

    /**
     * Handle successful checkout session
     */
    private function handleCheckoutSessionCompleted($session)
    {
        try {
            Log::info("Checkout session completed: " . $session->id);

            // Retrieve full session with expanded data to ensure we have all details
            $fullSession = StripeSession::retrieve([
                "id" => $session->id,
                "expand" => ["customer", "line_items"],
            ]);

            // Get shipping details from either location (Stripe API changed this)
            // New API uses collected_information->shipping_details
            // Old API uses shipping_details directly
            $shippingDetails =
                $fullSession->shipping_details ??
                ($fullSession->collected_information->shipping_details ?? null);

            // Verify US-only before saving order (safety net)
            if (
                $shippingDetails &&
                $shippingDetails->address->country !== "US"
            ) {
                Log::error(
                    "Non-US order blocked in webhook: " . $fullSession->id,
                );
                // Don't save the order, don't send confirmation email
                return;
            }

            // Prepare shipping address data
            $shippingAddress = null;
            if ($shippingDetails) {
                $shippingAddress = [
                    "name" => $shippingDetails->name,
                    "line1" => $shippingDetails->address->line1,
                    "line2" => $shippingDetails->address->line2 ?? "",
                    "city" => $shippingDetails->address->city,
                    "state" => $shippingDetails->address->state,
                    "postal_code" => $shippingDetails->address->postal_code,
                    "country" => $shippingDetails->address->country,
                ];
            }

            // Log shipping address for debugging
            Log::info("Shipping details from webhook", [
                "session_id" => $fullSession->id,
                "has_shipping_details" => !is_null($shippingDetails),
                "shipping_address" => $shippingAddress,
            ]);

            // Use updateOrCreate to handle both creation AND updates
            // This fixes race condition where success page creates order first
            $order = Order::updateOrCreate(
                ["stripe_checkout_session_id" => $fullSession->id],
                [
                    "stripe_payment_intent_id" => $fullSession->payment_intent,
                    "email" => $fullSession->customer_details->email,
                    "name" => $fullSession->customer_details->name,
                    "quantity" => $fullSession->metadata->quantity ?? 1,
                    "amount_cents" => $fullSession->amount_total,
                    "status" => "completed",
                    "shipping_address" => $shippingAddress,
                    "completed_at" => now(),
                ],
            );

            // Send email for completed orders that haven't been shipped
            // (Handles both new orders and webhook retries safely)
            if ($order->status === "completed" && !$order->shipped_at) {
                $this->sendOrderConfirmationEmail($order);
            }
        } catch (\Exception $e) {
            // Add detailed context for order creation errors
            context([
                "error_type" => "webhook_order_creation",
                "stripe_session_id" => $session->id,
                "stripe_payment_intent" => $session->payment_intent ?? null,
                "customer_email" => $session->customer_details->email ?? null,
                "amount_cents" => $session->amount_total ?? null,
                "quantity" => $session->metadata->quantity ?? null,
            ]);

            Log::error(
                "Failed to process checkout session completed: " .
                    $e->getMessage(),
            );

            // Re-throw so Stripe knows it failed and will retry
            throw $e;
        }
    }

    /**
     * Handle successful payment intent
     */
    private function handlePaymentIntentSucceeded($paymentIntent)
    {
        try {
            Log::info("Payment intent succeeded: " . $paymentIntent->id);

            $order = Order::where(
                "stripe_payment_intent_id",
                $paymentIntent->id,
            )->first();

            if ($order && $order->status !== "completed") {
                $order->markAsCompleted();
            }
        } catch (\Exception $e) {
            // Add context for payment success tracking
            context([
                "error_type" => "payment_intent_succeeded",
                "stripe_payment_intent" => $paymentIntent->id,
                "amount" => $paymentIntent->amount ?? null,
            ]);

            Log::error(
                "Failed to mark order as completed: " . $e->getMessage(),
            );

            // Don't throw - this is not critical enough to fail the webhook
        }
    }

    /**
     * Handle failed payment intent
     */
    private function handlePaymentIntentFailed($paymentIntent)
    {
        try {
            Log::error("Payment intent failed: " . $paymentIntent->id);

            $order = Order::where(
                "stripe_payment_intent_id",
                $paymentIntent->id,
            )->first();

            if ($order) {
                $order->update(["status" => "failed"]);
            }
        } catch (\Exception $e) {
            // Add context for payment failure tracking
            context([
                "error_type" => "payment_intent_failed",
                "stripe_payment_intent" => $paymentIntent->id,
                "failure_reason" =>
                    $paymentIntent->last_payment_error->message ?? null,
            ]);

            Log::error(
                "Failed to update failed payment status: " . $e->getMessage(),
            );
        }
    }

    /**
     * Send order confirmation email (queued)
     */
    private function sendOrderConfirmationEmail(Order $order)
    {
        try {
            SendOrderConfirmationEmail::dispatch($order);

            Log::info("Order confirmation email queued for: " . $order->email);
        } catch (\Exception $e) {
            // Add context for email queue failures
            context([
                "error_type" => "email_queue_failed",
                "order_id" => $order->id,
                "customer_email" => $order->email,
            ]);

            Log::error(
                "Failed to queue confirmation email: " . $e->getMessage(),
            );

            // Don't throw - order is already created, email failure shouldn't stop webhook
        }
    }
}
