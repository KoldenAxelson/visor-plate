@extends('layouts.app')

@section('title', 'Visor Plate - Premium No-Drill Front Plate Solution for Show Cars')

@section('content')
<!-- MASSIVE Hero Section -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Background Image with Overlay - ANCHORED TO TOP -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/hero.jpg') }}" alt="Visor Plate Hero" class="w-full h-full object-cover object-top">
        <div class="absolute inset-0 bg-linear-to-b from-black/80 via-black/60 to-black"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 container-site py-32 text-center">
        <div class="inline-block mb-6">
            <span class="badge-red-blur">
                FOR SHOW CARS & ENTHUSIASTS
            </span>
        </div>

        <h1 class="text-hero mb-8 leading-tight">
            <span class="text-white">Preserve Your</span><br>
            <span class="text-gradient-red">Pristine Bumper</span>
        </h1>

        <p class="text-xl md:text-3xl text-gray-300 mb-12 max-w-4xl mx-auto leading-relaxed">
            The <strong class="text-white">premium velcro visor solution</strong> that keeps your front plate legal
            without drilling a single hole. <span class="text-red-500">No damage. Ever.</span>
        </p>

        <div class="flex flex-col sm:flex-row gap-6 justify-center mb-16">
            <a href="{{ route('shop') }}" class="group btn-primary">
                Get Visor Plate - $35
                <span class="inline-block ml-2 group-hover:translate-x-1 transition-transform">→</span>
            </a>
            <a href="#how-it-works" class="btn-secondary">
                See Installation
            </a>
        </div>

        <!-- Social Proof Pills -->
        <div class="flex flex-wrap gap-6 justify-center text-sm">
            <div class="trust-badge">
                <span class="text-red-500 text-xl">✓</span>
                <span>No Drilling Required</span>
            </div>
            <div class="trust-badge">
                <span class="text-red-500 text-xl">✓</span>
                <span>60 Second Install</span>
            </div>
            <div class="trust-badge">
                <span class="text-red-500 text-xl">✓</span>
                <span>Perfect for Show Cars</span>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-10 animate-bounce">
        <div class="w-6 h-10 border-2 border-gray-500 rounded-full flex justify-center">
            <div class="w-1 h-3 bg-red-600 rounded-full mt-2"></div>
        </div>
    </div>
</section>

<!-- The Enthusiast's Dilemma -->
<section class="section-hero bg-linear-to-b from-black to-gray-900">
    <div class="container-site">
        <div class="text-center mb-20">
            <h2 class="text-section mb-6">
                <span class="text-white">The Car Enthusiast's</span><br>
                <span class="text-gradient-red">Impossible Choice</span>
            </h2>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                You spent thousands building your dream car. Why compromise its looks for a license plate?
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Problem 1 - Drilling -->
            <div class="card-feature group">
                <div class="w-16 h-16 bg-red-600/20 rounded-xl flex items-center justify-center mb-6 transition-all duration-300 group-hover:bg-red-600/30">
                    <span class="text-4xl">❌</span>
                </div>
                <h3 class="text-3xl font-bold mb-4 text-white">Permanent Drilling</h3>
                <p class="text-gray-400 text-lg leading-relaxed">
                    Ruin your bumper's clean lines with ugly holes. Once drilled, it's permanent damage to your pride and joy.
                </p>
            </div>

            <!-- Problem 2 - Dashboard -->
            <div class="card-feature group">
                <div class="w-16 h-16 bg-red-600/20 rounded-xl flex items-center justify-center mb-6 transition-all duration-300 group-hover:bg-red-600/30">
                    <span class="text-4xl">🤮</span>
                </div>
                <h3 class="text-3xl font-bold mb-4 text-white">Dashboard Props</h3>
                <p class="text-gray-400 text-lg leading-relaxed">
                    Tacky, unprofessional, and screams "I don't care." Plus, it's technically illegal in most states.
                </p>
            </div>

            <!-- Problem 3 - No Plate -->
            <div class="card-feature group">
                <div class="w-16 h-16 bg-red-600/20 rounded-xl flex items-center justify-center mb-6 transition-all duration-300 group-hover:bg-red-600/30">
                    <span class="text-4xl">🚨</span>
                </div>
                <h3 class="text-3xl font-bold mb-4 text-white">Risk The Ticket</h3>
                <p class="text-gray-400 text-lg leading-relaxed">
                    Up to $200 fines. Repeat violations affect insurance. Not worth the risk when there's a better way.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- The Solution - Premium Product Showcase -->
