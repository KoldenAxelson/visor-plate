@extends('layouts.app')

@section('title', 'Design System - Visor Plate')

@section('content')
<!-- Design System Hero -->
<section class="pt-32 pb-16 bg-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <div class="inline-block mb-6">
                <span class="bg-red-600/20 text-red-500 px-6 py-2 rounded-full text-sm font-semibold border border-red-600/30">
                    DESIGN SYSTEM
                </span>
            </div>
            <h1 class="text-6xl md:text-8xl font-black mb-6">
                <span class="text-white">Visor Plate</span><br>
                <span class="text-transparent bg-clip-text bg-linear-to-r from-red-500 to-red-700">Style Guide</span>
            </h1>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                A comprehensive showcase of all design elements, components, and patterns used across the site.
            </p>
        </div>
    </div>
</section>

<!-- TABLE OF CONTENTS -->
<section class="py-16 bg-linear-to-b from-black to-gray-900 border-b border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-white mb-8">Quick Navigation</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="#colors" class="bg-gray-900 border border-gray-800 rounded-xl p-4 text-center hover:border-red-600 transition">
                <span class="text-white font-semibold">Colors</span>
            </a>
            <a href="#typography" class="bg-gray-900 border border-gray-800 rounded-xl p-4 text-center hover:border-red-600 transition">
                <span class="text-white font-semibold">Typography</span>
            </a>
            <a href="#buttons" class="bg-gray-900 border border-gray-800 rounded-xl p-4 text-center hover:border-red-600 transition">
                <span class="text-white font-semibold">Buttons</span>
            </a>
            <a href="#cards" class="bg-gray-900 border border-gray-800 rounded-xl p-4 text-center hover:border-red-600 transition">
                <span class="text-white font-semibold">Cards</span>
            </a>
            <a href="#forms" class="bg-gray-900 border border-gray-800 rounded-xl p-4 text-center hover:border-red-600 transition">
                <span class="text-white font-semibold">Forms</span>
            </a>
            <a href="#spacing" class="bg-gray-900 border border-gray-800 rounded-xl p-4 text-center hover:border-red-600 transition">
                <span class="text-white font-semibold">Spacing</span>
            </a>
            <a href="#gradients" class="bg-gray-900 border border-gray-800 rounded-xl p-4 text-center hover:border-red-600 transition">
                <span class="text-white font-semibold">Gradients</span>
            </a>
            <a href="#components" class="bg-gray-900 border border-gray-800 rounded-xl p-4 text-center hover:border-red-600 transition">
                <span class="text-white font-semibold">Components</span>
            </a>
        </div>
    </div>
</section>

<!-- DESIGN PHILOSOPHY -->
<section class="py-20 bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-black text-white mb-8">Design Philosophy</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-black border border-gray-800 rounded-2xl p-8">
                <div class="text-4xl mb-4">🏎️</div>
                <h3 class="text-2xl font-bold text-white mb-3">Premium Automotive</h3>
                <p class="text-gray-400">
                    Dark, bold, and aggressive. Like a show car's paint job - clean lines, no unnecessary decoration.
                </p>
            </div>
            <div class="bg-black border border-gray-800 rounded-2xl p-8">
                <div class="text-4xl mb-4">🎯</div>
                <h3 class="text-2xl font-bold text-white mb-3">Focused Simplicity</h3>
                <p class="text-gray-400">
                    No drop shadows, no scale transforms, no unnecessary effects. Clean outlines and smooth transitions.
                </p>
            </div>
            <div class="bg-black border border-gray-800 rounded-2xl p-8">
                <div class="text-4xl mb-4">⚡</div>
                <h3 class="text-2xl font-bold text-white mb-3">Bold & Direct</h3>
                <p class="text-gray-400">
                    Large typography, generous spacing, red accents. Make every element count.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- TAILWIND APPROACH: COMPONENTS VS UTILITIES -->
