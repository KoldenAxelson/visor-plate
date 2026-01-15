<?php

namespace App\Console\Commands\Orders;

use App\Models\Order;
use App\Jobs\SendTrackingEmail;
use Illuminate\Console\Command;

class ResendTracking extends Command
{
    protected $signature = 'order:resend-tracking {id : The order ID}';
    protected $description = 'Resend the tracking notification email to a customer';

    public function handle(): int
    {
        $orderId = $this->argument('id');
        $order = Order::find($orderId);

        if (!$order) {
            $this->error("❌ Order #{$orderId} not found.");
            return Command::FAILURE;
        }

        if (!$order->tracking_number) {
            $this->error("❌ Order #{$orderId} doesn't have a tracking number yet.");
            $this->comment("   Status: {$order->status}");
            return Command::FAILURE;
        }

        // Queue tracking email
        SendTrackingEmail::dispatch($order);

        $this->info("✅ Tracking email queued for resend");
        $this->info("   Order: #" . str_pad($order->id, 6, '0', STR_PAD_LEFT));
        $this->info("   Customer: {$order->name} ({$order->email})");
        $this->info("   Tracking: {$order->tracking_number}");
        $this->newLine();
        $this->comment("💡 Make sure queue worker is running: php artisan queue:work");

        return Command::SUCCESS;
    }
}
