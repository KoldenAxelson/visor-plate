<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\RateLimiter;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Str;

class ContactForm extends Component
{
    use WithFileUploads;

    // Form fields
    public $inquiry_type = "general"; // 'general', 'wholesale', 'return', 'review'
    public $name = "";
    public $email = "";
    public $phone = "";

    // Wholesale fields
    public $company = "";
    public $quantity = "";

    // Return fields
    public $order_number = "";
    public $return_reason = "";
    public $return_photo = null;

    // Review fields
    public $review_title = "";
    public $rating = 5;
    public $review_text = "";
    public $ride_photo = null;

    public $message = "";
    public $honeypot = ""; // Spam protection

    // UI state
    public $submitted = false;
    public $sending = false;

    /**
     * Initialize component and check for query parameters
     */
    public function mount()
    {
        // Check for 'mode' query parameter (for direct links)
        $mode = request()->query("mode");
        if (in_array($mode, ["wholesale", "return", "review"])) {
            $this->inquiry_type = $mode;
        }
    }

    /**
     * Validation rules
     */
    protected function rules()
    {
        $rules = [
            "inquiry_type" => "required|in:general,wholesale,return,review",
            "name" => "required|min:2|max:100",
            "email" => "required|email|max:100",
            "phone" => "nullable|max:20",
            "honeypot" => "max:0", // Must be empty (spam protection)
        ];

        // Wholesale-specific validation
        if ($this->inquiry_type === "wholesale") {
            $rules["company"] = "required|min:2|max:100";
            $rules["quantity"] = "required|integer|min:100";
            $rules["message"] = "required|min:10|max:1000";
        }

        // Return-specific validation
        elseif ($this->inquiry_type === "return") {
            $rules["order_number"] = "required|min:3|max:50";
            $rules["return_reason"] = "required|min:10|max:500";
            $rules["return_photo"] = "required|image|max:10240"; // 10MB max
            $rules["message"] = "nullable|max:1000";
        }

        // Review-specific validation
        elseif ($this->inquiry_type === "review") {
            $rules["review_title"] = "required|min:5|max:100";
            $rules["rating"] = "required|integer|min:1|max:5";
            $rules["review_text"] = "required|min:20|max:1000";
            $rules["ride_photo"] = "nullable|image|max:10240"; // 10MB max
            $rules["message"] = "nullable|max:1000";
        }

        // General inquiry validation
        else {
            $rules["message"] = "required|min:10|max:1000";
        }

        return $rules;
    }

    /**
     * Custom validation messages
     */
    protected $messages = [
        "name.required" => "Please enter your name.",
        "email.required" => "Please enter your email address.",
        "email.email" => "Please enter a valid email address.",
        "phone.max" => "Phone number is too long.",
        "message.required" => "Please enter a message.",
        "message.min" => "Message must be at least 10 characters.",

        // Wholesale messages
        "company.required" =>
            "Company name is required for wholesale inquiries.",
        "quantity.required" => "Please specify the quantity needed.",
        "quantity.min" => "Wholesale orders require a minimum of 100 units.",
        "quantity.integer" => "Please enter a valid quantity.",

        // Return messages
        "order_number.required" => "Please enter your order number.",
        "return_reason.required" =>
            "Please tell us why you're returning the product.",
        "return_reason.min" =>
            "Please provide more detail about your return reason.",
        "return_photo.required" => "Please upload a photo of the product.",
        "return_photo.image" => "The file must be an image (JPG, PNG, etc).",
        "return_photo.max" => "Image must be smaller than 10MB.",

        // Review messages
        "review_title.required" => "Please enter a title for your review.",
        "review_title.min" => "Review title must be at least 5 characters.",
        "rating.required" => "Please select a rating.",
        "rating.min" => "Rating must be between 1 and 5 stars.",
        "rating.max" => "Rating must be between 1 and 5 stars.",
        "review_text.required" => "Please write your review.",
        "review_text.min" => "Review must be at least 20 characters.",
        "ride_photo.image" => "The file must be an image (JPG, PNG, etc).",
        "ride_photo.max" => "Image must be smaller than 10MB.",
    ];

    /**
     * Real-time validation as user types
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Handle inquiry type change
     */
    public function updatedInquiryType()
    {
        // Reset all type-specific fields when switching
        $this->company = "";
        $this->quantity = "";
        $this->order_number = "";
        $this->return_reason = "";
        $this->return_photo = null;
        $this->review_title = "";
        $this->rating = 5;
        $this->review_text = "";
        $this->ride_photo = null;

        // Reset validation for all type-specific fields
        $this->resetValidation([
            "company",
            "quantity",
            "order_number",
            "return_reason",
            "return_photo",
            "review_title",
            "rating",
            "review_text",
            "ride_photo",
        ]);
    }

    /**
     * Submit the form
     */
    public function submit()
    {
        // Rate limiting: 5 submissions per hour per IP
        $key = "contact-form:" . request()->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            $minutes = ceil($seconds / 60);

            session()->flash(
                "error",
                "You've submitted too many messages. Please wait {$minutes} minutes before trying again or disconnect your VPN.",
            );

            $this->sending = false;
            return;
        }

        // Check honeypot first (spam protection)
        if (!empty($this->honeypot)) {
            Log::info("Spam submission blocked", ["email" => $this->email]);
            return;
        }

        // Validate all fields
        $this->validate();

