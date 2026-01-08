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
