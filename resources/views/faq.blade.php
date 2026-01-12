@extends('layouts.app')

@section('title', 'FAQ - VisorPlate')

@section('content')
<!-- FAQ Hero -->
<section class="pt-32 pb-16 premium-grain" style="background-color: var(--bg-luxury-black);">
    <div class="container-site">
        <div class="text-center mb-8">
            <div class="inline-block mb-6">
                <span class="badge-copper-blur">
                    FREQUENTLY ASKED QUESTIONS
                </span>
            </div>
            <h1 class="text-hero mb-6">
                <span class="text-white">Got</span><br>
                <span class="text-gradient-copper">Questions?</span>
            </h1>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto font-light tracking-wide">
                Everything you need to know about VisorPlate
            </p>
        </div>
    </div>
</section>

<!-- FAQ Content -->
<section class="section-standard bg-gray-900">
    <div class="container-site max-w-4xl">
        <div class="space-y-6" x-data="{ openFaq: null }">

            <!-- FAQ Item 1 -->
            <div class="glass-card overflow-hidden">
                <button
                    @click="openFaq = openFaq === 1 ? null : 1"
                    class="w-full text-left p-8 flex items-center justify-between"
                >
                    <h3 class="text-xl font-semibold text-white tracking-wide pr-4">
                        How does VisorPlate attach to my sun visor?
                    </h3>
                    <svg
                        class="w-6 h-6 text-copper transition-transform duration-300"
                        style="color: var(--accent-copper);"
                        :class="{'rotate-180': openFaq === 1}"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div
                    x-show="openFaq === 1"
                    x-collapse
                    class="px-8 pb-8"
                >
                    <p class="text-gray-300 font-light leading-relaxed">
                        VisorPlate comes with industrial-strength velcro already attached to the sleeve. Simply wrap the VisorPlate sleeve around your sun visor—the velcro hugs the visor securely with no adhesive touching your visor surface. Slip your license plate into the sleeve, and you're done. The entire installation takes about 60 seconds.
                    </p>
                </div>
            </div>

            <!-- FAQ Item 2 -->
            <div class="glass-card overflow-hidden">
                <button
                    @click="openFaq = openFaq === 2 ? null : 2"
                    class="w-full text-left p-8 flex items-center justify-between"
                >
                    <h3 class="text-xl font-semibold text-white tracking-wide pr-4">
                        Will this work with my state's license plate?
                    </h3>
                    <svg
                        class="w-6 h-6 text-copper transition-transform duration-300"
                        style="color: var(--accent-copper);"
                        :class="{'rotate-180': openFaq === 2}"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div
                    x-show="openFaq === 2"
                    x-collapse
                    class="px-8 pb-8"
                >
                    <p class="text-gray-300 font-light leading-relaxed mb-4">
                        VisorPlate works with all standard US license plates. Please check your state's specific requirements on our <a href="/#state-checker" class="link-underline" style="color: var(--accent-copper);">State Requirements</a> section to understand your state's front plate laws.
                    </p>
                    <p class="text-gray-400 text-sm font-light leading-relaxed italic border-l-2 pl-4 mt-4" style="border-color: var(--accent-copper);">
                        <strong>Legal Notice:</strong> VisorPlate is an alternative display solution. While many states require only that front license plates be "clearly visible" or "conspicuously displayed," law enforcement officers and judicial authorities retain discretion in interpreting and enforcing vehicle code compliance. We cannot guarantee that use of VisorPlate will prevent citations in all jurisdictions. As with any alternative mounting solution, users assume responsibility for compliance with local laws and regulations. We recommend verifying acceptability with your local DMV or law enforcement agency.
                    </p>
                </div>
            </div>

            <!-- FAQ Item 3 -->
            <div class="glass-card overflow-hidden">
                <button
                    @click="openFaq = openFaq === 3 ? null : 3"
                    class="w-full text-left p-8 flex items-center justify-between"
                >
                    <h3 class="text-xl font-semibold text-white tracking-wide pr-4">
                        Does it damage my sun visor or leave residue?
                    </h3>
                    <svg
                        class="w-6 h-6 text-copper transition-transform duration-300"
                        style="color: var(--accent-copper);"
                        :class="{'rotate-180': openFaq === 3}"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div
                    x-show="openFaq === 3"
                    x-collapse
                    class="px-8 pb-8"
                >
                    <p class="text-gray-300 font-light leading-relaxed">
                        Absolutely not. VisorPlate uses a velcro-to-velcro wrap design—no adhesive ever touches your visor surface. The velcro is attached to the sleeve itself, which simply wraps around and hugs your visor. When removed, it leaves zero marks, residue, or damage. Perfect for leased vehicles or when you want to keep your car pristine for resale.
                    </p>
                </div>
            </div>

            <!-- FAQ Item 4 -->
            <div class="glass-card overflow-hidden">
                <button
                    @click="openFaq = openFaq === 4 ? null : 4"
                    class="w-full text-left p-8 flex items-center justify-between"
                >
                    <h3 class="text-xl font-semibold text-white tracking-wide pr-4">
                        Can I still use my sun visor with VisorPlate attached?
                    </h3>
                    <svg
                        class="w-6 h-6 text-copper transition-transform duration-300"
                        style="color: var(--accent-copper);"
                        :class="{'rotate-180': openFaq === 4}"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div
                    x-show="openFaq === 4"
                    x-collapse
                    class="px-8 pb-8"
                >
                    <p class="text-gray-300 font-light leading-relaxed">
                        Absolutely! The VisorPlate sits flat against your visor and doesn't interfere with normal use. You can still flip your visor down and up as needed. When the visor is down, your plate is on display and compliant. When it's up, it's out of the way.
                    </p>
                </div>
            </div>

            <!-- FAQ Item 5 -->
            <div class="glass-card overflow-hidden">
                <button
                    @click="openFaq = openFaq === 5 ? null : 5"
                    class="w-full text-left p-8 flex items-center justify-between"
                >
                    <h3 class="text-xl font-semibold text-white tracking-wide pr-4">
                        My license plate feels tight in the sleeve. Is this normal?
                    </h3>
                    <svg
                        class="w-6 h-6 text-copper transition-transform duration-300"
                        style="color: var(--accent-copper);"
                        :class="{'rotate-180': openFaq === 5}"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div
                    x-show="openFaq === 5"
                    x-collapse
                    class="px-8 pb-8"
                >
                    <p class="text-gray-300 font-light leading-relaxed">
                        The vinyl sleeve material naturally expands and contracts slightly with temperature changes. If your plate feels difficult to insert, try letting the VisorPlate warm up to room temperature or placing it in a warmer environment briefly. Once the vinyl reaches ambient temperature, the plate should slide in smoothly. This is normal behavior for vinyl materials and doesn't affect the product's durability or performance.
                    </p>
                </div>
            </div>

            <!-- FAQ Item 6 -->
            <div class="glass-card overflow-hidden">
                <button
                    @click="openFaq = openFaq === 6 ? null : 6"
                    class="w-full text-left p-8 flex items-center justify-between"
                >
                    <h3 class="text-xl font-semibold text-white tracking-wide pr-4">
                        How long does shipping take?
                    </h3>
                    <svg
                        class="w-6 h-6 text-copper transition-transform duration-300"
                        style="color: var(--accent-copper);"
                        :class="{'rotate-180': openFaq === 6}"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div
                    x-show="openFaq === 6"
                    x-collapse
                    class="px-8 pb-8"
                >
                    <p class="text-gray-300 font-light leading-relaxed">
                        We ship via USPS within 1-2 business days of your order. Typical delivery time is 3-5 business days within the continental US. You'll receive a tracking number via email once your order ships.
                    </p>
                </div>
            </div>

            <!-- FAQ Item 7 -->
            <div class="glass-card overflow-hidden">
                <button
                    @click="openFaq = openFaq === 7 ? null : 7"
                    class="w-full text-left p-8 flex items-center justify-between"
                >
                    <h3 class="text-xl font-semibold text-white tracking-wide pr-4">
                        What's your return policy?
                    </h3>
                    <svg
                        class="w-6 h-6 text-copper transition-transform duration-300"
                        style="color: var(--accent-copper);"
                        :class="{'rotate-180': openFaq === 7}"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div
                    x-show="openFaq === 7"
                    x-collapse
                    class="px-8 pb-8"
                >
                    <p class="text-gray-300 font-light leading-relaxed">
                        We offer a 30-day satisfaction guarantee. If you're not completely satisfied with your VisorPlate, return it within 30 days for a full refund. Product must be in unused condition. Contact us at <a href="/contact" class="link-underline" style="color: var(--accent-copper);">our contact page</a> to initiate a return.
                    </p>
                </div>
            </div>

            <!-- FAQ Item 8 -->
            <div class="glass-card overflow-hidden">
                <button
                    @click="openFaq = openFaq === 8 ? null : 8"
                    class="w-full text-left p-8 flex items-center justify-between"
                >
                    <h3 class="text-xl font-semibold text-white tracking-wide pr-4">
                        Do you offer wholesale pricing for dealerships?
                    </h3>
                    <svg
                        class="w-6 h-6 text-copper transition-transform duration-300"
                        style="color: var(--accent-copper);"
                        :class="{'rotate-180': openFaq === 8}"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div
                    x-show="openFaq === 8"
                    x-collapse
                    class="px-8 pb-8"
                >
                    <p class="text-gray-300 font-light leading-relaxed">
                        Yes! We offer special pricing for dealerships, auto shops, and bulk orders. Visit our <a href="/wholesale" class="link-underline" style="color: var(--accent-copper);">wholesale inquiry page</a> or contact us directly to discuss volume pricing and partnership opportunities.
                    </p>
                </div>
            </div>

            <!-- FAQ Item 9 -->
            <div class="glass-card overflow-hidden">
                <button
                    @click="openFaq = openFaq === 9 ? null : 9"
                    class="w-full text-left p-8 flex items-center justify-between"
                >
                    <h3 class="text-xl font-semibold text-white tracking-wide pr-4">
                        Will it hold up in extreme weather conditions?
                    </h3>
                    <svg
                        class="w-6 h-6 text-copper transition-transform duration-300"
                        style="color: var(--accent-copper);"
                        :class="{'rotate-180': openFaq === 9}"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div
                    x-show="openFaq === 9"
                    x-collapse
                    class="px-8 pb-8"
                >
                    <p class="text-gray-300 font-light leading-relaxed">
                        VisorPlate is built to last. Our industrial-strength velcro is rated for temperatures from -40°F to 180°F, making it perfect for harsh winters and hot summers. The holder itself is made from durable materials that won't crack, fade, or deteriorate over time.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Still Have Questions CTA -->
<section class="section-standard bg-black">
    <div class="container-site">
        <div class="copper-border-card text-center max-w-3xl mx-auto">
            <h2 class="text-4xl font-light text-white mb-4 tracking-luxury">
                Still Have Questions?
            </h2>
            <p class="text-xl text-gray-300 mb-8 font-light">
                We're here to help. Reach out and we'll get back to you within 24 hours.
            </p>
            <a href="{{ route('contact') }}" class="btn-primary-luxury">
                Contact Us
            </a>
        </div>
    </div>
</section>

@endsection
