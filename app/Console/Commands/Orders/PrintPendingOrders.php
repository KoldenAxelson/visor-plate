<?php

namespace App\Console\Commands\Orders;

use App\Models\Order;
use App\Services\RolloPrinter;
use App\Jobs\SendTrackingEmail;
use Illuminate\Console\Command;

class PrintPendingOrders extends Command
{
    protected $signature = 'orders:print-pending';
    protected $description = 'Batch print labels for all pending orders';

    protected RolloPrinter $printer;

    public function __construct(RolloPrinter $printer)
    {
        parent::__construct();
        $this->printer = $printer;
    }

    public function handle(): int
    {
        // Check if printer is online first
        if (!$this->printer->isOnline()) {
            $this->error('❌ Rollo printer is offline. Please check connection.');
            $this->comment('   - Verify printer is powered on');
            $this->comment('   - Check USB/network connection');
            $this->comment('   - Verify ShipStation API credentials');
            return Command::FAILURE;
        }

        // Get pending orders
        $orders = Order::where('status', 'pending')
            ->orWhere(function($query) {
                $query->where('status', 'completed')
                      ->whereNull('shipped_at');
            })
            ->orderBy('created_at', 'asc')
            ->get();

        if ($orders->isEmpty()) {
            $this->info('✅ No pending orders to print.');
            return Command::SUCCESS;
        }

        $this->info("🖨️  Starting batch print for {$orders->count()} orders...\n");

        // Create progress bar
        $progressBar = $this->output->createProgressBar($orders->count());
        $progressBar->start();

        // Batch print
        $results = $this->printer->batchPrint($orders);

        $progressBar->finish();
        $this->newLine(2);

        // Process results
        foreach ($results['results'] as $result) {
            $order = Order::find($result['order_id']);
            
            if ($result['success'] && $order) {
                // Update order
                $order->update([
                    'tracking_number' => $result['tracking'],
                    'shipped_at' => now(),
                    'status' => 'shipped'
                ]);

                // Queue tracking email
                SendTrackingEmail::dispatch($order);

                $this->info("✅ Order #{$result['order_id']}: {$result['tracking']}");
            } else {
                $this->error("❌ Order #{$result['order_id']}: {$result['error']}");
            }
        }

        // Summary
        $this->newLine();
        $this->info("📊 Batch Print Summary:");
        $this->info("   Successful: {$results['successful']}");
        if ($results['failed'] > 0) {
            $this->error("   Failed: {$results['failed']}");
            $this->comment("\n💡 Check storage/logs/rollo.log for details");
        }

        return $results['failed'] > 0 ? Command::FAILURE : Command::SUCCESS;
    }
}
