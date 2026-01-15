<?php

namespace App\Console\Commands\Orders;

use App\Models\Order;
use App\Services\RolloPrinter;
use Illuminate\Console\Command;

class GetTracking extends Command
{
    protected $signature = 'order:tracking {id : The order ID}';
    protected $description = 'Get the USPS tracking URL for an order';

    public function handle(): int
    {
        $orderId = $this->argument('id');
        $order = Order::find($orderId);

        if (!$order) {
            $this->error("❌ Order #{$orderId} not found.");
            return Command::FAILURE;
        }

        if (!$order->tracking_number) {
            $this->warn("⚠️  Order #{$orderId} does not have a tracking number yet.");
            $this->comment("   Status: {$order->status}");
            
            if (!$order->shipped_at) {
                $this->comment("   💡 Run: php artisan orders:print-pending");
            }
            
            return Command::FAILURE;
        }

        $trackingUrl = RolloPrinter::getTrackingUrl($order->tracking_number);

        $this->info("📦 Order #" . str_pad($order->id, 6, '0', STR_PAD_LEFT));
        $this->info("   Customer: {$order->name}");
        $this->info("   Tracking: {$order->tracking_number}");
        $this->info("   Shipped: {$order->shipped_at->format('M j, Y g:i A')}");
        $this->newLine();
        $this->comment("🔗 Track Package:");
        $this->line("   {$trackingUrl}");

        return Command::SUCCESS;
    }
}
