<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'GrindlY') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-white text-gray-900">

    <!-- Navbar -->
    <header class="fixed top-0 inset-x-0 z-50 bg-white/80 backdrop-blur-md shadow-sm">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center space-x-2">
                <img src="{{ asset('storage/images/grindly-logo.png') }}" alt="GrindlY Logo" class="h-10 w-auto rounded-lg">
                <span class="text-2xl md:text-3xl font-extrabold text-gray-900">
                    Grindl<span class="text-indigo-700">Y</span>
                </span>
            </a>
            <nav class="space-x-4 text-sm font-medium">
                <a href="{{ route('register') }}" class="text-gray-800 hover:text-indigo-600">Sign Up</a>
                <a href="{{ route('login') }}" class="text-gray-800 hover:text-indigo-600">Sign In</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section 
        class="min-h-screen flex items-center bg-cover bg-center text-white relative"
        style="background-image: url('{{ asset('storage/images/landing.jpg') }}');"
    >
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-900/90 via-indigo-800/80 to-indigo-700/80"></div>
        <div class="relative z-10 container mx-auto px-6 md:px-12">
            <div class="max-w-2xl">
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                    Dominate Your Study Goals with <span class="text-pink-400">GrindlY</span>
                </h1>
                <p class="text-lg md:text-xl mb-8 text-gray-100">
                    Stay consistent. Gamify your grind. Build your legacy — one focused session at a time.
                </p>
                <div class="space-x-4">
                    <a href="{{ route('register') }}" class="bg-white text-indigo-700 font-semibold px-6 py-3 rounded-xl shadow-md hover:bg-gray-100 transition">
                        Get Started
                    </a>
                    <a href="{{ route('login') }}" class="bg-indigo-900/30 border border-white text-white font-semibold px-6 py-3 rounded-xl hover:bg-indigo-900/50 transition">
                        Sign In
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!-- Features Section -->
    <section class="py-20 bg-white text-center">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-900">Why GrindlY?</h2>
            <p class="mt-2 text-gray-600 max-w-xl mx-auto">
                Not just another planner — your motivator, your strategy partner, your edge.
            </p>
            <div class="mt-12 grid gap-10 sm:grid-cols-2 md:grid-cols-3">
                <div class="bg-gray-50 rounded-xl shadow-sm p-6 hover:shadow-md transition">
                    <h3 class="text-xl font-semibold text-indigo-700">Smart Study Tracking</h3>
                    <p class="mt-2 text-gray-600">Automatically log your study sessions, review trends, and stay on track.</p>
                </div>
                <div class="bg-gray-50 rounded-xl shadow-sm p-6 hover:shadow-md transition">
                    <h3 class="text-xl font-semibold text-indigo-700">Gamified Experience</h3>
                    <p class="mt-2 text-gray-600">Earn XP, build streaks, and level up your learning lifestyle.</p>
                </div>
                <div class="bg-gray-50 rounded-xl shadow-sm p-6 hover:shadow-md transition">
                    <h3 class="text-xl font-semibold text-indigo-700">More to come...</h3>
                    <p class="mt-2 text-gray-600">The future is bright for GrindlY.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call-to-Action Section -->
    <section class="py-20 bg-gradient-to-r from-indigo-700 via-purple-700 to-pink-600 text-white text-center">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold">Ready to dominate your learning goals?</h2>
            <p class="mt-4 text-lg max-w-xl mx-auto">GrindlY is free to start. Join thousands of focused learners and build your streak today.</p>
            <a href="{{ route('register') }}" class="mt-6 inline-block bg-white text-indigo-700 px-8 py-3 rounded-xl font-semibold shadow-md hover:bg-gray-100 transition">
                Start Grinding
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-10">
        <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center">
            <p>&copy; {{ date('Y') }} GrindlY. All rights reserved.</p>
            <div class="space-x-4 mt-4 md:mt-0 text-sm">
                <a href="#" class="hover:text-white">Privacy</a>
                <a href="#" class="hover:text-white">Terms</a>
                <a href="#" class="hover:text-white">Contact</a>
            </div>
        </div>
    </footer>

</body>
</html>
