<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendContactFormEmail implements ShouldQueue
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
     * Email subject.
     *
     * @var string
     */
    public $subject;

    /**
     * Email attachments.
     *
     * @var array
     */
    public $attachments;

    /**
     * Reply-to email.
     *
     * @var string
     */
    public $replyToEmail;

    /**
     * Reply-to name.
     *
     * @var string
     */
    public $replyToName;

    /**
     * Create a new job instance.
     */
    public function __construct(
        array $emailData,
        string $subject,
        array $attachments = [],
        string $replyToEmail = "",
        string $replyToName = "",
    ) {
        $this->emailData = $emailData;
        $this->subject = $subject;
        $this->attachments = $attachments;
        $this->replyToEmail = $replyToEmail;
        $this->replyToName = $replyToName;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::send("emails.contact", $this->emailData, function ($message) {
                $message
                    ->to(config("mail.from.address"))
                    ->subject($this->subject);

                if ($this->replyToEmail) {
                    $message->replyTo($this->replyToEmail, $this->replyToName);
                }

                // Attach files if any
                foreach ($this->attachments as $attachment) {
                    $message->attach($attachment["path"], [
                        "as" => $attachment["name"],
                        "mime" => $attachment["mime"],
                    ]);
                }
            });

            Log::info("Contact form email sent", [
                "type" => $this->emailData["inquiry_type"] ?? "unknown",
                "email" => $this->emailData["email"] ?? "unknown",
            ]);
        } catch (\Exception $e) {
            Log::error(
                "Failed to send contact form email: " . $e->getMessage(),
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
        Log::error("Contact form email job failed permanently", [
            "inquiry_type" => $this->emailData["inquiry_type"] ?? "unknown",
            "email" => $this->emailData["email"] ?? "unknown",
            "error" => $exception->getMessage(),
        ]);
    }
}
