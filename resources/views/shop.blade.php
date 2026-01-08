@extends('layouts.app')

@section('title', 'Shop - Get Your Visor Plate')

@section('content')
<!-- Shop Hero -->
<section class="pt-32 pb-16 bg-linear-to-b from-black to-gray-900">
    <div class="container-site">
        <div class="text-center mb-12">
            <div class="inline-block mb-6">
                <span class="badge-red">
                    PREMIUM NO-DRILL SOLUTION
                </span>
            </div>
            <h1 class="text-section mb-6">
                <span class="text-gradient-red">Visor Plate</span>
            </h1>
            <p class="text-2xl text-gray-300 max-w-3xl mx-auto">
                Protect your bumper. Stay legal. Remove anytime.
            </p>
        </div>
    </div>
</section>

<!-- Product Section -->
<section class="section-compact bg-gray-900">
    <div class="container-site">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">

            <!-- Left: Product Carousel -->
            <div x-data="productCarousel()" class="sticky top-24">
                <!-- Main Image Display -->
                <div class="relative rounded-3xl overflow-hidden border-2 border-gray-800 shadow-2xl mb-6 bg-black">
                    <div class="relative aspect-square">
                        <template x-for="(image, index) in images" :key="index">
                            <div
                                x-show="currentIndex === index"
                                x-transition:enter="transition ease-out duration-500"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                class="absolute inset-0 flex items-center justify-center p-8"
                            >
                                <img :src="`{{ asset('images') }}/${image}`" :alt="`Product view ${index + 1}`" class="max-w-full max-h-full object-contain">
                            </div>
                        </template>
                    </div>

                    <!-- Navigation Arrows -->
                    <button @click="prev()" class="btn-icon absolute left-4 top-1/2 transform -translate-y-1/2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>

                    <button @click="next()" class="btn-icon absolute right-4 top-1/2 transform -translate-y-1/2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>

                    <!-- Image Counter -->
                    <div class="absolute bottom-4 right-4 bg-black/80 backdrop-blur-sm px-3 py-1 rounded-full border border-gray-700">
                        <span class="text-white text-sm font-bold" x-text="`${currentIndex + 1} / ${images.length}`"></span>
                    </div>
                </div>

                <!-- Thumbnail Navigation -->
                <div class="grid grid-cols-5 gap-3">
                    <template x-for="(image, index) in images" :key="index">
                        <button
                            @click="goTo(index)"
                            class="aspect-square rounded-xl overflow-hidden border-2 transition-all duration-300"
                            :class="currentIndex === index ? 'border-red-600 opacity-100' : 'border-gray-800 opacity-50 hover:opacity-75 hover:border-gray-700'"
                        >
                            <img :src="`{{ asset('images') }}/${image}`" :alt="`Thumbnail ${index + 1}`" class="w-full h-full object-cover">
                        </button>
                    </template>
                </div>
            </div>

            <!-- Right: Product Info & Checkout -->
            <div class="space-y-8">
                <!-- Product Title & Price -->
                <div>
                    <h2 class="text-4xl md:text-5xl font-black text-white mb-4">Visor Plate™</h2>
                    <div class="flex items-baseline gap-4 mb-6">
                        <span class="text-6xl font-black text-white">$35</span>
                        <span class="text-2xl text-gray-400 line-through">$200 ticket</span>
                    </div>
                    <p class="text-xl text-gray-300 leading-relaxed">
                        The premium velcro visor solution that displays your front license plate legally without drilling a single hole in your bumper.
                    </p>
                </div>

                <!-- Key Benefits -->
                <div class="card-info space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="icon-check mt-1">
                            <span class="text-white font-bold text-sm">✓</span>
                        </div>
                        <div>
                            <span class="text-white font-semibold">No Drilling Required</span>
                            <p class="text-gray-400 text-sm">Keep your bumper pristine. Zero permanent damage.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="icon-check mt-1">
                            <span class="text-white font-bold text-sm">✓</span>
                        </div>
                        <div>
                            <span class="text-white font-semibold">60-Second Installation</span>
                            <p class="text-gray-400 text-sm">Attach velcro, mount on visor. Done.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="icon-check mt-1">
                            <span class="text-white font-bold text-sm">✓</span>
                        </div>
                        <div>
                            <span class="text-white font-semibold">Perfect for Show Cars</span>
                            <p class="text-gray-400 text-sm">Remove in seconds for car meets and shows.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="icon-check mt-1">
                            <span class="text-white font-bold text-sm">✓</span>
                        </div>
                        <div>
                            <span class="text-white font-semibold">Legally Compliant</span>
                            <p class="text-gray-400 text-sm">Meets requirements in all 29 front-plate states.</p>
                        </div>
                    </div>
                </div>

                <!-- What's Included -->
                <div class="card-info">
                    <h3 class="text-2xl font-bold text-white mb-4">What's Included</h3>
                    <ul class="space-y-3 text-gray-300">
                        <li class="flex items-center gap-3">
                            <span class="text-red-500">•</span>
                            <span>1x Visor Plate mounting system</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-red-500">•</span>
                            <span>Industrial-strength velcro strips</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-red-500">•</span>
                            <span>Easy installation instructions</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-red-500">•</span>
                            <span>Free shipping (US only)</span>
                        </li>
                    </ul>
                </div>

                <!-- Quantity Selector -->
                <div class="card-info">
                    <label class="label-standard">Quantity</label>
                    <div class="flex items-center gap-4">
                        <button class="btn-quantity">
                            −
                        </button>
                        <input type="number" value="1" min="1" class="input-quantity">
                        <button class="btn-quantity">
                            +
                        </button>
                    </div>
                    <p class="text-sm text-gray-400 mt-3">
                        Need bulk pricing? <a href="#" class="text-red-500 hover:text-red-400 underline">Contact us for wholesale</a>
                    </p>
                </div>

                <!-- Buy Now Button -->
                <button class="btn-primary w-full py-6 text-2xl">
                    Buy Now - $35 →
                </button>

                <!-- Trust Badges -->
                <div class="flex items-center justify-center gap-6 pt-4 border-t border-gray-800">
                    <div class="flex items-center gap-2 text-gray-400">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm">Free Shipping</span>
                    </div>
                    <div class="flex items-center gap-2 text-gray-400">
                        <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"></path>
                        </svg>
                        <span class="text-sm">Fast Delivery</span>
                    </div>
                    <div class="flex items-center gap-2 text-gray-400">
                        <svg class="w-5 h-5 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-sm">Secure Checkout</span>
                    </div>
                </div>

                <!-- Money Back Guarantee -->
                <div class="bg-linear-to-r from-red-900/20 to-red-800/10 border border-red-600/30 rounded-2xl p-6 text-center">
                    <h4 class="text-xl font-bold text-white mb-2">30-Day Money Back Guarantee</h4>
                    <p class="text-red-200">Not satisfied? Return it for a full refund. No questions asked.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Visor Plate -->