<section class="py-20 bg-black border-t border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-black text-white mb-4">Tailwind Approach</h2>
        <p class="text-xl text-gray-400 mb-12">When to use component classes vs utility classes</p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Utility Classes -->
            <div class="bg-gray-900 border-2 border-gray-800 rounded-2xl p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-green-600/20 rounded-xl flex items-center justify-center">
                        <span class="text-2xl">✓</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white">Use Utility Classes When:</h3>
                </div>
                <ul class="space-y-3 text-gray-300">
                    <li class="flex gap-3">
                        <span class="text-green-500 shrink-0">•</span>
                        <span>Element is <strong class="text-white">unique</strong> or used only 1-2 times</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="text-green-500 shrink-0">•</span>
                        <span>Quick prototyping or <strong class="text-white">one-off designs</strong></span>
                    </li>
                    <li class="flex gap-3">
                        <span class="text-green-500 shrink-0">•</span>
                        <span>You want <strong class="text-white">maximum flexibility</strong> per instance</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="text-green-500 shrink-0">•</span>
                        <span>Small variations needed between instances</span>
                    </li>
                </ul>
                <div class="mt-6 bg-black rounded-xl p-4">
                    <code class="text-xs text-gray-400">
                        &lt;button class="border-2 border-red-600 text-red-500<br>
                        &nbsp;&nbsp;px-12 py-5 rounded-xl text-xl font-bold<br>
                        &nbsp;&nbsp;transition-all duration-300<br>
                        &nbsp;&nbsp;hover:bg-red-600 hover:text-white"&gt;<br>
                        &nbsp;&nbsp;Shop Now<br>
                        &lt;/button&gt;
                    </code>
                </div>
            </div>

            <!-- Component Classes -->
            <div class="bg-gray-900 border-2 border-red-600 rounded-2xl p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-red-600/20 rounded-xl flex items-center justify-center">
                        <span class="text-2xl">⭐</span>
                    </div>
                    <h3 class="text-2xl font-bold text-white">Use Component Classes When:</h3>
                </div>
                <ul class="space-y-3 text-gray-300">
                    <li class="flex gap-3">
                        <span class="text-red-500 shrink-0">•</span>
                        <span>Element is used <strong class="text-white">3+ times</strong> across pages</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="text-red-500 shrink-0">•</span>
                        <span>You want <strong class="text-white">consistent updates</strong> everywhere</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="text-red-500 shrink-0">•</span>
                        <span>Pattern is <strong class="text-white">well-established</strong> in your design</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="text-red-500 shrink-0">•</span>
                        <span>Reduces cognitive load for developers</span>
                    </li>
                </ul>
                <div class="mt-6 bg-black rounded-xl p-4">
                    <code class="text-xs text-gray-400">
                        /* In app.css: */<br>
                        .btn-primary {<br>
                        &nbsp;&nbsp;@apply border-2 border-red-600 text-red-500<br>
                        &nbsp;&nbsp;px-12 py-5 rounded-xl...<br>
                        }<br><br>
                        /* In HTML: */<br>
                        &lt;button class="btn-primary"&gt;Shop Now&lt;/button&gt;
                    </code>
                </div>
            </div>
        </div>

        <!-- Examples -->
        <div class="mt-12 bg-gray-900 rounded-2xl p-8">
            <h3 class="text-2xl font-bold text-white mb-6">Real Examples from This Site</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h4 class="text-lg font-semibold text-red-500 mb-3">✓ Good for Components:</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li class="flex gap-2">
                            <span class="text-green-500">•</span>
                            <span>Primary CTA button (used 15+ times)</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="text-green-500">•</span>
                            <span>Quantity selector (shop + checkout)</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="text-green-500">•</span>
                            <span>Feature cards (repeated pattern)</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="text-green-500">•</span>
                            <span>Form inputs (consistent styling)</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-red-500 mb-3">✓ Good for Utilities:</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li class="flex gap-2">
                            <span class="text-green-500">•</span>
                            <span>Hero section (unique layout)</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="text-green-500">•</span>
                            <span>State checker UI (one-off component)</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="text-green-500">•</span>
                            <span>Footer layout (single instance)</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="text-green-500">•</span>
                            <span>Custom spacing tweaks</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Benefits -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-black border border-gray-800 rounded-xl p-6 text-center">
                <div class="text-3xl mb-3">🚀</div>
                <h4 class="text-lg font-bold text-white mb-2">Faster Updates</h4>
                <p class="text-sm text-gray-400">Change .btn-primary once, updates everywhere instantly</p>
            </div>
            <div class="bg-black border border-gray-800 rounded-xl p-6 text-center">
                <div class="text-3xl mb-3">🧹</div>
                <h4 class="text-lg font-bold text-white mb-2">Cleaner HTML</h4>
                <p class="text-sm text-gray-400">Shorter class names, easier to read and maintain</p>
            </div>
            <div class="bg-black border border-gray-800 rounded-xl p-6 text-center">
                <div class="text-3xl mb-3">🎯</div>
                <h4 class="text-lg font-bold text-white mb-2">Consistency</h4>
                <p class="text-sm text-gray-400">Enforces design system, prevents style drift</p>
            </div>
        </div>
    </div>
</section>

<!-- COLOR SYSTEM -->
<section id="colors" class="py-20 bg-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-5xl font-black text-white mb-4">Color System</h2>
        <p class="text-xl text-gray-400 mb-12">Dark theme with red accents. No pastels, no compromise.</p>

        <!-- Primary Colors -->
        <div class="mb-16">
            <h3 class="text-3xl font-bold text-white mb-8">Primary Palette</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Black -->
                <div>
                    <div class="bg-black border-2 border-gray-700 rounded-2xl h-32 mb-4"></div>
                    <div class="text-white font-bold mb-1">Black</div>
                    <code class="text-sm text-gray-400 bg-gray-900 px-2 py-1 rounded">bg-black</code>
                    <div class="text-xs text-gray-500 mt-1">#000000</div>
                </div>
                <!-- Gray 900 -->
                <div>
                    <div class="bg-gray-900 border-2 border-gray-700 rounded-2xl h-32 mb-4"></div>
                    <div class="text-white font-bold mb-1">Gray 900</div>
                    <code class="text-sm text-gray-400 bg-gray-900 px-2 py-1 rounded">bg-gray-900</code>
                    <div class="text-xs text-gray-500 mt-1">#111827</div>
                </div>
                <!-- Red 600 -->
                <div>
                    <div class="bg-red-600 rounded-2xl h-32 mb-4"></div>
                    <div class="text-white font-bold mb-1">Red 600</div>
                    <code class="text-sm text-gray-400 bg-gray-900 px-2 py-1 rounded">bg-red-600</code>
                    <div class="text-xs text-gray-500 mt-1">#DC2626</div>
                </div>
                <!-- Red 700 -->
                <div>
                    <div class="bg-red-700 rounded-2xl h-32 mb-4"></div>
                    <div class="text-white font-bold mb-1">Red 700</div>
                    <code class="text-sm text-gray-400 bg-gray-900 px-2 py-1 rounded">bg-red-700</code>
                    <div class="text-xs text-gray-500 mt-1">#B91C1C</div>
                </div>
            </div>
        </div>

        <!-- Text Colors -->
        <div class="mb-16">
            <h3 class="text-3xl font-bold text-white mb-8">Text Colors</h3>
            <div class="bg-gray-900 rounded-2xl p-8 space-y-6">
                <div class="flex items-center justify-between border-b border-gray-800 pb-4">
                    <span class="text-white text-2xl font-bold">Primary Text (White)</span>
                    <code class="text-sm text-gray-400 bg-black px-3 py-1 rounded">text-white</code>
                </div>
                <div class="flex items-center justify-between border-b border-gray-800 pb-4">
                    <span class="text-gray-300 text-xl">Secondary Text (Gray 300)</span>
                    <code class="text-sm text-gray-400 bg-black px-3 py-1 rounded">text-gray-300</code>
                </div>
                <div class="flex items-center justify-between border-b border-gray-800 pb-4">
                    <span class="text-gray-400 text-lg">Tertiary Text (Gray 400)</span>
                    <code class="text-sm text-gray-400 bg-black px-3 py-1 rounded">text-gray-400</code>
                </div>
                <div class="flex items-center justify-between border-b border-gray-800 pb-4">
                    <span class="text-gray-500">Muted Text (Gray 500)</span>
                    <code class="text-sm text-gray-400 bg-black px-3 py-1 rounded">text-gray-500</code>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-red-500 text-xl font-semibold">Accent Text (Red 500)</span>
                    <code class="text-sm text-gray-400 bg-black px-3 py-1 rounded">text-red-500</code>
                </div>
            </div>
        </div>

        <!-- Border Colors -->
        <div>
            <h3 class="text-3xl font-bold text-white mb-8">Border Colors</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gray-900 rounded-2xl p-6 border-2 border-gray-800">
                    <div class="text-white font-bold mb-2">Default Border</div>
                    <code class="text-sm text-gray-400">border-gray-800</code>
                </div>
                <div class="bg-gray-900 rounded-2xl p-6 border-2 border-red-600/50">
                    <div class="text-white font-bold mb-2">Accent Border (Hover)</div>
                    <code class="text-sm text-gray-400">border-red-600/50</code>
                </div>
                <div class="bg-gray-900 rounded-2xl p-6 border-2 border-red-600">
                    <div class="text-white font-bold mb-2">Active Border</div>
                    <code class="text-sm text-gray-400">border-red-600</code>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TYPOGRAPHY -->
