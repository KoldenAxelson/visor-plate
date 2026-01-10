<div class="min-h-screen">
    <!-- Hero Section
    <section class="pt-32 pb-16 premium-grain" style="background-color: var(--bg-luxury-black);">
        <div class="container-site">
            <div class="text-center mb-12">
                <div class="inline-block mb-6">
                    <span class="badge-copper-blur">
                        GET IN TOUCH
                    </span>
                </div>
                <h1 class="text-hero mb-6">
                    <span class="text-white">Let's Talk About Your</span><br>
                    <span class="text-gradient-copper">VisorPlate Needs</span>
                </h1>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto font-light tracking-wide">
                    Whether you have a question, need support, or want to discuss wholesale pricing — we're here to help.
                </p>
            </div>
        </div>
    </section>
    -->

    <!-- Form Section -->
    <section class="section-standard bg-linear-to-b from-black to-gray-900">
        <div class="container-site">
            <div class="max-w-4xl mx-auto">
                <!-- Minimal Topper --> <!--
                <div class="text-center mb-3">
                    <div class="inline-block mb-6">
                        <span class="badge-copper-blur">
                            GET IN TOUCH
                        </span>
                    </div>
                </div> -->

                @if($submitted)
                    <!-- Success Message -->
                    <div class="glass-card p-12 text-center"
                         x-data="{ show: true }"
                         x-show="show"
                         x-init="window.scrollTo({top: 0, behavior: 'smooth'})"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100">

                        <div class="w-20 h-20 mx-auto mb-6 rounded-full flex items-center justify-center"
                             style="background: linear-gradient(135deg, var(--accent-copper), var(--accent-gold));">
                            <svg class="w-10 h-10 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>

                        <h2 class="text-4xl font-light text-white mb-4 tracking-luxury">
                            Message Sent Successfully!
                        </h2>
                        <p class="text-xl text-gray-300 mb-8 font-light">
                            Thank you for reaching out. We'll get back to you within 24 hours.
                        </p>

                        <button wire:click="resetForm" class="btn-primary-luxury">
                            Send Another Message
                        </button>
                    </div>

                @else
                    <!-- Contact Form -->
                    <form wire:submit.prevent="submit" class="space-y-8">

                        <!-- Honeypot (spam protection) -->
                        <input type="text" wire:model="honeypot" style="display:none" tabindex="-1" autocomplete="off">

                        <!-- Inquiry Type Toggle -->
                        <div class="glass-card p-8">
                            <label class="label-standard mb-6">What can we help you with?</label>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <button type="button"
                                        wire:click="$set('inquiry_type', 'general')"
                                        class="p-6 rounded-2xl transition-all duration-300 text-left border-2"
                                        :class="{
                                            'bg-white/10 border-[var(--accent-copper)]': @js($inquiry_type === 'general'),
                                            'bg-white/5 border-white/10 hover:bg-white/8': @js($inquiry_type !== 'general')
                                        }">
                                    <div class="flex items-start gap-4">
                                        <div class="shrink-0 w-12 h-12 rounded-xl flex items-center justify-center"
                                             :style="@js($inquiry_type === 'general') ? 'background: linear-gradient(135deg, var(--accent-copper), var(--accent-gold));' : 'background: rgba(255,255,255,0.1);'">
                                            <svg class="w-6 h-6" :class="@js($inquiry_type === 'general') ? 'text-black' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-semibold text-white mb-2 tracking-wide">General Inquiry</h3>
                                            <p class="text-sm text-gray-400 font-light">Questions, support, or feedback</p>
                                        </div>
                                    </div>
                                </button>

                                <button type="button"
                                        wire:click="$set('inquiry_type', 'wholesale')"
                                        class="p-6 rounded-2xl transition-all duration-300 text-left border-2"
                                        :class="{
                                            'bg-white/10 border-[var(--accent-copper)]': @js($inquiry_type === 'wholesale'),
                                            'bg-white/5 border-white/10 hover:bg-white/8': @js($inquiry_type !== 'wholesale')
                                        }">
                                    <div class="flex items-start gap-4">
                                        <div class="shrink-0 w-12 h-12 rounded-xl flex items-center justify-center"
                                             :style="@js($inquiry_type === 'wholesale') ? 'background: linear-gradient(135deg, var(--accent-copper), var(--accent-gold));' : 'background: rgba(255,255,255,0.1);'">
                                            <svg class="w-6 h-6" :class="@js($inquiry_type === 'wholesale') ? 'text-black' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-semibold text-white mb-2 tracking-wide">Wholesale Inquiry</h3>
                                            <p class="text-sm text-gray-400 font-light">Bulk orders (100+ units)</p>
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="glass-card p-8 space-y-6">
                            <h3 class="text-2xl font-light text-white mb-6 tracking-luxury">Contact Information</h3>

                            <!-- Name -->
                            <div>
                                <label class="label-standard">Full Name *</label>
                                <input type="text"
                                       wire:model.blur="name"
                                       class="input-standard @error('name') border-red-500 @enderror"
                                       placeholder="John Smith">
                                @error('name')
                                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Email -->
                                <div>
                                    <label class="label-standard">Email Address *</label>
                                    <input type="email"
                                           wire:model.blur="email"
                                           class="input-standard @error('email') border-red-500 @enderror"
                                           placeholder="john@example.com">
                                    @error('email')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div>
                                    <label class="label-standard">Phone Number</label>
                                    <input type="tel"
                                           wire:model.blur="phone"
                                           class="input-standard @error('phone') border-red-500 @enderror"
                                           placeholder="(555) 123-4567">
                                    @error('phone')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Wholesale-Specific Fields -->
                        @if($inquiry_type === 'wholesale')
                            <div class="glass-card p-8 space-y-6"
                                 x-data
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform translate-y-4"
                                 x-transition:enter-end="opacity-100 transform translate-y-0">

                                <h3 class="text-2xl font-light text-white mb-6 tracking-luxury">Wholesale Details</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Company -->
                                    <div>
                                        <label class="label-standard">Company Name *</label>
                                        <input type="text"
                                               wire:model.blur="company"
                                               class="input-standard @error('company') border-red-500 @enderror"
                                               placeholder="Acme Car Dealership">
                                        @error('company')
                                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Quantity -->
                                    <div>
                                        <label class="label-standard">Estimated Quantity *</label>
                                        <input type="number"
                                               wire:model.blur="quantity"
                                               class="input-standard @error('quantity') border-red-500 @enderror"
                                               placeholder="200"
                                               min="200">
                                        @error('quantity')
                                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                        <p class="mt-2 text-sm text-gray-400">Minimum order: 100 units</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Message -->
                        <div class="glass-card p-8">
                            <label class="label-standard">Your Message *</label>
                            <textarea wire:model.blur="message"
                                      rows="6"
                                      class="input-standard resize-none @error('message') border-red-500 @enderror"
                                      placeholder="Tell us how we can help you..."></textarea>
                            @error('message')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-center">
                            <button type="submit"
                                    class="btn-primary-luxury"
                                    :disabled="@js($sending)">
                                <span wire:loading.remove wire:target="submit">
                                    Send Message
                                </span>
                                <span wire:loading wire:target="submit" class="flex items-center gap-3 justify-center">
                                    <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Sending...
                                </span>
                            </button>
                        </div>

                        <!-- Error Message -->
                        @if (session()->has('error'))
                            <div class="glass-card p-6 border-2 border-red-500/30">
                                <p class="text-red-400 text-center">{{ session('error') }}</p>
                            </div>
                        @endif
                    </form>
                @endif
            </div>
        </div>
    </section>

    <!-- Contact Info Cards -->
    <section class="section-standard bg-black">
        <div class="container-site">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">

                <!-- Email -->
                <div class="card-feature text-center">
                    <div class="w-16 h-16 mx-auto mb-6 rounded-2xl flex items-center justify-center"
                         style="background: linear-gradient(135deg, var(--accent-copper), var(--accent-gold));">
                        <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-3 tracking-wide">Email</h3>
                    <p class="text-gray-400 font-light">contact@visorplate.com</p>
                </div>

                <!-- Phone -->
                <div class="card-feature text-center">
                    <div class="w-16 h-16 mx-auto mb-6 rounded-2xl flex items-center justify-center"
                         style="background: linear-gradient(135deg, var(--accent-copper), var(--accent-gold));">
                        <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-3 tracking-wide">Phone</h3>
                    <p class="text-gray-400 font-light">(555) 555-5555</p>
                </div>

                <!-- Hours -->
                <div class="card-feature text-center">
                    <div class="w-16 h-16 mx-auto mb-6 rounded-2xl flex items-center justify-center"
                         style="background: linear-gradient(135deg, var(--accent-copper), var(--accent-gold));">
                        <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-3 tracking-wide">Hours</h3>
                    <p class="text-gray-400 font-light">Mon-Fri: 9AM - 6PM EST</p>
                </div>

            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="section-standard bg-linear-to-b from-gray-900 to-black">
        <div class="container-site">
            <div class="text-center mb-16">
                <h2 class="text-section mb-6">
                    <span class="text-white">Quick</span><br>
                    <span class="text-gradient-copper">Answers</span>
                </h2>
            </div>

            <div class="max-w-3xl mx-auto space-y-4">
                <div class="glass-card p-6">
                    <h3 class="text-lg font-semibold text-white mb-2 tracking-wide">How long does shipping take?</h3>
                    <p class="text-gray-400 font-light">Most orders ship within 1-2 business days and arrive within 3-5 days via USPS Priority Mail.</p>
                </div>

                <div class="glass-card p-6">
                    <h3 class="text-lg font-semibold text-white mb-2 tracking-wide">Do you offer international shipping?</h3>
                    <p class="text-gray-400 font-light">Currently we only ship within the United States. International shipping coming soon!</p>
                </div>

                <div class="glass-card p-6">
                    <h3 class="text-lg font-semibold text-white mb-2 tracking-wide">What's your return policy?</h3>
                    <p class="text-gray-400 font-light">We offer a 30-day money-back guarantee. If you're not satisfied, return it for a full refund.</p>
                </div>

                <div class="glass-card p-6">
                    <h3 class="text-lg font-semibold text-white mb-2 tracking-wide">Can I order custom quantities?</h3>
                    <p class="text-gray-400 font-light">Yes! Wholesale orders of 100+ units are available at discounted pricing. Use the form above to inquire.</p>
                </div>
            </div>
        </div>
    </section>
</div>
