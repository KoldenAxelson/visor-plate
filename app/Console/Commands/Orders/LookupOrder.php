<?php

namespace App\Console\Commands\Orders;

use App\Models\Order;
use App\Services\RolloPrinter;
use Illuminate\Console\Command;

class LookupOrder extends Command
{
    protected $signature = 'order:lookup {email : Customer email address}';
    protected $description = 'Find all orders for a customer by email';

    public function handle(): int
    {
        $email = $this->argument('email');
        
        $orders = Order::where('email', $email)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($orders->isEmpty()) {
            $this->warn("⚠️  No orders found for: {$email}");
            return Command::SUCCESS;
        }

        $this->info("🔍 Found {$orders->count()} order(s) for: {$email}\n");

        foreach ($orders as $order) {
            $this->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
            $this->info("Order #" . str_pad($order->id, 6, '0', STR_PAD_LEFT) . " | Status: " . strtoupper($order->status));
            $this->line("   Customer: {$order->name}");
            $this->line("   Quantity: {$order->quantity}");
            $this->line("   Amount: $" . number_format($order->amount_cents / 100, 2));
            $this->line("   Ordered: {$order->created_at->format('M j, Y g:i A')}");
            
            if ($order->shipped_at) {
                $this->line("   Shipped: {$order->shipped_at->format('M j, Y g:i A')}");
                $this->line("   Tracking: {$order->tracking_number}");
                $trackingUrl = RolloPrinter::getTrackingUrl($order->tracking_number);
                $this->comment("   Track: {$trackingUrl}");
            } else {
                $this->comment("   Not yet shipped");
            }
            
            $this->newLine();
        }

        return Command::SUCCESS;
    }
}