<section id="features" class="section-hero bg-linear-to-b from-gray-900 to-black relative overflow-hidden">
    <div class="relative container-site">
        <div class="text-center mb-20">
            <div class="inline-block mb-6">
                <span class="badge-red">
                    THE SOLUTION
                </span>
            </div>
            <h2 class="text-section mb-6">
                <span class="text-gradient-red">Visor Plate</span>
            </h2>
            <p class="text-2xl text-gray-300 max-w-3xl mx-auto">
                Zero compromise. Zero damage. Maximum style.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-20">
            <!-- Product Image -->
            <div class="relative">
                <img src="{{ asset('images/Display.jpg') }}" alt="Visor Plate Product" class="relative rounded-3xl shadow-2xl border border-gray-800">
            </div>

            <!-- Features -->
            <div class="space-y-8">
                <div class="group">
                    <div class="flex gap-6 items-start">
                        <div class="step-number">
                            1
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold mb-3 text-white">Zero Drilling, Ever</h3>
                            <p class="text-gray-400 text-lg leading-relaxed">
                                Industrial-strength velcro keeps your plate secure while keeping your bumper pristine. Remove it anytime for shows.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="group">
                    <div class="flex gap-6 items-start">
                        <div class="step-number">
                            2
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold mb-3 text-white">Show-Ready Flexibility</h3>
                            <p class="text-gray-400 text-lg leading-relaxed">
                                Heading to a car meet? Peel it off in seconds. Daily commute? Slap it back on. Takes literally 60 seconds.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="group">
                    <div class="flex gap-6 items-start">
                        <div class="step-number">
                            3
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold mb-3 text-white">Legally Compliant</h3>
                            <p class="text-gray-400 text-lg leading-relaxed">
                                Meets requirements in all 29 front-plate states. Drive anywhere with confidence. No more ticket anxiety.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="group">
                    <div class="flex gap-6 items-start">
                        <div class="step-number">
                            4
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold mb-3 text-white">Universal Fit</h3>
                            <p class="text-gray-400 text-lg leading-relaxed">
                                Works with any standard license plate and sun visor. From daily drivers to exotic show cars.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="text-center">
            <a href="{{ route('shop') }}" class="btn-primary inline-block">
                Protect Your Ride - $35 →
            </a>
        </div>
    </div>
</section>

