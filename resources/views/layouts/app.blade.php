<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Visor Plate - Front License Plate Solution')</title>
    <meta name="description" content="The no-drill front license plate solution for car enthusiasts. Easy velcro installation on your sun visor.">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-white text-gray-900">
    <!-- Simple Header/Nav -->
    <nav class="fixed top-0 w-full bg-black/95 backdrop-blur-sm border-b border-red-600/30 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-linear-to-br from-red-600 to-red-800 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-xl">V</span>
                    </div>
                    <div class="font-bold text-2xl tracking-tight">
                        <span class="text-white">Visor</span>
                        <span class="text-red-600">Plate</span>
                    </div>
                </a>
                <div class="flex gap-8 items-center">
                    <a href="{{ url('/#features') }}" class="text-gray-300 hover:text-red-600 transition hidden md:block">Features</a>
                    <a href="{{ url('/#state-checker') }}" class="text-gray-300 hover:text-red-600 transition hidden md:block">State Requirements</a>
                    <a href="{{ url('/#how-it-works') }}" class="text-gray-300 hover:text-red-600 transition hidden md:block">How It Works</a>
                    <a href="{{ route('shop') }}" class="bg-linear-to-r from-red-600 to-red-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-300 hover:from-red-700 hover:to-red-800 hover:shadow-lg hover:shadow-red-600/50">
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

    <!-- Simple Footer -->
    <footer class="bg-linear-to-b from-black to-gray-900 border-t border-gray-800 py-16 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-2">
                    <a href="{{ url('/') }}" class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-linear-to-br from-red-600 to-red-800 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-2xl">V</span>
                        </div>
                        <div class="font-bold text-2xl">
                            <span class="text-white">Visor</span>
                            <span class="text-red-600">Plate</span>
                        </div>
                    </a>
                    <p class="text-gray-400 max-w-md">
                        The premium no-drill front license plate solution designed for car enthusiasts who refuse to compromise their vehicle's aesthetic.
                    </p>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4 text-red-600">Quick Links</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="{{ url('/#features') }}" class="hover:text-red-600 transition">Features</a></li>
                        <li><a href="{{ url('/#gallery') }}" class="hover:text-red-600 transition">Gallery</a></li>
                        <li><a href="{{ url('/#state-checker') }}" class="hover:text-red-600 transition">State Requirements</a></li>
                        <li><a href="{{ url('/#how-it-works') }}" class="hover:text-red-600 transition">Installation</a></li>
                        <li><a href="{{ route('shop') }}" class="hover:text-red-600 transition">Shop</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4 text-red-600">Support</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="/contact" class="hover:text-red-600 transition">Contact Us</a></li>
                        <li><a href="/wholesale" class="hover:text-red-600 transition">Wholesale Inquiry</a></li>
                        <li><a href="/shipping" class="hover:text-red-600 transition">Shipping Info</a></li>
                        <li><a href="/returns" class="hover:text-red-600 transition">Returns</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-500 text-sm">
                    &copy; {{ date('Y') }} Visor Plate. Preserve your ride's beauty.
                </p>
                <p class="text-gray-500 text-sm mt-4 md:mt-0">
                    Made for car enthusiasts, by car enthusiasts.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