<section id="typography" class="py-20 bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-5xl font-black text-white mb-4">Typography</h2>
        <p class="text-xl text-gray-400 mb-12">Bold, aggressive, and highly readable. Size matters.</p>

        <!-- Headings -->
        <div class="mb-16">
            <h3 class="text-3xl font-bold text-white mb-8">Heading Scale</h3>
            <div class="bg-black rounded-2xl p-8 space-y-8">
                <div class="border-b border-gray-800 pb-6">
                    <h1 class="text-8xl font-black text-white mb-3">Mega Hero</h1>
                    <code class="text-sm text-gray-400 bg-gray-900 px-3 py-1 rounded">text-8xl font-black</code>
                </div>
                <div class="border-b border-gray-800 pb-6">
                    <h2 class="text-7xl font-black text-white mb-3">Hero Title</h2>
                    <code class="text-sm text-gray-400 bg-gray-900 px-3 py-1 rounded">text-7xl font-black</code>
                </div>
                <div class="border-b border-gray-800 pb-6">
                    <h3 class="text-6xl font-black text-white mb-3">Section Title</h3>
                    <code class="text-sm text-gray-400 bg-gray-900 px-3 py-1 rounded">text-6xl font-black</code>
                </div>
                <div class="border-b border-gray-800 pb-6">
                    <h4 class="text-5xl font-black text-white mb-3">Large Heading</h4>
                    <code class="text-sm text-gray-400 bg-gray-900 px-3 py-1 rounded">text-5xl font-black</code>
                </div>
                <div class="border-b border-gray-800 pb-6">
                    <h5 class="text-4xl font-bold text-white mb-3">Medium Heading</h5>
                    <code class="text-sm text-gray-400 bg-gray-900 px-3 py-1 rounded">text-4xl font-bold</code>
                </div>
                <div class="border-b border-gray-800 pb-6">
                    <h6 class="text-3xl font-bold text-white mb-3">Small Heading</h6>
                    <code class="text-sm text-gray-400 bg-gray-900 px-3 py-1 rounded">text-3xl font-bold</code>
                </div>
                <div>
                    <div class="text-2xl font-bold text-white mb-3">Card Title</div>
                    <code class="text-sm text-gray-400 bg-gray-900 px-3 py-1 rounded">text-2xl font-bold</code>
                </div>
            </div>
        </div>

        <!-- Body Text -->
        <div class="mb-16">
            <h3 class="text-3xl font-bold text-white mb-8">Body Text Scale</h3>
            <div class="bg-black rounded-2xl p-8 space-y-6">
                <div class="border-b border-gray-800 pb-4">
                    <p class="text-2xl text-gray-300 mb-2">Large Body - Used for subheadings and emphasis</p>
                    <code class="text-sm text-gray-400 bg-gray-900 px-3 py-1 rounded">text-2xl</code>
                </div>
                <div class="border-b border-gray-800 pb-4">
                    <p class="text-xl text-gray-300 mb-2">Medium Body - Hero descriptions and important copy</p>
                    <code class="text-sm text-gray-400 bg-gray-900 px-3 py-1 rounded">text-xl</code>
                </div>
                <div class="border-b border-gray-800 pb-4">
                    <p class="text-lg text-gray-400 mb-2">Standard Body - Feature descriptions and card content</p>
                    <code class="text-sm text-gray-400 bg-gray-900 px-3 py-1 rounded">text-lg</code>
                </div>
                <div class="border-b border-gray-800 pb-4">
                    <p class="text-base text-gray-400 mb-2">Base Text - General content and paragraphs</p>
                    <code class="text-sm text-gray-400 bg-gray-900 px-3 py-1 rounded">text-base</code>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-2">Small Text - Captions, badges, and fine print</p>
                    <code class="text-sm text-gray-400 bg-gray-900 px-3 py-1 rounded">text-sm</code>
                </div>
            </div>
        </div>

        <!-- Font Weights -->
        <div>
            <h3 class="text-3xl font-bold text-white mb-8">Font Weights</h3>
            <div class="bg-black rounded-2xl p-8 space-y-4">
                <div class="flex items-center justify-between border-b border-gray-800 pb-4">
                    <span class="text-white text-2xl font-black">Black (900) - Headlines</span>
                    <code class="text-sm text-gray-400 bg-gray-900 px-3 py-1 rounded">font-black</code>
                </div>
                <div class="flex items-center justify-between border-b border-gray-800 pb-4">
                    <span class="text-white text-2xl font-bold">Bold (700) - Subheadings</span>
                    <code class="text-sm text-gray-400 bg-gray-900 px-3 py-1 rounded">font-bold</code>
                </div>
                <div class="flex items-center justify-between border-b border-gray-800 pb-4">
                    <span class="text-white text-2xl font-semibold">Semibold (600) - Emphasis</span>
                    <code class="text-sm text-gray-400 bg-gray-900 px-3 py-1 rounded">font-semibold</code>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-white text-2xl font-normal">Normal (400) - Body</span>
                    <code class="text-sm text-gray-400 bg-gray-900 px-3 py-1 rounded">font-normal</code>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BUTTONS -->