<section class="section-standard bg-black">
    <div class="container-site">
        <h2 class="text-4xl md:text-5xl font-black text-center mb-16">
            <span class="text-white">Why Car Enthusiasts</span>
            <span class="text-gradient-red"> Love Visor Plate</span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="card-feature text-center">
                <div class="w-16 h-16 bg-red-600/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <span class="text-4xl">🎯</span>
                </div>
                <h3 class="text-2xl font-bold text-white mb-3">Perfect Fit</h3>
                <p class="text-gray-400">
                    Works with any standard license plate and sun visor. Universal compatibility guaranteed.
                </p>
            </div>

            <div class="card-feature text-center">
                <div class="w-16 h-16 bg-red-600/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <span class="text-4xl">⚡</span>
                </div>
                <h3 class="text-2xl font-bold text-white mb-3">Quick Release</h3>
                <p class="text-gray-400">
                    Remove in seconds for car shows, then reattach just as fast for daily driving.
                </p>
            </div>

            <div class="card-feature text-center">
                <div class="w-16 h-16 bg-red-600/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <span class="text-4xl">💪</span>
                </div>
                <h3 class="text-2xl font-bold text-white mb-3">Industrial Strength</h3>
                <p class="text-gray-400">
                    Heavy-duty velcro holds your plate securely at highway speeds. Won't budge until you want it to.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section-standard bg-linear-to-b from-black to-gray-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl md:text-5xl font-black text-white mb-6">
            Ready to Protect Your Ride?
        </h2>
        <p class="text-xl text-gray-400 mb-8">
            Join thousands of car enthusiasts who refuse to drill holes in their bumpers
        </p>
        <a href="#" class="btn-primary inline-block">
            Get Yours Today - $35 →
        </a>
    </div>
</section>

<!-- Alpine.js Product Carousel Component -->
<script>
function productCarousel() {
    return {
        currentIndex: 0,
        images: [
            'Display.jpg',
            'Front-in.jpg',
            'Slide.jpg',
            'Back.jpg',
            'Install.jpg'
        ],
        next() {
            this.currentIndex = (this.currentIndex + 1) % this.images.length;
        },
        prev() {
            this.currentIndex = this.currentIndex === 0 ? this.images.length - 1 : this.currentIndex - 1;
        },
        goTo(index) {
            this.currentIndex = index;
        }
    }
}
</script>
@endsection
