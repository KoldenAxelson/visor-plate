<?php

namespace App\Console\Commands\Orders;

use App\Models\Order;
use Illuminate\Console\Command;

class PendingOrders extends Command
{
    protected $signature = 'orders:pending';
    protected $description = 'List all pending orders (paid but not yet shipped)';

    public function handle(): int
    {
        $orders = Order::where('status', 'pending')
            ->orWhere(function($query) {
                $query->where('status', 'completed')
                      ->whereNull('shipped_at');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        if ($orders->isEmpty()) {
            $this->info('✅ No pending orders. All caught up!');
            return Command::SUCCESS;
        }

        $this->info("📦 Pending Orders: {$orders->count()}\n");

        $headers = ['Order #', 'Customer', 'Email', 'Qty', 'Amount', 'Created', 'Status'];
        $rows = [];

        foreach ($orders as $order) {
            $rows[] = [
                str_pad($order->id, 6, '0', STR_PAD_LEFT),
                $order->name,
                $order->email,
                $order->quantity,
                '$' . number_format($order->amount_cents / 100, 2),
                $order->created_at->format('M j, Y g:i A'),
                $order->status
            ];
        }

        $this->table($headers, $rows);

        $this->newLine();
        $this->comment('💡 Run: php artisan orders:print-pending to print all labels');

        return Command::SUCCESS;
    }
}
