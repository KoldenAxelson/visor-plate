<?php

namespace App\Console\Commands\Orders;

use App\Models\Order;
use App\Services\RolloPrinter;
use App\Jobs\SendTrackingEmail;
use App\Jobs\SendDailyOrderSummaryEmail;
use App\Jobs\SendNoOrdersEmail;
use Illuminate\Console\Command;

class PrintPendingOrders extends Command
{
    protected $signature = "orders:print-pending";
    protected $description = "Batch print labels for all pending orders";

    protected RolloPrinter $printer;

    public function __construct(RolloPrinter $printer)
    {
        parent::__construct();
        $this->printer = $printer;
    }

    public function handle(): int
    {
        // Get pending orders
        $orders = Order::where("status", "pending")
            ->orWhere(function ($query) {
                $query->where("status", "completed")->whereNull("shipped_at");
            })
            ->orderBy("created_at", "asc")
            ->get();

        // If no orders, exit silently (no spam)
        if ($orders->isEmpty()) {
            // Send "no orders" email on weekdays (Mon-Fri) for peace of mind
            if (now()->isWeekday()) {
                $this->info(
                    "📧 No orders today - sending peace of mind email...",
                );
                SendNoOrdersEmail::dispatch();
                $this->info('✅ "You\'re free today!" email sent.');
            } else {
                $this->info(
                    "✅ No pending orders to print (weekend - no email).",
                );
            }
            return Command::SUCCESS;
        }

        // 🆕 SEND DAILY SUMMARY EMAIL BEFORE PRINTING
        $this->info("📧 Sending daily order summary email...");
        SendDailyOrderSummaryEmail::dispatch($orders);
        $this->info("✅ Email queued successfully.\n");

        // Check if printer is online
        // NOTE: Forge cannot reach the Rollo printer directly — the local print agent
        // handles actual printing by polling the API. Printer being "offline" here is
        // expected and not a failure; the summary email has already been sent.
        if (!$this->printer->isOnline()) {
            $this->info(
                "ℹ️  Rollo printer not reachable from this host — print agent will handle printing.",
            );
            $this->comment(
                "💡 Summary email sent. Deferring label printing to local print agent.",
            );
            return Command::SUCCESS;
        }

        $this->info(
            "🖨️  Starting batch print for {$orders->count()} orders...\n",
        );

        // Create progress bar
        $progressBar = $this->output->createProgressBar($orders->count());
        $progressBar->start();

        // Batch print
        $results = $this->printer->batchPrint($orders);

        $progressBar->finish();
        $this->newLine(2);

        // Process results
        foreach ($results["results"] as $result) {
            $order = Order::find($result["order_id"]);

            if ($result["success"] && $order) {
                // Update order
                $order->update([
                    "tracking_number" => $result["tracking"],
                    "shipped_at" => now(),
                    "status" => "shipped",
                ]);

                // Queue tracking email
                SendTrackingEmail::dispatch($order);

                $this->info(
                    "✅ Order #{$result["order_id"]}: {$result["tracking"]}",
                );
            } else {
                $this->error(
                    "❌ Order #{$result["order_id"]}: {$result["error"]}",
                );
            }
        }

        // Summary
        $this->newLine();
        $this->info("📊 Batch Print Summary:");
        $this->info("   Successful: {$results["successful"]}");
        if ($results["failed"] > 0) {
            $this->error("   Failed: {$results["failed"]}");
            $this->comment("\n💡 Check storage/logs/rollo.log for details");
        }

        return $results["failed"] > 0 ? Command::FAILURE : Command::SUCCESS;
    }
}
