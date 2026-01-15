<?php

namespace App\Jobs;

use App\Models\Order;
use App\Services\RolloPrinter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendTrackingEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     */
    public int $tries = 3;

    /**
     * The number of seconds to wait before retrying the job.
     */
    public int $backoff = 60;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Order $order
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (!$this->order->tracking_number) {
            Log::warning('Attempted to send tracking email for order without tracking number', [
                'order_id' => $this->order->id
            ]);
            return;
        }

        try {
            $trackingUrl = RolloPrinter::getTrackingUrl($this->order->tracking_number);

            Mail::send(
                'emails.tracking-notification',
                [
                    'order' => $this->order,
                    'trackingUrl' => $trackingUrl,
                    'orderNumber' => str_pad($this->order->id, 6, '0', STR_PAD_LEFT)
                ],
                function ($message) {
                    $message->to($this->order->email, $this->order->name)
                        ->subject('Your VisorPlate has shipped! 📦');
                }
            );

            Log::info('Tracking email sent successfully', [
                'order_id' => $this->order->id,
                'email' => $this->order->email,
                'tracking' => $this->order->tracking_number
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to send tracking email', [
                'order_id' => $this->order->id,
                'error' => $e->getMessage()
            ]);
            
            // Re-throw to trigger retry
            throw $e;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('Tracking email job failed permanently', [
            'order_id' => $this->order->id,
            'email' => $this->order->email,
            'error' => $exception->getMessage()
        ]);

        // Optional: Send notification to admin via Flare or email
    }
}
