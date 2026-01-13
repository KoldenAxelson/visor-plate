<div class="min-h-screen">
    <!-- Form Section -->
    <section class="section-standard bg-linear-to-b from-black to-gray-900">
        <div class="container-site">
            <div class="max-w-4xl mx-auto">

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

                        <!-- Inquiry Type Toggle - 2x2 Grid -->
                        <div class="glass-card p-8">
                            <label class="label-standard mb-6">What can we help you with?</label>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- General Inquiry -->
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

                                <!-- Wholesale Inquiry -->
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

                                <!-- Return Request -->
                                <button type="button"
                                        wire:click="$set('inquiry_type', 'return')"
                                        class="p-6 rounded-2xl transition-all duration-300 text-left border-2"
                                        :class="{
                                            'bg-white/10 border-[var(--accent-copper)]': @js($inquiry_type === 'return'),
                                            'bg-white/5 border-white/10 hover:bg-white/8': @js($inquiry_type !== 'return')
                                        }">
                                    <div class="flex items-start gap-4">
                                        <div class="shrink-0 w-12 h-12 rounded-xl flex items-center justify-center"
                                             :style="@js($inquiry_type === 'return') ? 'background: linear-gradient(135deg, var(--accent-copper), var(--accent-gold));' : 'background: rgba(255,255,255,0.1);'">
                                            <svg class="w-6 h-6" :class="@js($inquiry_type === 'return') ? 'text-black' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-semibold text-white mb-2 tracking-wide">Return Request</h3>
                                            <p class="text-sm text-gray-400 font-light">30-day money-back guarantee</p>
                                        </div>
                                    </div>
                                </button>

                                <!-- Add Review -->
                                <button type="button"
                                        wire:click="$set('inquiry_type', 'review')"
                                        class="p-6 rounded-2xl transition-all duration-300 text-left border-2"
                                        :class="{
                                            'bg-white/10 border-[var(--accent-copper)]': @js($inquiry_type === 'review'),
                                            'bg-white/5 border-white/10 hover:bg-white/8': @js($inquiry_type !== 'review')
                                        }">
                                    <div class="flex items-start gap-4">
                                        <div class="shrink-0 w-12 h-12 rounded-xl flex items-center justify-center"
                                             :style="@js($inquiry_type === 'review') ? 'background: linear-gradient(135deg, var(--accent-copper), var(--accent-gold));' : 'background: rgba(255,255,255,0.1);'">
                                            <svg class="w-6 h-6" :class="@js($inquiry_type === 'review') ? 'text-black' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-semibold text-white mb-2 tracking-wide">Add Your Review</h3>
                                            <p class="text-sm text-gray-400 font-light">Share your experience</p>
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
                                               min="100">
                                        @error('quantity')
                                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                        <p class="mt-2 text-sm text-gray-400">Minimum order: 100 units</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Return Request Fields -->
                        @if($inquiry_type === 'return')
                            <div class="glass-card p-8 space-y-6"
                                 x-data
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform translate-y-4"
                                 x-transition:enter-end="opacity-100 transform translate-y-0">
                                <h3 class="text-2xl font-light text-white mb-6 tracking-luxury">Return Details</h3>

                                <!-- Order Number -->
                                <div>
                                    <label class="label-standard">Order Number *</label>
                                    <input type="text"
                                           wire:model.blur="order_number"
                                           class="input-standard @error('order_number') border-red-500 @enderror"
                                           placeholder="e.g., VP-123456">
                                    @error('order_number')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-2 text-sm text-gray-500">Find this in your order confirmation email</p>
                                </div>

                                <!-- Return Reason -->
                                <div>
                                    <label class="label-standard">Reason for Return *</label>
                                    <textarea wire:model.blur="return_reason"
                                              rows="4"
                                              class="input-standard resize-none @error('return_reason') border-red-500 @enderror"
                                              placeholder="Please tell us why you're returning the product..."></textarea>
                                    @error('return_reason')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Photo Upload -->
                                <div>
                                    <label class="label-standard">Product Photo *</label>
                                    <div class="relative">
                                        <input type="file"
                                               wire:model="return_photo"
                                               accept="image/*"
                                               class="hidden"
                                               id="return_photo">
                                        <label for="return_photo"
                                               class="input-standard flex items-center justify-between cursor-pointer @error('return_photo') border-red-500 @enderror">
                                            <span class="text-gray-400">
                                                @if($return_photo)
                                                    {{ $return_photo->getClientOriginalName() }}
                                                @else
                                                    Click to upload photo
                                                @endif
                                            </span>
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </label>
                                    </div>
                                    @error('return_photo')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-2 text-sm text-gray-500">Please upload a clear photo of the product (Max 10MB)</p>

                                    <!-- Photo Preview -->
                                    @if($return_photo)
                                        <div class="mt-4" wire:loading.remove wire:target="return_photo">
                                            <img src="{{ $return_photo->temporaryUrl() }}"
                                                 alt="Return photo preview"
                                                 class="max-w-xs rounded-xl border border-white/10">
                                        </div>
                                    @endif
                                    <div wire:loading wire:target="return_photo" class="mt-4 text-gray-400">
                                        Uploading...
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Review Fields -->
                        @if($inquiry_type === 'review')
                            <div class="glass-card p-8 space-y-6"
                                 x-data
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform translate-y-4"
                                 x-transition:enter-end="opacity-100 transform translate-y-0">
                                <h3 class="text-2xl font-light text-white mb-6 tracking-luxury">Your Review</h3>

                                <!-- Review Title -->
                                <div>
                                    <label class="label-standard">Review Title *</label>
                                    <input type="text"
                                           wire:model.blur="review_title"
                                           class="input-standard @error('review_title') border-red-500 @enderror"
                                           placeholder="e.g., Perfect solution for my show car!">
                                    @error('review_title')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Star Rating (SIMPLE - NO HOVER) -->
                                <div>
                                    <label class="label-standard">Rating *</label>
                                    <div class="flex gap-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <button type="button"
                                                    wire:click="$set('rating', {{ $i }})"
                                                    class="transition-all duration-200">
                                                <svg class="w-10 h-10 transition-colors {{ $rating >= $i ? 'text-[var(--accent-copper)]' : 'text-gray-600' }}"
                                                     fill="currentColor"
                                                     viewBox="0 0 24 24">
                                                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                                </svg>
                                            </button>
                                        @endfor
                                    </div>
                                    @error('rating')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Review Text -->
                                <div>
                                    <label class="label-standard">Your Review *</label>
                                    <textarea wire:model.blur="review_text"
                                              rows="6"
                                              class="input-standard resize-none @error('review_text') border-red-500 @enderror"
                                              placeholder="Tell us about your experience with VisorPlate..."></textarea>
                                    @error('review_text')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Ride Photo Upload (Optional) -->
                                <div>
                                    <label class="label-standard">Photo of Your Ride (Optional)</label>
                                    <div class="relative">
                                        <input type="file"
                                               wire:model="ride_photo"
                                               accept="image/*"
                                               class="hidden"
                                               id="ride_photo">
                                        <label for="ride_photo"
                                               class="input-standard flex items-center justify-between cursor-pointer @error('ride_photo') border-red-500 @enderror">
                                            <span class="text-gray-400">
                                                @if($ride_photo)
                                                    {{ $ride_photo->getClientOriginalName() }}
                                                @else
                                                    Click to upload photo
                                                @endif
                                            </span>
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </label>
                                    </div>
                                    @error('ride_photo')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-2 text-sm text-gray-500">Share a photo of your car with VisorPlate installed (Max 10MB)</p>

                                    <!-- Photo Preview -->
                                    @if($ride_photo)
                                        <div class="mt-4" wire:loading.remove wire:target="ride_photo">
                                            <img src="{{ $ride_photo->temporaryUrl() }}"
                                                 alt="Ride photo preview"
                                                 class="max-w-xs rounded-xl border border-white/10">
                                        </div>
                                    @endif
                                    <div wire:loading wire:target="ride_photo" class="mt-4 text-gray-400">
                                        Uploading...
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Message -->
                        <div class="glass-card p-8">
                            @if($inquiry_type === 'return' || $inquiry_type === 'review')
                                <label class="label-standard">Additional Comments (Optional)</label>
                            @else
                                <label class="label-standard">Your Message *</label>
                            @endif
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
                            <button
                                type="submit"
                                class="btn-primary-luxury btn-with-loading w-80 py-8 text-2xl"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-75 cursor-not-allowed"
                            >
                                <span class="btn-default-text" wire:loading.remove wire:target="submit">
                                    @if($inquiry_type === 'wholesale')
                                        Send Message
                                    @elseif($inquiry_type === 'return')
                                        Submit Return
                                    @elseif($inquiry_type === 'review')
                                        Submit Review
                                    @else
                                        Send Message
                                    @endif
                                </span>
                                <span class="btn-loading-text" wire:loading.flex wire:target="submit">
                                    <svg class="btn-spinner" viewBox="0 0 24 24">
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
