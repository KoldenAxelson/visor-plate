<div class="max-w-md mx-auto">
    @if($success)
        <!-- Success Message -->
        <div class="text-center px-6 py-5 rounded-xl mb-6"
             style="background: rgba(184, 115, 51, 0.1); border: 1px solid rgba(184, 115, 51, 0.3);">
            <svg class="w-8 h-8 mx-auto mb-3" style="color: var(--accent-copper);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <p class="text-white font-semibold mb-1">You're on the list!</p>
            <p class="text-gray-300 text-sm">We'll email you when we launch.</p>
        </div>
    @else
        <!-- Signup Form -->
        <form wire:submit.prevent="signup" class="space-y-4">
            <div>
                <input
                    type="email"
                    wire:model="email"
                    placeholder="Enter your email address"
                    class="input-standard w-full text-center"
                    required
                >
                @error('email')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            @if($errorMessage)
                <div class="text-yellow-400 text-sm text-center">
                    {{ $errorMessage }}
                </div>
            @endif

            <button
                type="submit"
                class="btn-primary-luxury w-full"
                wire:loading.attr="disabled"
            >
                <span wire:loading.remove>Notify Me</span>
                <span wire:loading>Signing Up...</span>
            </button>
        </form>

        <p class="text-gray-500 text-xs text-center mt-4">
            We respect your privacy, and your attention. Unsubscribe anytime.
        </p>
    @endif
</div>
