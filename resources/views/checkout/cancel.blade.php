@extends('layouts.app')

@section('title', 'Checkout Cancelled')

@section('content')
<section class="section-standard bg-linear-to-b from-black to-gray-900 min-h-screen flex items-center">
    <div class="container-site">
        <div class="max-w-2xl mx-auto text-center">
            <!-- Cancelled Icon -->
            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-yellow-500/20 border-2 border-yellow-500 mb-6">
                <svg class="w-12 h-12 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>

            <h1 class="text-5xl md:text-6xl font-light text-white mb-4 tracking-luxury">
                Checkout Cancelled
            </h1>
            <p class="text-xl text-gray-300 mb-12 font-light">
                No worries! Your order wasn't processed and you haven't been charged.
            </p>

            <!-- Reassurance Card -->
            <div class="glass-card p-8 mb-8">
                <h3 class="text-2xl font-semibold text-white mb-4 tracking-wide">What Happened?</h3>
                <p class="text-gray-300 leading-relaxed font-light mb-6">
                    You cancelled the checkout process or closed the payment window. No charges were made to your account.
                </p>

                <div class="bg-blue-900/20 border border-blue-600/30 rounded-xl p-6">
                    <h4 class="text-white font-semibold mb-3">Still Want to Protect Your Bumper?</h4>
                    <p class="text-blue-200 text-sm font-light mb-4">
                        Thousands of car enthusiasts trust VisorPlate to stay legal without drilling holes. Ready to join them?
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                        <div class="flex items-center gap-2 text-blue-200">
                            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Free Shipping</span>
                        </div>
                        <div class="flex items-center gap-2 text-blue-200">
                            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>30-Day Guarantee</span>
                        </div>
                        <div class="flex items-center gap-2 text-blue-200">
                            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Secure Payment</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Common Questions -->
            <div class="card-feature text-left mb-8">
                <h3 class="text-2xl font-semibold text-white mb-6 tracking-wide text-center">Common Questions</h3>
                <div class="space-y-6">
                    <div>
                        <h4 class="text-white font-semibold mb-2">Was I charged?</h4>
                        <p class="text-gray-400 font-light">No, the payment was never processed. You haven't been charged anything.</p>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold mb-2">Is VisorPlate legal?</h4>
                        <p class="text-gray-400 font-light">Yes! VisorPlate meets legal requirements in all 29 states that require front license plates.</p>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold mb-2">Will it damage my car?</h4>
                        <p class="text-gray-400 font-light">Absolutely not. Zero drilling, zero holes, zero permanent damage. That's the whole point!</p>
                    </div>
                    <div>
                        <h4 class="text-white font-semibold mb-2">What if I'm not satisfied?</h4>
                        <p class="text-gray-400 font-light">30-day money-back guarantee. If you don't love it, return it for a full refund.</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('shop') }}" class="btn-primary-luxury text-center">
                    Return to Shop
                </a>
                <a href="{{ route('contact') }}" class="btn-secondary text-center">
                    Have Questions?
                </a>
            </div>

            <!-- Support Notice -->
            <p class="text-gray-500 mt-8 text-sm font-light">
                Need help or have concerns? <a href="{{ route('contact') }}" class="text-gradient-copper hover:underline">Contact our support team</a> - we're here to help!
            </p>
        </div>
    </div>
</section>

<style>
/* Outline button for secondary action */
.btn-outline-luxury {
    @apply px-8 py-4 rounded-xl font-semibold tracking-wide transition-all duration-300;
    background: transparent;
    border: 2px solid var(--accent-copper);
    color: var(--accent-copper);
}

.btn-outline-luxury:hover {
    background: var(--accent-copper);
    color: white;
    border-color: var(--accent-gold);
}
</style>
@endsection
