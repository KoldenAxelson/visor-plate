<?php

namespace App\Console\Commands\Orders;

use App\Models\Order;
use App\Services\RolloPrinter;
use Illuminate\Console\Command;

class ShowOrder extends Command
{
    protected $signature = "order:show {id : The order ID}";
    protected $description = "Display detailed information about an order";

    public function handle(): int
    {
        $orderId = $this->argument("id");
        $order = Order::find($orderId);

        if (!$order) {
            $this->error("❌ Order #{$orderId} not found.");
            return Command::FAILURE;
        }

        $this->info("📦 Order Details\n");

        $this->table(
            ["Field", "Value"],
            [
                ["Order ID", "#" . str_pad($order->id, 6, "0", STR_PAD_LEFT)],
                ["Status", strtoupper($order->status)],
                ["Customer Name", $order->name],
                ["Customer Email", $order->email],
                ["Quantity", $order->quantity],
                ["Amount", '$' . number_format($order->amount_cents / 100, 2)],
                ["Created", $order->created_at->format("M j, Y g:i A")],
                [
                    "Completed",
                    $order->completed_at
                        ? $order->completed_at->format("M j, Y g:i A")
                        : "N/A",
                ],
                [
                    "Shipped",
                    $order->shipped_at
                        ? $order->shipped_at->format("M j, Y g:i A")
                        : "Not yet shipped",
                ],
                ["Tracking Number", $order->tracking_number ?? "Not assigned"],
            ],
        );

        if ($order->tracking_number) {
            $trackingUrl = RolloPrinter::getTrackingUrl(
                $order->tracking_number,
            );
            $this->newLine();
            $this->comment("🔗 Track Package: {$trackingUrl}");
        }

        $this->newLine();
        $this->info("📍 Shipping Address:");
        $address = $order->shipping_address;

        if (!$address || !is_array($address)) {
            $this->error("   ⚠️  No shipping address on file");
        } else {
            $this->line("   {$address["line1"]}");
            if (!empty($address["line2"])) {
                $this->line("   {$address["line2"]}");
            }
            $this->line(
                "   {$address["city"]}, {$address["state"]} {$address["postal_code"]}",
            );
        }

        $this->newLine();
        $this->info("💳 Stripe Information:");
        $this->line("   Session ID: {$order->stripe_checkout_session_id}");
        $this->line("   Payment Intent: {$order->stripe_payment_intent_id}");

        return Command::SUCCESS;
    }
}
