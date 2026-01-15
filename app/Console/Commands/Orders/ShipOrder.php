<?php

namespace App\Console\Commands\Orders;

use App\Models\Order;
use App\Jobs\SendTrackingEmail;
use Illuminate\Console\Command;

class ShipOrder extends Command
{
    protected $signature = 'order:ship {id : The order ID} {tracking : The USPS tracking number}';
    protected $description = 'Manually mark an order as shipped with tracking number';

    public function handle(): int
    {
        $orderId = $this->argument('id');
        $trackingNumber = $this->argument('tracking');

        $order = Order::find($orderId);

        if (!$order) {
            $this->error("❌ Order #{$orderId} not found.");
            return Command::FAILURE;
        }

        if ($order->shipped_at) {
            $this->warn("⚠️  Order #{$orderId} was already shipped on {$order->shipped_at->format('M j, Y')}");
            $this->comment("   Current tracking: {$order->tracking_number}");
            
            if (!$this->confirm('Do you want to update the tracking number?')) {
                return Command::SUCCESS;
            }
        }

        // Update order
        $order->update([
            'tracking_number' => $trackingNumber,
            'shipped_at' => now(),
            'status' => 'shipped'
        ]);

        // Queue tracking email
        SendTrackingEmail::dispatch($order);

        $this->info("✅ Order #{$orderId} marked as shipped");
        $this->info("   Tracking: {$trackingNumber}");
        $this->info("   Customer: {$order->name} ({$order->email})");
        $this->comment("\n📧 Tracking email queued for delivery");

        return Command::SUCCESS;
    }
}
