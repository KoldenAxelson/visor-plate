<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendContactConfirmationEmail implements ShouldQueue
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
     * Email data.
     *
     * @var array
     */
    public $emailData;

    /**
     * Customer email address.
     *
     * @var string
     */
    public $customerEmail;

    /**
     * Customer name.
     *
     * @var string
     */
    public $customerName;

    /**
     * Create a new job instance.
     */
    public function __construct(
        array $emailData,
        string $customerEmail,
        string $customerName,
    ) {
        $this->emailData = $emailData;
        $this->customerEmail = $customerEmail;
        $this->customerName = $customerName;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::send(
                "emails.contact-confirmation",
                $this->emailData,
                function ($message) {
                    $message
                        ->to($this->customerEmail, $this->customerName)
                        ->subject("Thank you for contacting VisorPlate");
                },
            );

            Log::info(
                "Contact confirmation email sent to: " . $this->customerEmail,
            );
        } catch (\Exception $e) {
            Log::error(
                "Failed to send contact confirmation email: " .
                    $e->getMessage(),
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
        Log::error("Contact confirmation email job failed permanently", [
            "email" => $this->customerEmail,
            "inquiry_type" => $this->emailData["inquiry_type"] ?? "unknown",
            "error" => $exception->getMessage(),
        ]);
    }
}
