@extends('layouts.app')

@section('title', 'Order Confirmed!')

@section('content')
<section class="section-standard bg-linear-to-b from-black to-gray-900 min-h-screen flex items-center">
    <div class="container-site">
        <div class="max-w-3xl mx-auto">
            <!-- Success Animation Container -->
            <div class="text-center mb-12">
                <!-- Animated Checkmark -->
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-green-500/20 border-2 border-green-500 mb-6">
                    <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <h1 class="text-5xl md:text-6xl font-light text-white mb-4 tracking-luxury">
                    Order Confirmed!
                </h1>
                <p class="text-xl text-gray-300 font-light">
                    Thank you for your purchase, <span class="text-gradient-copper font-semibold">{{ $order->name }}</span>
                </p>
            </div>

            <!-- Order Details Card -->
            <div class="glass-card p-8 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <div>
                            <p class="text-sm text-gray-400 mb-1 font-light">Order Number</p>
                            <p class="text-2xl text-white font-semibold tracking-wide">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-400 mb-1 font-light">Email Confirmation Sent To</p>
                            <p class="text-lg text-white">{{ $order->email }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-400 mb-1 font-light">Quantity</p>
                            <p class="text-lg text-white">{{ $order->quantity }} {{ Str::plural('unit', $order->quantity) }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-400 mb-1 font-light">Total Amount</p>
                            <p class="text-3xl text-white font-semibold tracking-wide">${{ number_format($order->total, 2) }}</p>
                            <p class="text-sm text-gray-500 mt-1">Free shipping included</p>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        @if($order->shipping_address)
                        <div>
                            <p class="text-sm text-gray-400 mb-2 font-light">Shipping Address</p>
                            <div class="text-white space-y-1">
                                <p>{{ $order->shipping_address['name'] }}</p>
                                <p>{{ $order->shipping_address['line1'] }}</p>
                                @if($order->shipping_address['line2'])
                                    <p>{{ $order->shipping_address['line2'] }}</p>
                                @endif
                                <p>
                                    {{ $order->shipping_address['city'] }},
                                    {{ $order->shipping_address['state'] }}
                                    {{ $order->shipping_address['postal_code'] }}
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- What's Next -->
            <div class="card-feature mb-8">
                <h3 class="text-2xl font-semibold text-white mb-6 tracking-wide">What Happens Next?</h3>
                <div class="space-y-4">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-white/10 flex items-center justify-center">
                            <span class="text-white font-bold">1</span>
                        </div>
                        <div>
                            <p class="text-white font-semibold">Order Processing</p>
                            <p class="text-gray-400 text-sm font-light">We'll prepare your VisorPlate(s) for shipment within 1-2 business days.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-white/10 flex items-center justify-center">
                            <span class="text-white font-bold">2</span>
                        </div>
                        <div>
                            <p class="text-white font-semibold">Shipping Confirmation</p>
                            <p class="text-gray-400 text-sm font-light">You'll receive tracking information via email as soon as your order ships.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-white/10 flex items-center justify-center">
                            <span class="text-white font-bold">3</span>
                        </div>
                        <div>
                            <p class="text-white font-semibold">Delivery (3-7 days)</p>
                            <p class="text-gray-400 text-sm font-light">Your VisorPlate will arrive ready to install. Check your email for installation instructions!</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Check Email Reminder -->
            <div class="bg-blue-900/20 border border-blue-600/30 rounded-xl p-6 mb-8">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-400 mt-1" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                    </svg>
                    <div>
                        <p class="text-blue-200 font-semibold mb-1">Check Your Email</p>
                        <p class="text-blue-300 text-sm font-light">
                            We've sent order details and tracking information to {{ $order->email }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}" class="btn-primary-luxury text-center">
                    Return to Homepage
                </a>
                <!-- Secondary Button (Not needed for now)
                <a href="{{ route('contact') }}" class="btn-secondary text-center">
                    Contact Support
                </a> -->
            </div>

            <!-- Social Share (Optional) -->
            <div class="mt-8 text-center">
                <p class="text-gray-400 mb-4 font-light">Love VisorPlate? Share with fellow car enthusiasts!</p>
                <div class="flex justify-center gap-4">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Subtle fade-in animation for success page */
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
