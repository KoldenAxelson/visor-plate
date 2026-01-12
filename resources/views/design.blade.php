@extends('layouts.app')

@section('title', 'Design System - Visor Plate')

@section('content')
<!-- Design System Hero -->
<section class="pt-32 pb-16 premium-grain" style="background-color: var(--bg-luxury-black);">
    <div class="container-site">
        <div class="text-center mb-8">
            <div class="inline-block mb-6">
                <span class="badge-copper-blur">
                    DESIGN SYSTEM
                </span>
            </div>
            <h1 class="text-hero mb-6">
                <span class="text-white">Luxury</span><br>
                <span class="text-gradient-copper">Component Library</span>
            </h1>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto font-light tracking-wide">
                Glassmorphism • Shadow-free depth • Copper metallics • Material textures
            </p>
        </div>
    </div>
</section>

<!-- Glassmorphism -->
<section class="section-standard bg-gray-900">
    <div class="container-site">
        <h2 class="text-4xl font-light text-white mb-3 tracking-luxury">Glassmorphism</h2>
        <p class="text-lg text-gray-400 mb-12 font-light">Frosted glass effects with backdrop blur</p>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="glass-panel p-8 text-center">
                <h3 class="text-2xl font-light text-white mb-3 tracking-wide">Glass Panel</h3>
                <p class="text-gray-300 text-sm font-light mb-4">Static glassmorphism</p>
                <code class="text-xs text-gray-400 bg-black px-3 py-1 rounded">.glass-panel</code>
            </div>

            <div class="glass-panel-hover p-8 text-center">
                <h3 class="text-2xl font-light text-white mb-3 tracking-wide">Hover State</h3>
                <p class="text-gray-300 text-sm font-light mb-4">Interactive glass effect</p>
                <code class="text-xs text-gray-400 bg-black px-3 py-1 rounded">.glass-panel-hover</code>
            </div>

            <div class="glass-card p-8 text-center">
                <h3 class="text-2xl font-light text-white mb-3 tracking-wide">Elevated Card</h3>
                <p class="text-gray-300 text-sm font-light mb-4">Enhanced depth</p>
                <code class="text-xs text-gray-400 bg-black px-3 py-1 rounded">.glass-card</code>
            </div>
        </div>
    </div>
</section>

<!-- Gradient Borders -->
<section class="section-standard bg-black">
    <div class="container-site">
        <h2 class="text-4xl font-light text-white mb-3 tracking-luxury">Gradient Borders</h2>
        <p class="text-lg text-gray-400 mb-12 font-light">Shadow-free depth through gradient edges</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="gradient-border-card">
                <h3 class="text-xl font-semibold text-white mb-2 tracking-wide">White</h3>
                <p class="text-gray-400 text-sm font-light">Subtle elegance</p>
                <code class="text-xs text-gray-400 bg-gray-900 px-2 py-1 rounded mt-3 inline-block">.gradient-border-card</code>
            </div>

            <div class="copper-border-card">
                <h3 class="text-xl font-semibold text-white mb-2 tracking-wide">Copper</h3>
                <p class="text-gray-400 text-sm font-light">Warm metallic</p>
                <code class="text-xs text-gray-400 bg-gray-900 px-2 py-1 rounded mt-3 inline-block">.copper-border-card</code>
            </div>

            <div class="gold-border-card">
                <h3 class="text-xl font-semibold text-white mb-2 tracking-wide">Gold</h3>
                <p class="text-gray-400 text-sm font-light">Premium accent</p>
                <code class="text-xs text-gray-400 bg-gray-900 px-2 py-1 rounded mt-3 inline-block">.gold-border-card</code>
            </div>
        </div>
    </div>
</section>

