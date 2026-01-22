<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SendDailyOrderSummaryEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $orders;

    /**
     * Create a new job instance.
     */
    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $orderCount = $this->orders->count();
        $totalRevenue = $this->orders->sum("total");

        Mail::send(
            "emails.daily-order-summary",
            [
                "orders" => $this->orders,
                "orderCount" => $orderCount,
                "totalRevenue" => $totalRevenue,
            ],
            function ($message) use ($orderCount) {
                $message
                    ->to(
                        env(
                            "ORDER_NOTIFICATION_EMAIL",
                            "contact@visorplate-us.com",
                        ),
                    )
                    ->subject(
                        "VisorPlate: {$orderCount} " .
                            Str::plural("Order", $orderCount) .
                            " to Print Today",
                    );
            },
        );
    }
}
