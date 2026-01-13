<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendOrderConfirmationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * The number of seconds to wait before retrying the job.
     *
     * @var int
     */
    public $backoff = 60;

    /**
     * The order instance.
     *
     * @var \App\Models\Order
     */
    public $order;

    /**
     * Create a new job instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::send(
                "emails.order-confirmation",
                ["order" => $this->order],
                function ($message) {
                    $message
                        ->to($this->order->email, $this->order->name)
                        ->subject(
                            "Order Confirmation - VisorPlate #" .
                                $this->order->id,
                        );
                },
            );

            Log::info(
                "Order confirmation email sent to: " . $this->order->email,
            );
        } catch (\Exception $e) {
            Log::error(
                "Failed to send order confirmation email: " . $e->getMessage(),
            );

            // Re-throw the exception so the job fails and can be retried
            throw $e;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error("Order confirmation email job failed permanently", [
            "order_id" => $this->order->id,
            "email" => $this->order->email,
            "error" => $exception->getMessage(),
        ]);
    }
}