<!-- Buttons -->
<section class="section-standard bg-gray-900">
    <div class="container-site">
        <h2 class="text-4xl font-light text-white mb-3 tracking-luxury">Buttons</h2>
        <p class="text-lg text-gray-400 mb-12 font-light">Luxury fill animations with refined timing</p>

        <div class="space-y-8">
            <div class="card-feature p-8 text-center">
                <button class="btn-primary-luxury mb-4">Commission Your Product</button>
                <p class="text-gray-400 text-sm font-light mb-2">Copper accent • 350ms fill animation</p>
                <code class="text-xs text-gray-400 bg-black px-3 py-1 rounded">.btn-primary-luxury</code>
            </div>

            <div class="card-feature p-8 text-center">
                <button class="btn-glass mb-4">Glassmorphic Button</button>
                <p class="text-gray-400 text-sm font-light mb-2">Frosted glass with hover lift</p>
                <code class="text-xs text-gray-400 bg-black px-3 py-1 rounded">.btn-glass</code>
            </div>

            <div class="card-feature p-8 text-center">
                <button class="btn-secondary mb-4">Secondary Action</button>
                <p class="text-gray-400 text-sm font-light mb-2">Outline with opacity shift</p>
                <code class="text-xs text-gray-400 bg-black px-3 py-1 rounded">.btn-secondary</code>
            </div>
        </div>
    </div>
</section>

<!-- Cards -->
<section class="section-standard bg-black">
    <div class="container-site">
        <h2 class="text-4xl font-light text-white mb-3 tracking-luxury">Cards</h2>
        <p class="text-lg text-gray-400 mb-12 font-light">Glassmorphic containers with hover effects</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="card-feature hover-lift">
                <h3 class="text-xl font-semibold text-white mb-2 tracking-wide">Feature Card</h3>
                <p class="text-gray-400 text-sm font-light mb-3">Glass panel with hover lift</p>
                <code class="text-xs text-gray-400 bg-black px-2 py-1 rounded">.card-feature</code>
            </div>

            <div class="card-info">
                <h3 class="text-xl font-semibold text-white mb-2 tracking-wide">Info Card</h3>
                <p class="text-gray-400 text-sm font-light mb-3">Gradient border styling</p>
                <code class="text-xs text-gray-400 bg-black px-2 py-1 rounded">.card-info</code>
            </div>

            <div class="card-product hover-lift">
                <div class="bg-gray-800 h-32 rounded-lg mb-4"></div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-white mb-2 tracking-wide">Product Card</h3>
                    <p class="text-gray-400 text-xs font-light mb-2">Image scale on hover</p>
                    <code class="text-xs text-gray-400 bg-black px-2 py-1 rounded">.card-product</code>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Typography -->
<section class="section-standard bg-gray-900">
    <div class="container-site">
        <h2 class="text-4xl font-light text-white mb-3 tracking-luxury">Typography</h2>
        <p class="text-lg text-gray-400 mb-12 font-light">Light weights with refined tracking</p>

        <div class="space-y-8">
            <div class="card-feature p-8">
                <h3 class="text-hero mb-3">Hero Headline</h3>
                <p class="text-gray-400 text-sm font-light mb-2">font-light • tracking-luxury (0.05em)</p>
                <code class="text-xs text-gray-400 bg-black px-3 py-1 rounded">.text-hero</code>
            </div>

            <div class="card-feature p-8">
                <h3 class="text-section mb-3">Section Title</h3>
                <p class="text-gray-400 text-sm font-light mb-2">font-light • tracking-luxury (0.05em)</p>
                <code class="text-xs text-gray-400 bg-black px-3 py-1 rounded">.text-section</code>
            </div>

            <div class="card-feature p-8">
                <h3 class="text-gradient-copper text-4xl font-light mb-3 tracking-luxury">Copper Gradient</h3>
                <code class="text-xs text-gray-400 bg-black px-3 py-1 rounded">.text-gradient-copper</code>
            </div>

            <div class="card-feature p-8">
                <p class="text-caps-luxury mb-3">ALL-CAPS WITH PROPER TRACKING</p>
                <p class="text-gray-400 text-sm font-light mb-2">uppercase • tracking-caps (0.12em)</p>
                <code class="text-xs text-gray-400 bg-black px-3 py-1 rounded">.text-caps-luxury</code>
            </div>
        </div>
    </div>
</section>

