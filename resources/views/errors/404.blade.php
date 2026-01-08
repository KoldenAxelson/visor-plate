<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | Visor Plate</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-black text-white">
    <!-- Full Navigation Bar -->
    <nav class="fixed top-0 w-full bg-black/95 backdrop-blur-sm border-b z-50" style="border-color: rgba(184, 115, 51, 0.3);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: linear-gradient(135deg, var(--accent-copper), var(--accent-gold));">
                        <span class="text-white font-bold text-xl">V</span>
                    </div>
                    <div class="font-bold text-2xl tracking-tight">
                        <span class="text-white">Visor</span>
                        <span style="color: var(--accent-copper);">Plate</span>
                    </div>
                </a>
                <div class="flex gap-8 items-center">
                    <a href="{{ url('/#features') }}" class="text-gray-300 transition hidden md:block link-underline" style="color: var(--text-primary);">Features</a>
                    <a href="{{ url('/#state-checker') }}" class="text-gray-300 transition hidden md:block link-underline" style="color: var(--text-primary);">State Requirements</a>
                    <a href="{{ url('/#how-it-works') }}" class="text-gray-300 transition hidden md:block link-underline" style="color: var(--text-primary);">How It Works</a>
                    <a href="{{ route('shop') }}" class="btn-primary-sm">
                        Shop
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- 404 Content -->
    <section class="min-h-screen flex items-center justify-center py-20 pt-32">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- 404 Number -->
            <div class="mb-8">
                <h1 class="text-9xl md:text-[200px] font-light text-gradient-copper leading-none tracking-luxury">
                    404
                </h1>
            </div>

            <!-- Error Message -->
            <div class="mb-12">
                <h2 class="text-4xl md:text-5xl font-light text-white mb-6 tracking-luxury">
                    Oops! This Page Took a Wrong Turn
                </h2>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto font-light tracking-wide">
                    Looks like this feature is still in the garage getting worked on. Don't worry, we'll have it road-ready soon!
                </p>
            </div>

            <!-- Helpful Links -->
            <div class="card-info mb-12 inline-block">
                <h3 class="text-xl font-semibold text-white mb-6 tracking-wide">Where would you like to go?</h3>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ url('/') }}" class="btn-primary-luxury">
                        ← Back to Home
                    </a>
                    <a href="{{ route('shop') }}" class="btn-secondary">
                        Shop Visor Plate →
                    </a>
                </div>
            </div>

            <!-- Feature Status -->
            <div class="text-gray-500 text-sm font-light">
                <p>This feature is coming soon. Check back later!</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-gray-800 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-500 text-sm font-light">
            <p>&copy; {{ date('Y') }} Visor Plate. Preserve your ride's beauty.</p>
        </div>
    </footer>
</body>
</html>
