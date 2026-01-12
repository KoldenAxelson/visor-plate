<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class NewsletterSignup extends Component
{
    public $email = '';
    public $source = '';
    public $success = false;
    public $errorMessage = '';

    protected $rules = [
        'email' => 'required|email|max:255',
    ];

    protected $messages = [
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
    ];

    public function mount($source = null)
    {
        $this->source = $source ?? 'general';
    }

    public function signup()
    {
        $this->validate();
        $this->success = false;
        $this->errorMessage = '';

        try {
            // Check if email already exists
            $existing = DB::table('newsletter_signups')
                ->where('email', $this->email)
                ->first();

            if ($existing) {
                $this->errorMessage = "You're already signed up! We'll notify you when we launch.";
                return;
            }

            // Hash IP for privacy
            $ipHash = hash('sha256', request()->ip());

            // Insert new signup
            DB::table('newsletter_signups')->insert([
                'email' => $this->email,
                'source' => $this->source,
                'ip_hash' => $ipHash,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->success = true;
            $this->email = ''; // Clear the form

        } catch (\Exception $e) {
            $this->errorMessage = 'Something went wrong. Please try again.';
            \Log::error('Newsletter signup error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.newsletter-signup');
    }
}