<!-- Icons & Badges -->
<section class="section-standard bg-black">
    <div class="container-site">
        <h2 class="text-4xl font-light text-white mb-3 tracking-luxury">Icons & Badges</h2>
        <p class="text-lg text-gray-400 mb-12 font-light">Gradient backgrounds with proper spacing</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="card-feature p-8">
                <h3 class="text-xl font-semibold text-white mb-6 tracking-wide">Step Numbers</h3>
                <div class="flex gap-4 justify-center mb-4">
                    <div class="step-number">1</div>
                    <div class="step-number">2</div>
                    <div class="step-number">3</div>
                </div>
                <code class="text-xs text-gray-400 bg-black px-3 py-1 rounded">.step-number</code>
            </div>

            <div class="card-feature p-8">
                <h3 class="text-xl font-semibold text-white mb-6 tracking-wide">Check Icons</h3>
                <div class="flex gap-4 justify-center mb-4">
                    <div class="icon-check"><span class="text-white font-bold">✓</span></div>
                    <div class="icon-check"><span class="text-white font-bold">✓</span></div>
                    <div class="icon-check"><span class="text-white font-bold">✓</span></div>
                </div>
                <code class="text-xs text-gray-400 bg-black px-3 py-1 rounded">.icon-check</code>
            </div>
        </div>

        <div class="mt-12 card-feature p-8">
            <h3 class="text-xl font-semibold text-white mb-6 tracking-wide">Badges</h3>
            <div class="flex flex-wrap gap-4 justify-center mb-4">
                <span class="badge-copper">PREMIUM SOLUTION</span>
                <span class="badge-copper-blur">WITH BLUR</span>
                <span class="badge-gold">HAND-CRAFTED</span>
                <span class="badge-red">SPECIAL OFFER</span>
            </div>
            <div class="text-center">
                <code class="text-xs text-gray-400 bg-black px-3 py-1 rounded">.badge-copper • .badge-gold • .badge-red</code>
            </div>
        </div>
    </div>
</section>

<!-- Material Textures -->
<section class="section-standard bg-gray-900">
    <div class="container-site">
        <h2 class="text-4xl font-light text-white mb-3 tracking-luxury">Material Textures</h2>
        <p class="text-lg text-gray-400 mb-12 font-light">CSS-based physical materials</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <div class="carbon-fiber h-40 rounded-2xl border border-gray-700 mb-4"></div>
                <h3 class="text-lg font-semibold text-white mb-2 tracking-wide">Carbon Fiber</h3>
                <code class="text-xs text-gray-400 bg-black px-3 py-1 rounded">.carbon-fiber</code>
            </div>

            <div>
                <div class="premium-grain bg-gray-800 h-40 rounded-2xl border border-gray-700 mb-4"></div>
                <h3 class="text-lg font-semibold text-white mb-2 tracking-wide">Premium Grain</h3>
                <code class="text-xs text-gray-400 bg-black px-3 py-1 rounded">.premium-grain</code>
            </div>

            <div>
                <div class="brushed-metal h-40 rounded-2xl border border-gray-700 mb-4"></div>
                <h3 class="text-lg font-semibold text-white mb-2 tracking-wide">Brushed Metal</h3>
                <code class="text-xs text-gray-400 bg-black px-3 py-1 rounded">.brushed-metal</code>
            </div>
        </div>
    </div>
</section>

<!-- Color Palette -->
<section class="section-standard bg-black">
    <div class="container-site">
        <h2 class="text-4xl font-light text-white mb-3 tracking-luxury">Color Palette</h2>
        <p class="text-lg text-gray-400 mb-12 font-light">Copper and gold automotive luxury</p>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div>
                <div class="h-32 rounded-2xl mb-4" style="background-color: var(--accent-copper);"></div>
                <div class="text-white font-semibold mb-1">Copper</div>
                <code class="text-sm text-gray-400">#B87333</code>
            </div>

            <div>
                <div class="h-32 rounded-2xl mb-4" style="background-color: var(--accent-gold);"></div>
                <div class="text-white font-semibold mb-1">Gold</div>
                <code class="text-sm text-gray-400">#C29049</code>
            </div>

            <div>
                <div class="h-32 border border-gray-700 rounded-2xl mb-4" style="background-color: var(--bg-luxury-black);"></div>
                <div class="text-white font-semibold mb-1">Luxury Black</div>
                <code class="text-sm text-gray-400">#0D0D0D</code>
            </div>

            <div>
                <div class="h-32 border border-gray-700 rounded-2xl mb-4" style="background-color: var(--bg-elevated);"></div>
                <div class="text-white font-semibold mb-1">Elevated</div>
                <code class="text-sm text-gray-400">#1C1C1E</code>
            </div>
        </div>
    </div>
</section>