<!-- Carousel Gallery Section -->
<section id="gallery" class="section-hero bg-black">
    <div class="container-site">
        <div class="text-center mb-20">
            <h2 class="text-section mb-6">
                <span class="text-white">See It On</span><br>
                <span class="text-gradient-red">Real Enthusiast Cars</span>
            </h2>
            <p class="text-xl text-gray-400">
                From show cars to daily drivers, Visor Plate keeps them all looking clean
            </p>
        </div>

        <!-- Alpine.js Carousel -->
        <div x-data="carousel()" class="relative">
            <!-- Main Carousel Container -->
            <div class="relative rounded-3xl overflow-hidden border-2 border-gray-800 shadow-2xl">
                <!-- Images -->
                <div class="relative aspect-video bg-gray-900">
                    <template x-for="(image, index) in images" :key="index">
                        <div
                            x-show="currentIndex === index"
                            x-transition:enter="transition ease-out duration-500"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-500"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="absolute inset-0"
                        >
                            <img :src="`{{ asset('images') }}/${image}`" :alt="`Visor Plate on Car ${index + 1}`" class="w-full h-full object-cover">
                        </div>
                    </template>
                </div>

                <!-- Previous Button -->
                <button @click="prev()" class="btn-icon absolute left-4 top-1/2 transform -translate-y-1/2 z-10">
                    <svg class="w-6 h-6 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>

                <!-- Next Button -->
                <button @click="next()" class="btn-icon absolute right-4 top-1/2 transform -translate-y-1/2 z-10">
                    <svg class="w-6 h-6 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>

                <!-- Slide Counter -->
                <div class="absolute bottom-6 left-6 bg-black/80 backdrop-blur-sm px-4 py-2 rounded-full border border-gray-700 z-10">
                    <span class="text-white font-bold" x-text="`${currentIndex + 1} / ${images.length}`"></span>
                </div>
            </div>

            <!-- Dot Indicators -->
            <div class="flex justify-center gap-3 mt-8">
                <template x-for="(image, index) in images" :key="index">
                    <button
                        @click="goTo(index)"
                        class="transition-all duration-300"
                        :class="currentIndex === index ? 'w-12 h-3 bg-linear-to-r from-red-600 to-red-700' : 'w-3 h-3 bg-gray-700 hover:bg-gray-600'"
                        class="rounded-full"
                    ></button>
                </template>
            </div>

            <!-- Thumbnail Strip (Optional - for desktop) -->
            <div class="hidden lg:grid grid-cols-8 gap-4 mt-8">
                <template x-for="(image, index) in images" :key="index">
                    <button
                        @click="goTo(index)"
                        class="aspect-video rounded-xl overflow-hidden border-2 transition-all duration-300"
                        :class="currentIndex === index ? 'border-red-600 opacity-100' : 'border-gray-800 opacity-50 hover:opacity-75'"
                    >
                        <img :src="`{{ asset('images') }}/${image}`" :alt="`Thumbnail ${index + 1}`" class="w-full h-full object-cover">
                    </button>
                </template>
            </div>
        </div>

        <!-- Additional Product Detail Images Below Carousel -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mt-12">
            <div class="rounded-2xl overflow-hidden border border-gray-800 hover:border-red-600/50 transition-all duration-300 shadow-xl">
                <img src="{{ asset('images/Install.jpg') }}" alt="Installation View" class="w-full h-full object-cover">
            </div>
            <div class="rounded-2xl overflow-hidden border border-gray-800 hover:border-red-600/50 transition-all duration-300 shadow-xl">
                <img src="{{ asset('images/Front-in.jpg') }}" alt="Front View" class="w-full h-full object-cover">
            </div>
            <div class="rounded-2xl overflow-hidden border border-gray-800 hover:border-red-600/50 transition-all duration-300 shadow-xl">
                <img src="{{ asset('images/Slide.jpg') }}" alt="Sliding View" class="w-full h-full object-cover">
            </div>
            <div class="rounded-2xl overflow-hidden border border-gray-800 hover:border-red-600/50 transition-all duration-300 shadow-xl">
                <img src="{{ asset('images/Back.jpg') }}" alt="Back View - Velcro System" class="w-full h-full object-cover">
            </div>
        </div>
    </div>
</section>