<section id="buttons" class="py-20 bg-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-5xl font-black text-white mb-4">Buttons</h2>
        <p class="text-xl text-gray-400 mb-12">Clean outlines. Smooth transitions. No shadows, no scale effects.</p>

        <!-- Primary CTA -->
        <div class="mb-16">
            <h3 class="text-3xl font-bold text-white mb-8">Primary CTA (Red Outline → Fill)</h3>
            <div class="bg-gray-900 rounded-2xl p-12 flex flex-col items-center gap-8">
                <button class="border-2 border-red-600 text-red-500 px-12 py-5 rounded-xl text-xl font-bold transition-all duration-300 hover:bg-red-600 hover:text-white hover:border-red-600">
                    Get Visor Plate - $35 →
                </button>
                <code class="text-sm text-gray-400 bg-black px-4 py-2 rounded">
                    border-2 border-red-600 text-red-500 px-12 py-5 rounded-xl text-xl font-bold<br>
                    transition-all duration-300 hover:bg-red-600 hover:text-white
                </code>
                <div class="text-center max-w-lg">
                    <p class="text-gray-400 text-sm">
                        <strong class="text-white">Hover me!</strong> Red outline + red text → fills with red, text turns white
                    </p>
                </div>
            </div>
        </div>

        <!-- Secondary Button -->
        <div class="mb-16">
            <h3 class="text-3xl font-bold text-white mb-8">Secondary Button (White Outline)</h3>
            <div class="bg-gray-900 rounded-2xl p-12 flex flex-col items-center gap-8">
                <button class="border-2 border-white/30 backdrop-blur-sm text-white px-12 py-5 rounded-xl text-xl font-bold transition-all duration-300 hover:bg-white/10 hover:border-white/50">
                    See Installation
                </button>
                <code class="text-sm text-gray-400 bg-black px-4 py-2 rounded">
                    border-2 border-white/30 text-white px-12 py-5 rounded-xl text-xl font-bold<br>
                    transition-all duration-300 hover:bg-white/10 hover:border-white/50
                </code>
            </div>
        </div>

        <!-- Small Button -->
        <div class="mb-16">
            <h3 class="text-3xl font-bold text-white mb-8">Small Button</h3>
            <div class="bg-gray-900 rounded-2xl p-12 flex flex-col items-center gap-8">
                <button class="border-2 border-red-600 text-red-500 px-8 py-3 rounded-lg text-base font-bold transition-all duration-300 hover:bg-red-600 hover:text-white">
                    Shop Now
                </button>
                <code class="text-sm text-gray-400 bg-black px-4 py-2 rounded">
                    border-2 border-red-600 text-red-500 px-8 py-3 rounded-lg text-base font-bold<br>
                    transition-all duration-300 hover:bg-red-600 hover:text-white
                </code>
            </div>
        </div>

        <!-- Icon Buttons -->
        <div>
            <h3 class="text-3xl font-bold text-white mb-8">Icon Buttons (Carousel Navigation)</h3>
            <div class="bg-gray-900 rounded-2xl p-12 flex flex-col items-center gap-8">
                <div class="flex gap-6">
                    <button class="w-14 h-14 bg-black/80 hover:bg-red-600 rounded-full flex items-center justify-center text-white transition-all duration-300 backdrop-blur-sm border border-gray-700 hover:border-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button class="w-14 h-14 bg-black/80 hover:bg-red-600 rounded-full flex items-center justify-center text-white transition-all duration-300 backdrop-blur-sm border border-gray-700 hover:border-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
                <code class="text-sm text-gray-400 bg-black px-4 py-2 rounded">
                    w-14 h-14 bg-black/80 hover:bg-red-600 rounded-full<br>
                    border border-gray-700 hover:border-red-600 transition-all duration-300
                </code>
            </div>
        </div>
    </div>
</section>

<!-- CARDS & CONTAINERS -->
<section id="cards" class="py-20 bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-5xl font-black text-white mb-4">Cards & Containers</h2>
        <p class="text-xl text-gray-400 mb-12">Consistent borders, subtle hover effects, organized content.</p>

        <!-- Feature Card -->
        <div class="mb-16">
            <h3 class="text-3xl font-bold text-white mb-8">Feature Card (Problem/Solution)</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="group relative bg-linear-to-b from-gray-900 to-black border border-gray-800 rounded-2xl p-8 hover:border-red-600/50 transition-all duration-300">
                    <div class="w-16 h-16 bg-red-600/20 rounded-xl flex items-center justify-center mb-6 transition-all duration-300 group-hover:bg-red-600/30">
                        <span class="text-4xl">⚡</span>
                    </div>
                    <h3 class="text-3xl font-bold mb-4 text-white">Quick Release</h3>
                    <p class="text-gray-400 text-lg leading-relaxed">
                        Remove in seconds for car shows, then reattach just as fast for daily driving.
                    </p>
                </div>
                <div class="bg-black rounded-2xl p-6">
                    <code class="text-xs text-gray-400 leading-relaxed">
                        bg-linear-to-b from-gray-900 to-black<br>
                        border border-gray-800 rounded-2xl p-8<br>
                        hover:border-red-600/50 transition-all duration-300
                    </code>
                </div>
            </div>
        </div>

        <!-- Numbered Feature -->
        <div class="mb-16">
            <h3 class="text-3xl font-bold text-white mb-8">Numbered Feature (Step)</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="flex gap-6 items-start">
                    <div class="shrink-0 w-16 h-16 bg-linear-to-br from-red-600 to-red-800 rounded-2xl flex items-center justify-center text-white font-black text-2xl">
                        1
                    </div>
                    <div>
                        <h3 class="text-3xl font-bold mb-3 text-white">Zero Drilling, Ever</h3>
                        <p class="text-gray-400 text-lg leading-relaxed">
                            Industrial-strength velcro keeps your plate secure while keeping your bumper pristine.
                        </p>
                    </div>
                </div>
                <div class="bg-black rounded-2xl p-6">
                    <code class="text-xs text-gray-400 leading-relaxed">
                        w-16 h-16 bg-linear-to-br from-red-600 to-red-800<br>
                        rounded-2xl text-white font-black text-2xl
                    </code>
                </div>
            </div>
        </div>

        <!-- Info Box -->
        <div>
            <h3 class="text-3xl font-bold text-white mb-8">Info Box (Benefits List)</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-linear-to-br from-gray-900 to-black border border-gray-800 rounded-2xl p-6 space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-linear-to-br from-red-600 to-red-800 rounded-lg flex items-center justify-center shrink-0 mt-1">
                            <span class="text-white font-bold text-sm">✓</span>
                        </div>
                        <div>
                            <span class="text-white font-semibold">No Drilling Required</span>
                            <p class="text-gray-400 text-sm">Keep your bumper pristine. Zero permanent damage.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-linear-to-br from-red-600 to-red-800 rounded-lg flex items-center justify-center shrink-0 mt-1">
                            <span class="text-white font-bold text-sm">✓</span>
                        </div>
                        <div>
                            <span class="text-white font-semibold">60-Second Installation</span>
                            <p class="text-gray-400 text-sm">Attach velcro, mount on visor. Done.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-black rounded-2xl p-6">
                    <code class="text-xs text-gray-400 leading-relaxed">
                        bg-linear-to-br from-gray-900 to-black<br>
                        border border-gray-800 rounded-2xl p-6<br>
                        w-6 h-6 bg-linear-to-br from-red-600 to-red-800 rounded-lg
                    </code>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FORMS -->