<!-- Glow Effects -->
<section class="section-standard bg-gray-900">
    <div class="container-site">
        <h2 class="text-4xl font-light text-white mb-3 tracking-luxury">Glow Effects</h2>
        <p class="text-lg text-gray-400 mb-12 font-light">Subtle luminosity replaces shadows</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="card-feature copper-glow">
                <h3 class="text-xl font-semibold text-white mb-2 tracking-wide">Copper Glow</h3>
                <p class="text-gray-400 text-sm font-light mb-3">Warm halo effect</p>
                <code class="text-xs text-gray-400 bg-black px-2 py-1 rounded">.copper-glow</code>
            </div>

            <div class="card-feature gold-glow">
                <h3 class="text-xl font-semibold text-white mb-2 tracking-wide">Gold Glow</h3>
                <p class="text-gray-400 text-sm font-light mb-3">Premium luminosity</p>
                <code class="text-xs text-gray-400 bg-black px-2 py-1 rounded">.gold-glow</code>
            </div>

            <div class="card-feature red-glow">
                <h3 class="text-xl font-semibold text-white mb-2 tracking-wide">Red Glow</h3>
                <p class="text-gray-400 text-sm font-light mb-3">Accent glow for CTAs</p>
                <code class="text-xs text-gray-400 bg-black px-2 py-1 rounded">.red-glow</code>
            </div>
        </div>
    </div>
</section>

<!-- Form Elements -->
<section class="section-standard bg-black">
    <div class="container-site">
        <h2 class="text-4xl font-light text-white mb-3 tracking-luxury">Form Elements</h2>
        <p class="text-lg text-gray-400 mb-12 font-light">Glassmorphic inputs with copper accents</p>

        <div class="max-w-2xl mx-auto space-y-8">
            <div class="card-feature p-8">
                <label class="label-standard">Standard Input</label>
                <input type="text" class="input-standard" placeholder="Enter text...">
            </div>

            <div class="card-feature p-8">
                <label class="label-standard">Select Dropdown</label>
                <select class="input-standard">
                    <option>Option 1</option>
                    <option>Option 2</option>
                    <option>Option 3</option>
                </select>
            </div>

            <div class="card-feature p-8">
                <label class="label-standard">Quantity Input</label>
                <div class="flex items-center gap-4">
                    <button class="btn-quantity">−</button>
                    <input type="number" value="1" class="input-quantity">
                    <button class="btn-quantity">+</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Social Icons -->
<section class="section-standard bg-gray-900">
    <div class="container-site">
        <h2 class="text-4xl font-light text-white mb-3 tracking-luxury">Social Icons</h2>
        <p class="text-lg text-gray-400 mb-12 font-light">Footer social links with copper gradient hover</p>

        <div class="max-w-2xl mx-auto">
            <div class="card-feature p-12 text-center">
                <p class="text-gray-400 mb-6 font-light">Hover to see copper gradient effect</p>
                <div class="flex gap-6 justify-center">
                    <a href="#" class="social-icon-link" aria-label="Facebook">
                        <svg class="social-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="#" class="social-icon-link" aria-label="X (formerly Twitter)">
                        <svg class="social-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>
                    <a href="#" class="social-icon-link" aria-label="Instagram">
                        <svg class="social-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                        </svg>
                    </a>
                </div>
                <div class="text-center mt-8">
                    <code class="text-xs text-gray-400 bg-black px-3 py-1 rounded">.social-icon-link + .social-icon</code>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quick Reference -->
<section class="section-standard bg-gray-900">
    <div class="container-site">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-light text-white mb-3 tracking-luxury">Quick Reference</h2>
            <p class="text-lg text-gray-400 font-light">CSS custom properties for inline styling</p>
        </div>

        <div class="copper-border-card max-w-3xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm font-light">
                <div>
                    <h3 class="text-white font-semibold mb-3 tracking-wide">Colors</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><code>var(--accent-copper)</code></li>
                        <li><code>var(--accent-gold)</code></li>
                        <li><code>var(--accent-red)</code></li>
                        <li><code>var(--bg-luxury-black)</code></li>
                        <li><code>var(--bg-elevated)</code></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-3 tracking-wide">Letter Spacing</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><code>.tracking-luxury</code> → 0.05em</li>
                        <li><code>.tracking-caps</code> → 0.12em</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