<!-- State Checker Tool -->
<section id="state-checker" class="section-hero bg-linear-to-b from-black to-gray-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-5xl md:text-6xl font-black mb-4">
                <span class="text-white">Does Your State</span><br>
                <span class="text-gradient-red">Require Front Plates?</span>
            </h2>
            <p class="text-xl text-gray-400">
                Find out if you need a front license plate (spoiler: even if you don't, you might need one for toll roads)
            </p>
        </div>

        <!-- Alpine.js State Checker -->
        <div x-data="stateChecker()" class="card-info shadow-2xl">
            <!-- State Dropdown -->
            <div class="mb-8">
                <label class="label-standard">Select Your State:</label>
                <select x-model="selectedState" class="input-standard">
                    <option value="">-- Choose a state --</option>
                    <template x-for="state in states" :key="state.abbr">
                        <option :value="state.abbr" x-text="state.name"></option>
                    </template>
                </select>
            </div>

            <!-- Result Display -->
            <div x-show="selectedState" x-transition class="mt-8">
                <div x-show="getStateInfo().required" class="bg-linear-to-br from-red-900/30 to-red-800/20 border-2 border-red-600/50 rounded-2xl p-8">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-12 h-12 bg-red-600 rounded-xl flex items-center justify-center shrink-0">
                            <span class="text-2xl">⚠️</span>
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold text-white mb-3">Front Plate Required</h3>
                            <p class="text-red-100 text-lg mb-3">
                                <span x-text="getStateInfo().name"></span> requires both front and rear license plates.
                            </p>
                            <p class="text-red-200 font-semibold text-xl">
                                Without a front plate = up to $200 in fines
                            </p>
                        </div>
                    </div>
                </div>

                <div x-show="!getStateInfo().required" class="bg-linear-to-br from-gray-900 to-black border-2 border-gray-700 rounded-2xl p-8">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-12 h-12 bg-gray-700 rounded-xl flex items-center justify-center shrink-0">
                            <span class="text-2xl">ℹ️</span>
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold text-white mb-3">Rear Plate Only</h3>
                            <p class="text-gray-300 text-lg mb-3">
                                <span x-text="getStateInfo().name"></span> only requires a rear plate.
                            </p>
                            <p class="text-yellow-400 font-semibold text-lg">
                                ⚠️ BUT crossing state lines or using toll roads may still require a front plate!
                            </p>
                        </div>
                    </div>
                </div>

                <!-- CTA -->
                <div class="mt-8 text-center">
                    <a href="#pricing" class="btn-primary inline-block">
                        Get Protected - $35 →
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section id="how-it-works" class="section-hero bg-linear-to-b from-gray-900 to-black">
    <div class="container-site">
        <div class="text-center mb-20">
            <h2 class="text-section mb-6">
                <span class="text-white">Install In</span><br>
                <span class="text-gradient-red">Under 60 Seconds</span>
            </h2>
            <p class="text-xl text-gray-400 max-w-2xl mx-auto">
                Seriously. It's that easy. No tools, no stress, no permanent modifications.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <!-- Step 1 -->
            <div class="text-center group">
                <div class="relative mb-8">
                    <div class="step-number mx-auto mb-6 shadow-xl text-5xl w-24 h-24 rounded-3xl">
                        1
                    </div>
                    <div class="aspect-video bg-gray-900 rounded-2xl overflow-hidden border-2 border-gray-800 group-hover:border-red-600 transition-colors duration-300">
                        <img src="{{ asset('images/Back.jpg') }}" alt="Step 1" class="w-full h-full object-cover">
                    </div>
                </div>
                <h3 class="text-3xl font-bold mb-4 text-white">Attach Velcro</h3>
                <p class="text-gray-400 text-lg">
                    Peel and stick the velcro backing to your license plate. Strong adhesive that won't damage the plate.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="text-center group">
                <div class="relative mb-8">
                    <div class="step-number mx-auto mb-6 shadow-xl text-5xl w-24 h-24 rounded-3xl">
                        2
                    </div>
                    <div class="aspect-video bg-gray-900 rounded-2xl overflow-hidden border-2 border-gray-800 group-hover:border-red-600 transition-colors duration-300">
                        <img src="{{ asset('images/Install.jpg') }}" alt="Step 2" class="w-full h-full object-cover">
                    </div>
                </div>
                <h3 class="text-3xl font-bold mb-4 text-white">Mount on Visor</h3>
                <p class="text-gray-400 text-lg">
                    Press the plate firmly onto your passenger sun visor. Velcro holds it securely while driving.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="text-center group">
                <div class="relative mb-8">
                    <div class="step-number mx-auto mb-6 shadow-xl text-5xl w-24 h-24 rounded-3xl">
                        3
                    </div>
                    <div class="aspect-video bg-gray-900 rounded-2xl overflow-hidden border-2 border-gray-800 group-hover:border-red-600 transition-colors duration-300">
                        <img src="{{ asset('images/Slide.jpg') }}" alt="Step 3" class="w-full h-full object-cover">
                    </div>
                </div>
                <h3 class="text-3xl font-bold mb-4 text-white">Drive Legally</h3>
                <p class="text-gray-400 text-lg">
                    You're done! Front plate displayed and legal. Remove anytime for shows or when not needed.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Pricing / CTA -->
<section id="pricing" class="section-hero bg-black">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-section mb-6">
                <span class="text-white">Protect Your Investment</span><br>
                <span class="text-gradient-red">For Just $35</span>
            </h2>
            <p class="text-3xl text-gray-300 mb-4">
                <span class="line-through text-gray-600">$200 ticket</span> or <strong class="text-red-500">$35 solution?</strong>
            </p>
            <p class="text-xl text-gray-400">
                One-time purchase. Lifetime of protection.
            </p>
        </div>

        <!-- Premium Pricing Card -->
        <div class="max-w-2xl mx-auto">
            <div class="card-info border-2 border-red-600/50 shadow-2xl">
                <div class="text-center mb-10">
                    <div class="inline-block mb-4">
                        <span class="badge-red">
                            COMPLETE KIT
                        </span>
                    </div>
                    <div class="text-7xl font-black text-white mb-3">$35</div>
                    <div class="text-xl text-gray-400">Premium Product</div>
                </div>

                <div class="space-y-5 mb-10">
                    <div class="flex items-center gap-4">
                        <div class="icon-check">
                            <span class="text-white font-bold">✓</span>
                        </div>
                        <span class="text-white text-lg">Hand-Made in America</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="icon-check">
                            <span class="text-white font-bold">✓</span>
                        </div>
                        <span class="text-white text-lg">High Quality Materials</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="icon-check">
                            <span class="text-white font-bold">✓</span>
                        </div>
                        <span class="text-white text-lg">60-second installation</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="icon-check">
                            <span class="text-white font-bold">✓</span>
                        </div>
                        <span class="text-white text-lg">Works with any standard US license plate</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="icon-check">
                            <span class="text-white font-bold">✓</span>
                        </div>
                        <span class="text-white text-lg">Zero drilling • Zero permanent damage</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="icon-check">
                            <span class="text-white font-bold">✓</span>
                        </div>
                        <span class="text-white text-lg">Perfect for show cars & daily drivers</span>
                    </div>
                </div>

                <a href="{{ route('shop') }}" class="btn-primary w-full py-6 text-2xl block text-center">
                    Get Visor Plate Now →
                </a>

                <p class="text-center text-gray-500 mt-6 text-sm">
                    ✓ Free shipping • ✓ 30-day satisfaction guarantee
                </p>
            </div>
        </div>

        <!-- Final Value Prop -->
        <div class="mt-16 text-center">
            <p class="text-2xl text-gray-400 mb-4">
                Join thousands of car enthusiasts who refuse to compromise
            </p>
            <p class="text-lg text-gray-500">
                Your car deserves better than drill holes.
            </p>
        </div>
    </div>
</section>

<!-- Alpine.js Components -->
<script>
// Carousel Component
function carousel() {
    return {
        currentIndex: 0,
        images: [
            'EDIT_1.jpg',
            'EDIT_2.jpg',
            'EDIT_3.jpg',
            'EDIT_4.jpg',
            'EDIT_5.jpg',
            'EDIT_6.jpg',
            'EDIT_7.jpg',
            'EDIT_8.jpg'
        ],
        interval: null,
        init() {
            // Auto-advance every 5 seconds
            this.startAutoPlay();
        },
        startAutoPlay() {
            this.interval = setInterval(() => {
                this.next();
            }, 5000);
        },
        stopAutoPlay() {
            clearInterval(this.interval);
        },
        next() {
            this.currentIndex = (this.currentIndex + 1) % this.images.length;
            this.resetAutoPlay();
        },
        prev() {
            this.currentIndex = this.currentIndex === 0 ? this.images.length - 1 : this.currentIndex - 1;
            this.resetAutoPlay();
        },
        goTo(index) {
            this.currentIndex = index;
            this.resetAutoPlay();
        },
        resetAutoPlay() {
            this.stopAutoPlay();
            this.startAutoPlay();
        }
    }
}

// State Checker Component
function stateChecker() {
    return {
        selectedState: '',
        states: [
            { name: 'Alabama', abbr: 'AL', required: false },
            { name: 'Alaska', abbr: 'AK', required: false },
            { name: 'Arizona', abbr: 'AZ', required: false },
            { name: 'Arkansas', abbr: 'AR', required: false },
            { name: 'California', abbr: 'CA', required: true },
            { name: 'Colorado', abbr: 'CO', required: true },
            { name: 'Connecticut', abbr: 'CT', required: true },
            { name: 'Delaware', abbr: 'DE', required: false },
            { name: 'Florida', abbr: 'FL', required: false },
            { name: 'Georgia', abbr: 'GA', required: false },
            { name: 'Hawaii', abbr: 'HI', required: true },
            { name: 'Idaho', abbr: 'ID', required: true },
            { name: 'Illinois', abbr: 'IL', required: true },
            { name: 'Indiana', abbr: 'IN', required: false },
            { name: 'Iowa', abbr: 'IA', required: true },
            { name: 'Kansas', abbr: 'KS', required: false },
            { name: 'Kentucky', abbr: 'KY', required: false },
            { name: 'Louisiana', abbr: 'LA', required: false },
            { name: 'Maine', abbr: 'ME', required: true },
            { name: 'Maryland', abbr: 'MD', required: true },
            { name: 'Massachusetts', abbr: 'MA', required: true },
            { name: 'Michigan', abbr: 'MI', required: false },
            { name: 'Minnesota', abbr: 'MN', required: true },
            { name: 'Mississippi', abbr: 'MS', required: false },
            { name: 'Missouri', abbr: 'MO', required: true },
            { name: 'Montana', abbr: 'MT', required: true },
            { name: 'Nebraska', abbr: 'NE', required: true },
            { name: 'Nevada', abbr: 'NV', required: true },
            { name: 'New Hampshire', abbr: 'NH', required: true },
            { name: 'New Jersey', abbr: 'NJ', required: true },
            { name: 'New Mexico', abbr: 'NM', required: false },
            { name: 'New York', abbr: 'NY', required: true },
            { name: 'North Carolina', abbr: 'NC', required: false },
            { name: 'North Dakota', abbr: 'ND', required: true },
            { name: 'Ohio', abbr: 'OH', required: false },
            { name: 'Oklahoma', abbr: 'OK', required: false },
            { name: 'Oregon', abbr: 'OR', required: true },
            { name: 'Pennsylvania', abbr: 'PA', required: false },
            { name: 'Rhode Island', abbr: 'RI', required: true },
            { name: 'South Carolina', abbr: 'SC', required: false },
            { name: 'South Dakota', abbr: 'SD', required: true },
            { name: 'Tennessee', abbr: 'TN', required: false },
            { name: 'Texas', abbr: 'TX', required: true },
            { name: 'Utah', abbr: 'UT', required: false },
            { name: 'Vermont', abbr: 'VT', required: true },
            { name: 'Virginia', abbr: 'VA', required: true },
            { name: 'Washington', abbr: 'WA', required: true },
            { name: 'West Virginia', abbr: 'WV', required: false },
            { name: 'Wisconsin', abbr: 'WI', required: true },
            { name: 'Wyoming', abbr: 'WY', required: true }
        ],
        getStateInfo() {
            return this.states.find(s => s.abbr === this.selectedState) || {};
        }
    }
}
</script>
@endsection