<section id="forms" class="py-20 bg-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-5xl font-black text-white mb-4">Form Elements</h2>
        <p class="text-xl text-gray-400 mb-12">Clean inputs with red focus states.</p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Form Examples -->
            <div class="space-y-8">
                <!-- Select Dropdown -->
                <div>
                    <label class="block text-lg font-bold mb-4 text-white">Select Dropdown</label>
                    <select class="w-full p-5 text-lg bg-black border-2 border-gray-800 rounded-xl focus:border-red-600 focus:ring-2 focus:ring-red-600/50 outline-none text-white transition">
                        <option>-- Choose an option --</option>
                        <option>Option 1</option>
                        <option>Option 2</option>
                    </select>
                </div>

                <!-- Text Input -->
                <div>
                    <label class="block text-lg font-bold mb-4 text-white">Text Input</label>
                    <input type="text" placeholder="Enter text..." class="w-full p-5 text-lg bg-black border-2 border-gray-800 rounded-xl focus:border-red-600 focus:ring-2 focus:ring-red-600/50 outline-none text-white placeholder-gray-600 transition">
                </div>

                <!-- Number Input -->
                <div>
                    <label class="label-standard">Number Input (Quantity)</label>
                    <div class="flex items-center gap-4">
                        <button class="btn-quantity">
                            −
                        </button>
                        <input type="number" value="1" min="1" class="input-quantity">
                        <button class="btn-quantity">
                            +
                        </button>
                    </div>
                </div>

                <!-- Textarea -->
                <div>
                    <label class="block text-lg font-bold mb-4 text-white">Textarea</label>
                    <textarea rows="4" placeholder="Enter message..." class="w-full p-5 text-lg bg-black border-2 border-gray-800 rounded-xl focus:border-red-600 focus:ring-2 focus:ring-red-600/50 outline-none text-white placeholder-gray-600 transition resize-none"></textarea>
                </div>
            </div>

            <!-- Code Examples -->
            <div class="bg-gray-900 rounded-2xl p-8">
                <h4 class="text-xl font-bold text-white mb-6">Form Styling Classes</h4>
                <div class="space-y-6">
                    <div>
                        <div class="text-sm font-semibold text-red-500 mb-2">Select / Input:</div>
                        <code class="text-xs text-gray-400 bg-black px-3 py-2 rounded block">
                            w-full p-5 text-lg bg-black<br>
                            border-2 border-gray-800 rounded-xl<br>
                            focus:border-red-600 focus:ring-2 focus:ring-red-600/50<br>
                            outline-none text-white transition
                        </code>
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-red-500 mb-2">Label:</div>
                        <code class="text-xs text-gray-400 bg-black px-3 py-2 rounded block">
                            block text-lg font-bold mb-4 text-white
                        </code>
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-red-500 mb-2">Quantity Button:</div>
                        <code class="text-xs text-gray-400 bg-black px-3 py-2 rounded block">
                            w-12 h-12 bg-gray-800 hover:bg-gray-700<br>
                            rounded-lg text-white font-bold text-xl transition
                        </code>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SPACING SYSTEM -->
<section id="spacing" class="py-20 bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-5xl font-black text-white mb-4">Spacing System</h2>
        <p class="text-xl text-gray-400 mb-12">Generous, consistent spacing throughout.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Section Padding -->
            <div>
                <h3 class="text-3xl font-bold text-white mb-6">Section Padding</h3>
                <div class="bg-black rounded-2xl p-8 space-y-6">
                    <div class="flex justify-between items-center border-b border-gray-800 pb-4">
                        <span class="text-white font-semibold">Hero Sections</span>
                        <code class="text-sm text-gray-400 bg-gray-900 px-3 py-1 rounded">py-32</code>
                    </div>
                    <div class="flex justify-between items-center border-b border-gray-800 pb-4">
                        <span class="text-white font-semibold">Content Sections</span>
                        <code class="text-sm text-gray-400 bg-gray-900 px-3 py-1 rounded">py-20</code>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-white font-semibold">Compact Sections</span>
                        <code class="text-sm text-gray-400 bg-gray-900 px-3 py-1 rounded">py-16</code>
                    </div>
                </div>
            </div>

            <!-- Component Spacing -->
            <div>
                <h3 class="text-3xl font-bold text-white mb-6">Component Gaps</h3>
                <div class="bg-black rounded-2xl p-8 space-y-6">
                    <div class="flex justify-between items-center border-b border-gray-800 pb-4">
                        <span class="text-white font-semibold">Large Gap (Sections)</span>
                        <code class="text-sm text-gray-400 bg-gray-900 px-3 py-1 rounded">gap-16</code>
                    </div>
                    <div class="flex justify-between items-center border-b border-gray-800 pb-4">
                        <span class="text-white font-semibold">Medium Gap (Grids)</span>
                        <code class="text-sm text-gray-400 bg-gray-900 px-3 py-1 rounded">gap-8</code>
                    </div>
                    <div class="flex justify-between items-center border-b border-gray-800 pb-4">
                        <span class="text-white font-semibold">Standard Gap</span>
                        <code class="text-sm text-gray-400 bg-gray-900 px-3 py-1 rounded">gap-6</code>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-white font-semibold">Tight Gap</span>
                        <code class="text-sm text-gray-400 bg-gray-900 px-3 py-1 rounded">gap-4</code>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visual Examples -->
        <div class="mt-12">
            <h3 class="text-3xl font-bold text-white mb-6">Visual Spacing Examples</h3>
            <div class="grid grid-cols-3 gap-8">
                <div class="bg-black rounded-2xl p-4">
                    <div class="space-y-2">
                        <div class="h-8 bg-red-600/20 rounded"></div>
                        <div class="h-8 bg-red-600/20 rounded"></div>
                        <div class="h-8 bg-red-600/20 rounded"></div>
                    </div>
                    <div class="text-center mt-4">
                        <code class="text-xs text-gray-400">space-y-2</code>
                    </div>
                </div>
                <div class="bg-black rounded-2xl p-4">
                    <div class="space-y-4">
                        <div class="h-8 bg-red-600/20 rounded"></div>
                        <div class="h-8 bg-red-600/20 rounded"></div>
                        <div class="h-8 bg-red-600/20 rounded"></div>
                    </div>
                    <div class="text-center mt-4">
                        <code class="text-xs text-gray-400">space-y-4</code>
                    </div>
                </div>
                <div class="bg-black rounded-2xl p-4">
                    <div class="space-y-8">
                        <div class="h-8 bg-red-600/20 rounded"></div>
                        <div class="h-8 bg-red-600/20 rounded"></div>
                        <div class="h-8 bg-red-600/20 rounded"></div>
                    </div>
                    <div class="text-center mt-4">
                        <code class="text-xs text-gray-400">space-y-8</code>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- GRADIENTS -->
