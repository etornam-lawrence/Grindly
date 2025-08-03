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
    <header class="bg-white shadow-md fixed top-0 inset-x-0 z-50">
        <div class="container mx-auto flex items-center justify-between px-6 py-4">
            <a href="/" class="flex items-center space-x-2">
                <img src="{{ asset('storage/images/grindly-logo.png') }}" alt="GrindlY Logo" class="h-10 w-auto md:h-12 rounded-lg">
                <span class="text-2xl md:text-3xl font-extrabold text-gray-800 leading-tight">
                    Grindl<span class="text-indigo-700">Y</span>
                </span>
            </a>
            <nav class="space-x-4">
                <a href="{{ route('register') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Sign Up</a>
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Sign In</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="pt-32 md:pt-40 pb-24 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1532619187608-e5375cab36c9?auto=format&fit=crop&w=1470&q=80');">
        <div class="container mx-auto px-6 md:px-12 text-center text-white">
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight drop-shadow-lg">Your Study, Your Rules.</h1>
            <p class="mt-4 text-lg md:text-xl max-w-2xl mx-auto drop-shadow-md">
                Track your learning journey, stay consistent, and gamify your grind. Welcome to <strong>GrindlY</strong> — where productivity meets purpose.
            </p>
            <div class="mt-8 space-x-4">
                <a href="{{ route('register') }}" class="bg-indigo-700 hover:bg-indigo-800 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-all duration-200">Get Started</a>
                <a href="{{ route('login') }}" class="bg-white hover:bg-gray-100 text-indigo-700 font-semibold px-6 py-3 rounded-lg shadow-md transition-all duration-200">Sign In</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-gray-100">
        <div class="container mx-auto px-6 md:px-12 text-center">
            <h2 class="text-3xl font-bold text-gray-800">Why GrindlY?</h2>
            <p class="mt-2 text-gray-600 max-w-xl mx-auto">We’re not just another planner — we’re your daily motivator, your guide, and your accountability partner.</p>

            <div class="mt-12 grid gap-10 sm:grid-cols-2 md:grid-cols-3">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-semibold text-indigo-700">Smart Study Tracking</h3>
                    <p class="mt-2 text-gray-600">Automatically log your study sessions, review past efforts, and stay focused.</p>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-semibold text-indigo-700">Gamified Experience</h3>
                    <p class="mt-2 text-gray-600">Earn XP, track streaks, and level up your learning habits.</p>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-semibold text-indigo-700">Intelligent Scheduling</h3>
                    <p class="mt-2 text-gray-600">GrindlY learns your patterns and helps optimize your grind over time.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-indigo-700 text-white text-center">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold">Ready to dominate your learning goals?</h2>
            <p class="mt-4 text-lg">GrindlY is free to start. Jump in and build momentum today.</p>
            <a href="{{ route('register') }}" class="mt-6 inline-block bg-white text-indigo-700 px-8 py-3 rounded-lg font-semibold shadow-lg hover:bg-gray-100 transition">Start Grinding</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-10">
        <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center">
            <p>&copy; {{ date('Y') }} GrindlY. All rights reserved.</p>
            <div class="space-x-4 mt-4 md:mt-0">
                <a href="#" class="hover:text-white">Privacy</a>
                <a href="#" class="hover:text-white">Terms</a>
                <a href="#" class="hover:text-white">Contact</a>
            </div>
        </div>
    </footer>
</body>

</html>
