<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
     * Create Stripe Checkout Session
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
                                "images" => [asset("images/Display.jpg")], // Optional: show product image
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
                "shipping_address_collection" => [
                    "allowed_countries" => ["US"], // US-only shipping
                ],
                "customer_email" => $request->email ?? null, // Pre-fill if provided
                "metadata" => [
                    "quantity" => $quantity,
                ],
            ]);

            return response()->json([
                "id" => $checkoutSession->id,
                "url" => $checkoutSession->url,
            ]);
        } catch (\Exception $e) {
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
                    "shipping_address" => $session->shipping_details
                        ? [
                            "name" => $session->shipping_details->name,
                            "line1" =>
                                $session->shipping_details->address->line1,
                            "line2" =>
                                $session->shipping_details->address->line2,
                            "city" => $session->shipping_details->address->city,
                            "state" =>
                                $session->shipping_details->address->state,
                            "postal_code" =>
                                $session->shipping_details->address
                                    ->postal_code,
                            "country" =>
                                $session->shipping_details->address->country,
                        ]
                        : null,
                ],
            );

            return view("checkout.success", [
                "order" => $order,
                "session" => $session,
            ]);
        } catch (\Exception $e) {
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
        Log::info("Checkout session completed: " . $session->id);

        $order = Order::firstOrCreate(
            ["stripe_checkout_session_id" => $session->id],
            [
                "stripe_payment_intent_id" => $session->payment_intent,
                "email" => $session->customer_details->email,
                "name" => $session->customer_details->name,
                "quantity" => $session->metadata->quantity ?? 1,
                "amount_cents" => $session->amount_total,
                "status" => "completed",
                "shipping_address" => $session->shipping_details
                    ? [
                        "name" => $session->shipping_details->name,
                        "line1" => $session->shipping_details->address->line1,
                        "line2" => $session->shipping_details->address->line2,
                        "city" => $session->shipping_details->address->city,
                        "state" => $session->shipping_details->address->state,
                        "postal_code" =>
                            $session->shipping_details->address->postal_code,
                        "country" =>
                            $session->shipping_details->address->country,
                    ]
                    : null,
                "completed_at" => now(),
            ],
        );

        if ($order->wasRecentlyCreated) {
            $this->sendOrderConfirmationEmail($order);
        }
    }

    /**
     * Handle successful payment intent
     */
    private function handlePaymentIntentSucceeded($paymentIntent)
    {
        Log::info("Payment intent succeeded: " . $paymentIntent->id);

        $order = Order::where(
            "stripe_payment_intent_id",
            $paymentIntent->id,
        )->first();

        if ($order && $order->status !== "completed") {
            $order->markAsCompleted();
        }
    }

    /**
     * Handle failed payment intent
     */
    private function handlePaymentIntentFailed($paymentIntent)
    {
        Log::error("Payment intent failed: " . $paymentIntent->id);

        $order = Order::where(
            "stripe_payment_intent_id",
            $paymentIntent->id,
        )->first();

        if ($order) {
            $order->update(["status" => "failed"]);
        }
    }

    /**
     * Send order confirmation email
     */
    private function sendOrderConfirmationEmail(Order $order)
    {
        try {
            Mail::send(
                "emails.order-confirmation",
                ["order" => $order],
                function ($message) use ($order) {
                    $message
                        ->to($order->email, $order->name)
                        ->subject(
                            "Order Confirmation - VisorPlate #" . $order->id,
                        );
                },
            );

            Log::info("Order confirmation email sent to: " . $order->email);
        } catch (\Exception $e) {
            Log::error(
                "Failed to send order confirmation email: " . $e->getMessage(),
            );
        }
    }
}