<section id="gradients" class="py-20 bg-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-5xl font-black text-white mb-4">Gradients</h2>
        <p class="text-xl text-gray-400 mb-12">Subtle depth and visual interest.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Background Gradients -->
            <div>
                <h3 class="text-3xl font-bold text-white mb-8">Background Gradients</h3>
                <div class="space-y-6">
                    <div>
                        <div class="h-32 bg-linear-to-b from-black to-gray-900 rounded-2xl border border-gray-800"></div>
                        <code class="text-sm text-gray-400 mt-3 block">bg-linear-to-b from-black to-gray-900</code>
                    </div>
                    <div>
                        <div class="h-32 bg-linear-to-b from-gray-900 to-black rounded-2xl border border-gray-800"></div>
                        <code class="text-sm text-gray-400 mt-3 block">bg-linear-to-b from-gray-900 to-black</code>
                    </div>
                    <div>
                        <div class="h-32 bg-linear-to-br from-gray-900 to-black rounded-2xl border border-gray-800"></div>
                        <code class="text-sm text-gray-400 mt-3 block">bg-linear-to-br from-gray-900 to-black</code>
                    </div>
                </div>
            </div>

            <!-- Red Gradients -->
            <div>
                <h3 class="text-3xl font-bold text-white mb-8">Red Accent Gradients</h3>
                <div class="space-y-6">
                    <div>
                        <div class="h-32 bg-linear-to-r from-red-600 to-red-700 rounded-2xl"></div>
                        <code class="text-sm text-gray-400 mt-3 block">bg-linear-to-r from-red-600 to-red-700</code>
                        <p class="text-xs text-gray-500 mt-1">Used for: Buttons, text highlights</p>
                    </div>
                    <div>
                        <div class="h-32 bg-linear-to-br from-red-600 to-red-800 rounded-2xl"></div>
                        <code class="text-sm text-gray-400 mt-3 block">bg-linear-to-br from-red-600 to-red-800</code>
                        <p class="text-xs text-gray-500 mt-1">Used for: Icons, badges, numbered steps</p>
                    </div>
                    <div>
                        <div class="h-32 bg-red-900/30 border-2 border-red-600/50 rounded-2xl"></div>
                        <code class="text-sm text-gray-400 mt-3 block">bg-red-900/30 border-red-600/50</code>
                        <p class="text-xs text-gray-500 mt-1">Used for: Alert boxes, important notices</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Text Gradient -->
        <div class="mt-12">
            <h3 class="text-3xl font-bold text-white mb-8">Text Gradient (Hero Titles)</h3>
            <div class="bg-gray-900 rounded-2xl p-12 text-center">
                <h1 class="text-6xl font-black text-transparent bg-clip-text bg-linear-to-r from-red-500 to-red-700 mb-6">
                    Gradient Text Example
                </h1>
                <code class="text-sm text-gray-400 bg-black px-4 py-2 rounded inline-block">
                    text-transparent bg-clip-text bg-linear-to-r from-red-500 to-red-700
                </code>
            </div>
        </div>
    </div>
</section>

<!-- INTERACTIVE COMPONENTS -->
<section id="components" class="py-20 bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-5xl font-black text-white mb-4">Interactive Components</h2>
        <p class="text-xl text-gray-400 mb-12">Alpine.js powered interactions and animations.</p>

        <!-- Badges & Pills -->
        <div class="mb-16">
            <h3 class="text-3xl font-bold text-white mb-8">Badges & Pills</h3>
            <div class="bg-black rounded-2xl p-12 flex flex-wrap gap-6 justify-center">
                <span class="bg-red-600/20 text-red-500 px-6 py-2 rounded-full text-sm font-semibold border border-red-600/30 backdrop-blur-sm">
                    PREMIUM SOLUTION
                </span>
                <span class="bg-red-600/20 text-red-500 px-6 py-2 rounded-full text-sm font-semibold border border-red-600/30">
                    FOR SHOW CARS
                </span>
                <span class="bg-gray-800 text-gray-300 px-4 py-1 rounded-full text-xs font-semibold">
                    NEW
                </span>
            </div>
            <div class="text-center mt-6">
                <code class="text-sm text-gray-400 bg-black px-4 py-2 rounded">
                    bg-red-600/20 text-red-500 px-6 py-2 rounded-full<br>
                    text-sm font-semibold border border-red-600/30
                </code>
            </div>
        </div>

        <!-- Trust Badges -->
        <div class="mb-16">
            <h3 class="text-3xl font-bold text-white mb-8">Trust Badges / Social Proof</h3>
            <div class="bg-black rounded-2xl p-12">
                <div class="flex flex-wrap gap-6 justify-center text-sm">
                    <div class="flex items-center gap-2 text-gray-400">
                        <span class="text-red-500 text-xl">✓</span>
                        <span>No Drilling Required</span>
                    </div>
                    <div class="flex items-center gap-2 text-gray-400">
                        <span class="text-red-500 text-xl">✓</span>
                        <span>60 Second Install</span>
                    </div>
                    <div class="flex items-center gap-2 text-gray-400">
                        <span class="text-red-500 text-xl">✓</span>
                        <span>Perfect for Show Cars</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dot Indicators (Carousel) -->
        <div class="mb-16">
            <h3 class="text-3xl font-bold text-white mb-8">Carousel Indicators</h3>
            <div class="bg-black rounded-2xl p-12 flex justify-center gap-3">
                <div class="w-12 h-3 bg-linear-to-r from-red-600 to-red-700 rounded-full"></div>
                <div class="w-3 h-3 bg-gray-700 rounded-full"></div>
                <div class="w-3 h-3 bg-gray-700 rounded-full"></div>
                <div class="w-3 h-3 bg-gray-700 rounded-full"></div>
            </div>
            <div class="text-center mt-6">
                <code class="text-sm text-gray-400 bg-black px-4 py-2 rounded">
                    Active: w-12 h-3 bg-linear-to-r from-red-600 to-red-700 rounded-full<br>
                    Inactive: w-3 h-3 bg-gray-700 rounded-full
                </code>
            </div>
        </div>

        <!-- Image Overlays -->
        <div>
            <h3 class="text-3xl font-bold text-white mb-8">Image Overlays & Borders</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="rounded-2xl overflow-hidden border border-gray-800 hover:border-red-600/50 transition-all duration-300 shadow-xl h-48 bg-gray-800 flex items-center justify-center">
                    <span class="text-gray-600 text-sm">Hover Me</span>
                </div>
                <div class="rounded-2xl overflow-hidden border-2 border-red-600 h-48 bg-gray-800 flex items-center justify-center">
                    <span class="text-red-600 text-sm font-bold">Active State</span>
                </div>
                <div class="rounded-3xl overflow-hidden border-2 border-gray-800 shadow-2xl h-48 bg-gray-900 flex items-center justify-center">
                    <span class="text-gray-500 text-sm">Product Image</span>
                </div>
            </div>
            <div class="mt-6 bg-black rounded-2xl p-6">
                <code class="text-xs text-gray-400">
                    rounded-2xl border border-gray-800<br>
                    hover:border-red-600/50 transition-all duration-300<br>
                    shadow-xl (optional for depth)
                </code>
            </div>
        </div>
    </div>
