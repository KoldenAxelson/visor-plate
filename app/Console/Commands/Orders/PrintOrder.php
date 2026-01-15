<?php

namespace App\Console\Commands\Orders;

use App\Models\Order;
use App\Services\RolloPrinter;
use App\Jobs\SendTrackingEmail;
use Illuminate\Console\Command;

class PrintOrder extends Command
{
    protected $signature = 'order:print {id : The order ID}';
    protected $description = 'Print a shipping label for a single order';

    protected RolloPrinter $printer;

    public function __construct(RolloPrinter $printer)
    {
        parent::__construct();
        $this->printer = $printer;
    }

    public function handle(): int
    {
        $orderId = $this->argument('id');
        $order = Order::find($orderId);

        if (!$order) {
            $this->error("❌ Order #{$orderId} not found.");
            return Command::FAILURE;
        }

        if ($order->shipped_at) {
            $this->warn("⚠️  Order #{$orderId} was already shipped on {$order->shipped_at->format('M j, Y')}");
            $this->comment("   Current tracking: {$order->tracking_number}");
            
            if (!$this->confirm('Do you want to reprint the label?')) {
                return Command::SUCCESS;
            }
        }

        // Check printer connectivity
        $this->info("🔍 Checking printer connection...");
        if (!$this->printer->isOnline()) {
            $this->error("❌ Rollo printer is offline. Please check connection.");
            return Command::FAILURE;
        }

        // Print label
        $this->info("🖨️  Printing label for Order #{$orderId}...");
        $result = $this->printer->printLabel($order);

        if (!$result['success']) {
            $this->error("❌ Failed to print label: {$result['error']}");
            $this->comment("\n💡 Check storage/logs/rollo.log for details");
            return Command::FAILURE;
        }

        // Update order
        $order->update([
            'tracking_number' => $result['tracking'],
            'shipped_at' => now(),
            'status' => 'shipped'
        ]);

        // Queue tracking email
        SendTrackingEmail::dispatch($order);

        $this->info("\n✅ Label printed successfully!");
        $this->info("   Order: #" . str_pad($order->id, 6, '0', STR_PAD_LEFT));
        $this->info("   Customer: {$order->name}");
        $this->info("   Tracking: {$result['tracking']}");
        $this->comment("\n📧 Tracking email queued for delivery");

        return Command::SUCCESS;
    }
}
