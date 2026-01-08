<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'VisorPlate - Front License Plate Solution')</title>
    <meta name="description" content="The no-drill front license plate solution for car enthusiasts. Easy velcro installation on your sun visor.">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased text-gray-900" style="background-color: var(--bg-luxury-black); color: var(--text-primary);">
    <!-- Luxury Header/Nav -->
    <nav class="fixed top-0 w-full bg-black/95 backdrop-blur-sm border-b z-50" style="border-color: rgba(184, 115, 51, 0.3);">
        <div class="container-site">
            <div class="flex justify-between items-center h-20">
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center transition-all duration-300" style="background: linear-gradient(135deg, var(--accent-copper), var(--accent-gold));">
                        <span class="text-white font-bold text-xl">V</span>
                    </div>
                    <div class="font-bold text-2xl tracking-tight">
                        <span class="text-white">Visor</span>
                        <span style="color: var(--accent-copper);">Plate</span>
                    </div>
                </a>
                <div class="flex gap-8 items-center">
                    <a href="{{ url('/#features') }}" class="text-gray-300 transition hidden md:block link-underline font-light" style="color: var(--text-primary);">Features</a>
                    <a href="{{ url('/#state-checker') }}" class="text-gray-300 transition hidden md:block link-underline font-light" style="color: var(--text-primary);">State Requirements</a>
                    <a href="{{ url('/#how-it-works') }}" class="text-gray-300 transition hidden md:block link-underline font-light" style="color: var(--text-primary);">How It Works</a>
                    <a href="{{ route('shop') }}" class="btn-primary-sm">
                        Shop
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-16">
        @yield('content')
    </main>

    <!-- Luxury Footer -->
    <footer class="bg-linear-to-b from-black to-gray-900 border-t border-gray-800 section-compact">
        <div class="container-site">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-2">
                    <a href="{{ url('/') }}" class="flex items-center gap-3 mb-4 group">
                        <div class="w-12 h-12 rounded-lg flex items-center justify-center transition-all duration-300" style="background: linear-gradient(135deg, var(--accent-copper), var(--accent-gold));">
                            <span class="text-white font-bold text-2xl">V</span>
                        </div>
                        <div class="font-bold text-2xl">
                            <span class="text-white">Visor</span>
                            <span style="color: var(--accent-copper);">Plate</span>
                        </div>
                    </a>
                    <p class="text-gray-400 max-w-md font-light leading-relaxed">
                        The premium no-drill front license plate solution designed for car enthusiasts who refuse to compromise their vehicle's aesthetic.
                    </p>
                </div>
                <div>
                    <h3 class="font-semibold text-lg mb-4 tracking-wide" style="color: var(--accent-copper);">Quick Links</h3>
                    <ul class="space-y-3 text-gray-400 font-light">
                        <li><a href="{{ url('/#features') }}" class="link-underline transition" style="color: var(--text-muted);">Features</a></li>
                        <li><a href="{{ url('/#gallery') }}" class="link-underline transition" style="color: var(--text-muted);">Gallery</a></li>
                        <li><a href="{{ url('/#state-checker') }}" class="link-underline transition" style="color: var(--text-muted);">State Requirements</a></li>
                        <li><a href="{{ url('/#how-it-works') }}" class="link-underline transition" style="color: var(--text-muted);">Installation</a></li>
                        <li><a href="{{ route('shop') }}" class="link-underline transition" style="color: var(--text-muted);">Shop</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-lg mb-4 tracking-wide" style="color: var(--accent-copper);">Support</h3>
                    <ul class="space-y-3 text-gray-400 font-light">
                        <li><a href="/contact" class="link-underline transition" style="color: var(--text-muted);">Contact Us</a></li>
                        <li><a href="/wholesale" class="link-underline transition" style="color: var(--text-muted);">Wholesale Inquiry</a></li>
                        <li><a href="/shipping" class="link-underline transition" style="color: var(--text-muted);">Shipping Info</a></li>
                        <li><a href="/returns" class="link-underline transition" style="color: var(--text-muted);">Returns</a></li>
                        <li><a href="/design" class="link-underline transition" style="color: var(--text-muted);">Design</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-500 text-sm font-light">
                    &copy; {{ date('Y') }} VisorPlate. Preserve your ride's beauty.
                </p>
                <p class="text-gray-500 text-sm mt-4 md:mt-0 font-light">
                    Made for car enthusiasts, by car enthusiasts.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