</section>

<!-- RESPONSIVE BREAKPOINTS -->
<section class="py-20 bg-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-5xl font-black text-white mb-4">Responsive System</h2>
        <p class="text-xl text-gray-400 mb-12">Mobile-first approach with clear breakpoints.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-8 text-center">
                <div class="text-4xl mb-4">📱</div>
                <h3 class="text-2xl font-bold text-white mb-2">Default</h3>
                <code class="text-sm text-gray-400">0px - 639px</code>
                <p class="text-gray-500 text-xs mt-2">Mobile-first base styles</p>
            </div>
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-8 text-center">
                <div class="text-4xl mb-4">📱</div>
                <h3 class="text-2xl font-bold text-white mb-2">sm:</h3>
                <code class="text-sm text-gray-400">640px+</code>
                <p class="text-gray-500 text-xs mt-2">Small tablets</p>
            </div>
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-8 text-center">
                <div class="text-4xl mb-4">💻</div>
                <h3 class="text-2xl font-bold text-white mb-2">md:</h3>
                <code class="text-sm text-gray-400">768px+</code>
                <p class="text-gray-500 text-xs mt-2">Tablets</p>
            </div>
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-8 text-center">
                <div class="text-4xl mb-4">🖥️</div>
                <h3 class="text-2xl font-bold text-white mb-2">lg:</h3>
                <code class="text-sm text-gray-400">1024px+</code>
                <p class="text-gray-500 text-xs mt-2">Desktop</p>
            </div>
        </div>

        <!-- Example Usage -->
        <div class="mt-12 bg-gray-900 rounded-2xl p-8">
            <h3 class="text-2xl font-bold text-white mb-6">Example Usage</h3>
            <div class="bg-black rounded-xl p-6">
                <code class="text-sm text-gray-400 leading-relaxed">
                    &lt;h1 class="text-6xl md:text-8xl"&gt;Hero Title&lt;/h1&gt;<br>
                    &lt;p class="text-xl md:text-3xl"&gt;Subheading&lt;/p&gt;<br>
                    &lt;div class="grid grid-cols-1 md:grid-cols-3"&gt;Cards&lt;/div&gt;
                </code>
            </div>
            <p class="text-gray-400 text-sm mt-4">
                Mobile gets smaller text and single column, desktop gets larger text and multi-column grids.
            </p>
        </div>
    </div>
</section>