        // Increment rate limiter (1 hour = 3600 seconds)
        RateLimiter::hit($key, 3600);

        // Set sending state
        $this->sending = true;

        try {
            // Prepare base email data
            $emailData = [
                "inquiry_type" => $this->inquiry_type,
                "name" => $this->name,
                "email" => $this->email,
                "phone" => $this->phone,
                "user_message" => $this->message,
                "submitted_at" => now()->format("M d, Y g:i A"),
            ];

            // Handle file uploads and add type-specific data
            $attachments = [];

            if ($this->inquiry_type === "wholesale") {
                $emailData["company"] = $this->company;
                $emailData["quantity"] = $this->quantity;
            } elseif ($this->inquiry_type === "return") {
                $emailData["order_number"] = $this->order_number;
                $emailData["return_reason"] = $this->return_reason;

                // SANITIZE AND STORE return photo (90-day retention)
                if ($this->return_photo) {
                    // Generate secure filename
                    $secureFilename = Str::random(40) . ".jpg";

                    // Create dated folder structure for easy cleanup: returns/YYYY-MM/
                    $dateFolder = now()->format("Y-m");
                    $storagePath = "returns/{$dateFolder}/{$secureFilename}";

                    // SANITIZE: Load image, re-encode as JPEG (strips EXIF, malicious code)
                    $sanitized = Image::read($this->return_photo->getRealPath())
                        ->scaleDown(2000) // Max 2000px width/height (prevents huge files)
                        ->toJpeg(85); // Re-encode as JPEG at 85% quality

                    // Store sanitized image
                    Storage::disk("public")->put($storagePath, $sanitized);

                    // Add to email data for reference
                    $emailData["return_photo_path"] = $storagePath;
                    $emailData["return_photo_url"] = Storage::url($storagePath);
                    $emailData["return_submission_date"] = now()->format(
                        "Y-m-d",
                    ); // For 90-day tracking

                    // Attach sanitized photo to email
                    $attachments[] = [
                        "path" => storage_path("app/public/" . $storagePath),
                        "name" => "return_photo.jpg",
                        "mime" => "image/jpeg",
                    ];
                }
            } elseif ($this->inquiry_type === "review") {
                $emailData["review_title"] = $this->review_title;
                $emailData["rating"] = $this->rating;
                $emailData["review_text"] = $this->review_text;

                // EMAIL-ONLY for review photos (you'll manually curate)
                // Attach temp file directly, DO NOT store on server
                if ($this->ride_photo) {
                    $attachments[] = [
                        "path" => $this->ride_photo->getRealPath(),
                        "name" =>
                            "ride_photo." .
                            $this->ride_photo->getClientOriginalExtension(),
                        "mime" => $this->ride_photo->getMimeType(),
                    ];
                    // Note: Temp file will be auto-cleaned by Livewire after request
                }
            }

            // Determine email subject based on inquiry type
            $subjectMap = [
                "general" => "New Contact Form Submission - VisorPlate",
                "wholesale" => "New Wholesale Inquiry - VisorPlate",
                "return" => "New Return Request - VisorPlate",
                "review" => "New Customer Review - VisorPlate",
            ];

            $subject =
                $subjectMap[$this->inquiry_type] ?? "New Contact - VisorPlate";

            // Send email to business owner
            Mail::send("emails.contact", $emailData, function ($message) use (
                $subject,
                $attachments,
            ) {
                $message->to(config("mail.from.address"))->subject($subject);
                $message->replyTo($this->email, $this->name);

                // Attach files if any
                foreach ($attachments as $attachment) {
                    $message->attach($attachment["path"], [
                        "as" => $attachment["name"],
                        "mime" => $attachment["mime"],
                    ]);
                }
            });

            // Send confirmation email to customer - Production Only
            if (app()->environment("production")) {
                Mail::send("emails.contact-confirmation", $emailData, function (
                    $message,
                ) {
                    $message
                        ->to($this->email, $this->name)
                        ->subject("Thank you for contacting VisorPlate");
                });
            }

            // Mark as submitted
            $this->submitted = true;

            // Log successful submission
            Log::info("Contact form submission", [
                "type" => $this->inquiry_type,
                "email" => $this->email,
                "name" => $this->name,
            ]);
        } catch (\Exception $e) {
            // Log error
            Log::error("Contact form error: " . $e->getMessage());

            // Show user-friendly error
            session()->flash(
                "error",
                "There was an error sending your message. Please try again or email us directly.",
            );

            $this->sending = false;
            return;
        }

        $this->sending = false;
    }

    /**
     * Reset the form
     */
    public function resetForm()
    {
        $this->reset([
            "name",
            "email",
            "phone",
            "company",
            "quantity",
            "order_number",
            "return_reason",
            "return_photo",
            "review_title",
            "rating",
            "review_text",
            "ride_photo",
            "message",
            "submitted",
            "sending",
        ]);
        $this->inquiry_type = "general";
        $this->rating = 5; // Reset to default
    }

    public function render()
    {
        $titleMap = [
            "general" => "Contact Us - VisorPlate",
            "wholesale" => "Wholesale Inquiry - VisorPlate",
            "return" => "Return Request - VisorPlate",
            "review" => "Add Your Review - VisorPlate",
        ];

        $title = $titleMap[$this->inquiry_type] ?? "Contact Us - VisorPlate";

        return view("livewire.contact-form")->layout("layouts.app", [
            "title" => $title,
        ]);
    }
}
