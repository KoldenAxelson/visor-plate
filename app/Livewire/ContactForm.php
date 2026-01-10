<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactForm extends Component
{
    // Form fields
    public $inquiry_type = "general"; // 'general' or 'wholesale'
    public $name = "";
    public $email = "";
    public $phone = "";
    public $company = "";
    public $quantity = "";
    public $message = "";
    public $honeypot = ""; // Spam protection

    // UI state
    public $submitted = false;
    public $sending = false;

    /**
     * Validation rules
     */
    protected function rules()
    {
        $rules = [
            "inquiry_type" => "required|in:general,wholesale",
            "name" => "required|min:2|max:100",
            "email" => "required|email|max:100",
            "phone" => "nullable|max:20",
            "message" => "required|min:10|max:1000",
            "honeypot" => "max:0", // Must be empty (spam protection)
        ];

        // Additional validation for wholesale inquiries
        if ($this->inquiry_type === "wholesale") {
            $rules["company"] = "required|min:2|max:100";
            $rules["quantity"] = "required|integer|min:100";
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
        "company.required" =>
            "Company name is required for wholesale inquiries.",
        "quantity.required" => "Please specify the quantity needed.",
        "quantity.min" => "Wholesale orders require a minimum of 200 units.",
        "quantity.integer" => "Please enter a valid quantity.",
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
        // Reset wholesale-specific fields when switching
        if ($this->inquiry_type === "general") {
            $this->company = "";
            $this->quantity = "";
            $this->resetValidation(["company", "quantity"]);
        }
    }

    /**
     * Submit the form
     */
    public function submit()
    {
        // Check honeypot first (spam protection)
        if (!empty($this->honeypot)) {
            Log::info("Spam submission blocked", ["email" => $this->email]);
            return;
        }

        // Validate all fields
        $this->validate();

        // Set sending state
        $this->sending = true;

        try {
            // Prepare email data
            $emailData = [
                "inquiry_type" => $this->inquiry_type,
                "name" => $this->name,
                "email" => $this->email,
                "phone" => $this->phone,
                "company" => $this->company,
                "quantity" => $this->quantity,
                "user_message" => $this->message,
                "submitted_at" => now()->format("M d, Y g:i A"),
            ];

            // Send email to business owner
            Mail::send("emails.contact", $emailData, function ($message) {
                $message
                    ->to(config("mail.from.address"))
                    ->subject(
                        $this->inquiry_type === "wholesale"
                            ? "New Wholesale Inquiry - VisorPlate"
                            : "New Contact Form Submission - VisorPlate",
                    );
                $message->replyTo($this->email, $this->name);
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
            "message",
            "submitted",
            "sending",
        ]);
        $this->inquiry_type = "general";
    }

    public function render()
    {
        return view("livewire.contact-form")->layout("layouts.app", [
            "title" => "Contact Us - VisorPlate",
        ]);
    }
}