<!-- ANIMATION PATTERNS -->
<section class="py-20 bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-5xl font-black text-white mb-4">Animation Patterns</h2>
        <p class="text-xl text-gray-400 mb-12">Subtle, performant transitions. No jarring movements.</p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Transitions -->
            <div>
                <h3 class="text-3xl font-bold text-white mb-8">Standard Transitions</h3>
                <div class="bg-black rounded-2xl p-8 space-y-6">
                    <div>
                        <div class="inline-block bg-gray-800 px-6 py-3 rounded-lg transition-all duration-300 hover:bg-red-600 cursor-pointer">
                            <span class="text-white">Hover Me (300ms)</span>
                        </div>
                        <code class="text-xs text-gray-400 block mt-3">transition-all duration-300</code>
                    </div>
                    <div>
                        <div class="inline-block bg-gray-800 px-6 py-3 rounded-lg transition-colors duration-200 hover:bg-red-600 cursor-pointer">
                            <span class="text-white">Color Only (200ms)</span>
                        </div>
                        <code class="text-xs text-gray-400 block mt-3">transition-colors duration-200</code>
                    </div>
                    <div>
                        <div class="inline-block bg-gray-800 px-6 py-3 rounded-lg transition-all duration-500 hover:bg-red-600 cursor-pointer">
                            <span class="text-white">Slow (500ms)</span>
                        </div>
                        <code class="text-xs text-gray-400 block mt-3">transition-all duration-500</code>
                    </div>
                </div>
            </div>

            <!-- Alpine.js Transitions -->
            <div>
                <h3 class="text-3xl font-bold text-white mb-8">Alpine.js Fade Transitions</h3>
                <div class="bg-black rounded-2xl p-8">
                    <code class="text-xs text-gray-400 leading-relaxed block mb-4">
                        x-transition:enter="transition ease-out duration-500"<br>
                        x-transition:enter-start="opacity-0"<br>
                        x-transition:enter-end="opacity-100"<br>
                        x-transition:leave="transition ease-in duration-300"<br>
                        x-transition:leave-start="opacity-100"<br>
                        x-transition:leave-end="opacity-0"
                    </code>
                    <p class="text-gray-500 text-sm">Used for: Carousel slides, state checker results</p>
                </div>
            </div>
        </div>

        <!-- Rules -->
        <div class="mt-12 bg-red-900/20 border-2 border-red-600/50 rounded-2xl p-8">
            <h3 class="text-2xl font-bold text-white mb-4">❌ Animation Rules (DON'T DO)</h3>
            <div class="space-y-3 text-red-200">
                <div class="flex items-start gap-3">
                    <span class="text-red-500 font-bold">×</span>
                    <span>NO transform scale() on hover (causes layout shift)</span>
                </div>
                <div class="flex items-start gap-3">
                    <span class="text-red-500 font-bold">×</span>
                    <span>NO drop shadows on buttons (looks dated)</span>
                </div>
                <div class="flex items-start gap-3">
                    <span class="text-red-500 font-bold">×</span>
                    <span>NO bouncing animations (except scroll indicator)</span>
                </div>
                <div class="flex items-start gap-3">
                    <span class="text-red-500 font-bold">×</span>
                    <span>NO rotating elements (feels gimmicky)</span>
                </div>
            </div>
        </div>
    </section>

<!-- COMPONENT CLASS REFERENCE -->
<section class="py-20 bg-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-black text-white mb-6 text-center">Component Class Reference</h2>
        <p class="text-xl text-gray-400 mb-12 text-center">
            Ready-to-use classes defined in app.css
        </p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <!-- Buttons -->
            <div class="bg-gray-900 rounded-2xl p-8">
                <h3 class="text-2xl font-bold text-red-500 mb-6">🔘 Buttons</h3>
                <div class="space-y-6">
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <code class="text-sm text-gray-400 bg-black px-3 py-1 rounded">.btn-primary</code>
                            <button class="border-2 border-red-600 text-red-500 px-8 py-3 rounded-lg text-base font-bold transition-all duration-300 hover:bg-red-600 hover:text-white">Demo</button>
                        </div>
                        <p class="text-xs text-gray-500">Large CTA button - red outline to fill</p>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <code class="text-sm text-gray-400 bg-black px-3 py-1 rounded">.btn-secondary</code>
                            <button class="border-2 border-white/30 text-white px-6 py-2 rounded-lg text-sm font-bold transition-all duration-300 hover:bg-white/10">Demo</button>
                        </div>
                        <p class="text-xs text-gray-500">Secondary button - white outline</p>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-3">
                            <code class="text-sm text-gray-400 bg-black px-3 py-1 rounded">.btn-quantity</code>
                            <button class="w-12 h-12 bg-gray-800 hover:bg-gray-700 rounded-lg flex items-center justify-center text-white font-bold text-xl transition">−</button>
                        </div>
                        <p class="text-xs text-gray-500">Quantity selector +/- buttons</p>
                    </div>
                </div>
            </div>

            <!-- Forms -->
            <div class="bg-gray-900 rounded-2xl p-8">
                <h3 class="text-2xl font-bold text-red-500 mb-6">📝 Forms</h3>
                <div class="space-y-6">
                    <div>
                        <code class="text-sm text-gray-400 bg-black px-3 py-1 rounded block mb-3">.input-standard</code>
                        <p class="text-xs text-gray-500 mb-3">Text inputs, selects, textareas</p>
                        <input type="text" placeholder="Example..." class="w-full p-5 text-lg bg-black border-2 border-gray-800 rounded-xl focus:border-red-600 focus:ring-2 focus:ring-red-600/50 outline-none text-white transition">
                    </div>
                    <div>
                        <code class="text-sm text-gray-400 bg-black px-3 py-1 rounded block mb-3">.input-quantity</code>
                        <p class="text-xs text-gray-500 mb-3">Number input (spinners removed!)</p>
                        <input type="number" value="1" class="input-quantity">
                    </div>
                </div>
            </div>
        </div>

        <!-- Usage Example -->
        <div class="bg-linear-to-br from-red-900/20 to-red-800/10 border-2 border-red-600/30 rounded-2xl p-8">
            <h3 class="text-2xl font-bold text-white mb-4">💡 Usage Example</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div>
                    <p class="text-red-200 mb-4 font-semibold">Before (Utility Classes):</p>
                    <code class="text-xs text-gray-300 bg-black/50 p-4 rounded-xl block leading-relaxed">
                        &lt;button class="border-2 border-red-600<br>
                        &nbsp;&nbsp;text-red-500 px-12 py-5 rounded-xl<br>
                        &nbsp;&nbsp;text-xl font-bold transition-all<br>
                        &nbsp;&nbsp;duration-300 hover:bg-red-600<br>
                        &nbsp;&nbsp;hover:text-white"&gt;<br>
                        &nbsp;&nbsp;Shop Now<br>
                        &lt;/button&gt;
                    </code>
                </div>
                <div>
                    <p class="text-red-200 mb-4 font-semibold">After (Component Class):</p>
                    <code class="text-xs text-gray-300 bg-black/50 p-4 rounded-xl block leading-relaxed">
                        &lt;button class="btn-primary"&gt;<br>
                        &nbsp;&nbsp;Shop Now<br>
                        &lt;/button&gt;
                    </code>
                    <div class="mt-4 flex items-center gap-2">
                        <span class="text-green-400 text-2xl">✓</span>
                        <span class="text-green-300 text-sm">94% less code, same result!</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Installation -->
        <div class="mt-12 bg-gray-900 rounded-2xl p-8">
            <h3 class="text-2xl font-bold text-white mb-6">📦 Installation</h3>
            <ol class="space-y-4 text-gray-300">
                <li class="flex gap-3">
                    <span class="text-red-500 font-bold">1.</span>
                    <div>
                        <p>Replace <code class="text-sm bg-black px-2 py-1 rounded">resources/css/app.css</code> with the new version</p>
                    </div>
                </li>
                <li class="flex gap-3">
                    <span class="text-red-500 font-bold">2.</span>
                    <div>
                        <p>Restart Vite: <code class="text-sm bg-black px-2 py-1 rounded">npm run dev</code></p>
                    </div>
                </li>
                <li class="flex gap-3">
                    <span class="text-red-500 font-bold">3.</span>
                    <div>
                        <p>Start using component classes in your Blade templates!</p>
                    </div>
                </li>
            </ol>
            <div class="mt-6 bg-black rounded-xl p-4">
                <p class="text-sm text-gray-400 mb-2">Note: The number input spinner fix is automatic once app.css is replaced. No changes needed in HTML!</p>
            </div>
        </div>

        <div class="mt-12 text-center">
            <a href="{{ url('/') }}" class="inline-block border-2 border-red-600 text-red-500 px-10 py-4 rounded-xl text-lg font-bold transition-all duration-300 hover:bg-red-600 hover:text-white">
                ← Back to Homepage
            </a>
        </div>
    </div>
</section>

@endsection
