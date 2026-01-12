@extends('layouts.app')

@section('title', 'Thank You for Your Interest - VisorPlate')

@section('content')
<section class="section-standard bg-linear-to-b from-black to-gray-900 min-h-screen py-16">
    <div class="container-site">
        <div class="max-w-5xl mx-auto">

            <!-- Icon based on platform -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full mb-6"
                     style="background: linear-gradient(135deg, var(--accent-copper), var(--accent-gold));">
                    @if($platform === 'facebook')
                        <svg class="w-12 h-12 text-black" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    @elseif($platform === 'x')
                        <svg class="w-12 h-12 text-black" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    @else
                        <svg class="w-12 h-12 text-black" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                        </svg>
                    @endif
                </div>

                @php
                    $platformNames = [
                        'facebook' => 'Facebook',
                        'x' => 'X',
                        'instagram' => 'Instagram'
                    ];
                    $platformName = $platformNames[$platform] ?? 'Social Media';

                    // Get stats for this platform
                    $totalInterest = DB::table('social_interest_logs')->count();
                    $platformInterest = DB::table('social_interest_logs')->where('platform', $platform)->count();
                    $goal = 500; // Goal for launching social media
                    $percentage = $totalInterest > 0 ? round(($platformInterest / $goal) * 100) : 0;
                @endphp

                <h1 class="text-4xl md:text-5xl font-light text-white mb-4 tracking-luxury">
                    Thank You for<br>
                    <span class="text-gradient-copper">Your Interest!</span>
                </h1>

                <p class="text-xl text-gray-300 mb-6 font-light">
                    You want to see VisorPlate on <strong class="text-white">{{ $platformName }}</strong>
                </p>
            </div>

            <!-- Goal Progress -->
            <div class="glass-card p-8 mb-12">
                <div class="text-center mb-6">
                    <p class="text-2xl text-white mb-2 font-semibold">
                        🎯 You're one of <span class="text-gradient-copper">{{ $platformInterest }}</span> {{ Str::plural('person', $platformInterest) }}!
                    </p>
                    <p class="text-gray-400 font-light">
                        We'll launch our {{ $platformName }} when we hit <strong class="text-white">{{ $goal }}</strong> interested visitors
                    </p>
                </div>

                <!-- Progress Bar -->
                <div class="w-full bg-gray-800 rounded-full h-6 overflow-hidden border border-gray-700">
                    <div class="h-full rounded-full transition-all duration-500 flex items-center justify-end pr-3"
                         style="width: {{ min($percentage, 100) }}%; background: linear-gradient(135deg, var(--accent-copper), var(--accent-gold));">
                        @if($percentage > 15)
                        <span class="text-black font-bold text-sm">{{ $percentage }}%</span>
                        @endif
                    </div>
                </div>

                <div class="flex justify-between mt-3 text-sm">
                    <span class="text-gray-500 font-light">0</span>
                    <span class="text-white font-semibold">{{ $platformInterest }} / {{ $goal }}</span>
                    <span class="text-gray-500 font-light">{{ $goal }}</span>
                </div>

                <div class="text-center mt-6">
                    <p class="text-gray-400 text-sm font-light italic">
                        ✓ Your interest has been logged — we're listening!
                    </p>
                </div>
            </div>

            <!-- Platform-Specific Content -->
            <!-- Universal Sign Up Section (same for all platforms) -->
            <div class="glass-card p-12 text-center mb-12">
                <h3 class="text-3xl font-light text-white mb-4 tracking-luxury">
                    Get Notified When We Launch
                </h3>
                <p class="text-lg text-gray-300 mb-8 font-light leading-relaxed">
                    Be the first to know when we officially launch our {{ $platformName }} presence.<br>
                    No spam, just one announcement when we're live.
                </p>

                @livewire('newsletter-signup', ['source' => 'social-interest-' . $platform])
            </div>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                <a href="{{ route('shop') }}" class="btn-primary-luxury text-center">
                    Shop VisorPlate
                </a>
                <a href="{{ route('home') }}" class="btn-secondary text-center">
                    Back to Homepage
                </a>
            </div>

            <!-- Transparency Note -->
            <div class="text-center">
                <p class="text-gray-500 text-sm font-light max-w-2xl mx-auto">
                    We're a small team focused on shipping quality products. Your feedback helps us prioritize where to build our online presence. Thanks for being part of our early community! 🚀
                </p>
            </div>
        </div>
    </div>
</section>

<style>
/* Fade-in animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

section > div {
    animation: fadeInUp 0.6s ease-out;
}
</style>
@endsection
