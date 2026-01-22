<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNoOrdersEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::send("emails.no-orders-today", [], function ($message) {
            $message
                ->to(
                    env(
                        "ORDER_NOTIFICATION_EMAIL",
                        "contact@visorplate-us.com",
                    ),
                )
                ->subject("VisorPlate: No Orders Today - You're Free! 🎉");
        });
    }
}
