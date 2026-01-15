<?php

namespace App\Console\Commands\Orders;

use App\Models\Order;
use Illuminate\Console\Command;

class TodayOrders extends Command
{
    protected $signature = 'orders:today';
    protected $description = "Display all orders from today";

    public function handle(): int
    {
        $orders = Order::whereDate('created_at', today())
            ->orderBy('created_at', 'desc')
            ->get();

        if ($orders->isEmpty()) {
            $this->info("📭 No orders today yet.");
            return Command::SUCCESS;
        }

        $totalRevenue = $orders->sum('amount_cents') / 100;
        $totalQuantity = $orders->sum('quantity');

        $this->info("📆 Today's Orders: " . today()->format('l, F j, Y'));
        $this->info("   Total Orders: {$orders->count()}");
        $this->info("   Total Revenue: $" . number_format($totalRevenue, 2));
        $this->info("   Total Units: {$totalQuantity}");
        $this->newLine();

        $headers = ['Order #', 'Time', 'Customer', 'Qty', 'Amount', 'Status'];
        $rows = [];

        foreach ($orders as $order) {
            $rows[] = [
                str_pad($order->id, 6, '0', STR_PAD_LEFT),
                $order->created_at->format('g:i A'),
                $order->name,
                $order->quantity,
                '$' . number_format($order->amount_cents / 100, 2),
                strtoupper($order->status)
            ];
        }

        $this->table($headers, $rows);

        return Command::SUCCESS;
    }
}
