<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GrindlY – Unleash Your Academic Superpowers</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/tailwind.min.css" rel="stylesheet">
    @endif
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(120deg, #232946 0%, #1a1a2e 100%);
            color: #e0e6ed;
        }
        .gradient-text {
            background: linear-gradient(90deg, #2cce93 0%, #6366f1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .glass {
            background: rgba(36, 41, 61, 0.85);
            backdrop-filter: blur(10px);
        }
        .feature-icon {
            width: 52px;
            height: 52px;
            margin-bottom: 1rem;
        }
        .hero-bg {
            background: linear-gradient(120deg, rgba(36,41,61,0.85) 60%, rgba(44,206,147,0.15)), url('{{ asset('storage/images/imageww.webp') }}');
            background-size: cover;
            background-position: center;
        }
        .floating {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0);}
            50% { transform: translateY(-12px);}
        }
        .section-bg {
            background: rgba(36, 41, 61, 0.85);
        }
        .footer-bg {
            background: #181824;
        }
        .footer-link {
            color: #a1a6b4;
        }
        .footer-link:hover {
            color: #34d399;
        }
    </style>
</head>
<body class="bg-[#232946] text-[#e0e6ed] antialiased">

<!-- Navigation -->
<nav class="fixed top-0 left-0 w-full z-50 bg-[#232946]/80 backdrop-blur-md shadow-md transition-all duration-300">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <a href="/" class="flex items-center space-x-2">
            <img src="{{ asset('storage/images/grindly-logo.png') }}" alt="GrindlY Logo" class="h-10 w-auto md:h-12 transition-transform duration-200 hover:scale-105 rounded-lg shadow" style="max-width: 120px;">
            <span class="text-3xl font-black tracking-tight text-white leading-tight hidden sm:inline">
                Grindl<span class="text-indigo-800">Y</span>
            </span>
        </a>
        <div class="space-x-4">
            <a href="#features" class="text-white hover:text-green-400">Features</a>
            <a href="{{ route('register') }}" class="text-white hover:text-green-400">Sign Up</a>
            <a href="{{ route('login') }}" class="text-white hover:text-green-400">Sign In</a>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="relative flex items-center justify-center min-h-[90vh] px-4 py-32 hero-bg overflow-hidden">
    <div class="container mx-auto relative z-10 flex flex-col items-center text-center text-white">
        <div class="flex flex-col items-center space-y-6">
            {{-- <img src="{{ asset('storage/images/grindly-logo.png') }}" alt="GrindlY Logo" class="h-20 w-20 md:h-28 md:w-28 rounded-full shadow-2xl floating mb-2"> --}}
            <h1 class="text-5xl sm:text-6xl md:text-7xl font-extrabold mb-4 leading-tight gradient-text drop-shadow-lg tracking-tight">
                Ace Your Studies with GrindlY
            </h1>
            <h2 class="text-2xl sm:text-3xl md:text-4xl text-green-200 mb-4 font-bold drop-shadow">
                The productivity platform for <span class="font-black text-green-300">ambitious students</span>
            </h2>
            <p class="text-lg sm:text-xl md:text-2xl text-gray-200 max-w-2xl mb-8 font-medium drop-shadow">
                <span class="font-semibold text-white">Master your habits, crush your goals, and join a thriving student community.</span>
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="inline-block bg-gradient-to-r from-green-500 to-indigo-600 hover:from-green-600 hover:to-indigo-700 text-white font-extrabold py-4 px-10 rounded-full shadow-xl transition duration-300 text-lg tracking-wide">
                    Get Started Free
                </a>
                <a href="#features" class="inline-block border-2 border-green-400 text-green-300 font-bold py-4 px-10 rounded-full shadow-lg transition duration-300 hover:bg-green-900 hover:text-white">
                    Explore Features
                </a>
            </div>
        </div>
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-[#232946] opacity-80 pointer-events-none"></div>
</section>

<!-- Animated Divider -->
<div class="w-full flex justify-center">
    <svg height="60" width="100vw" class="w-full" viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill="#232946" fill-opacity="1" d="M0,32L60,37.3C120,43,240,53,360,53.3C480,53,600,43,720,32C840,21,960,11,1080,10.7C1200,11,1320,21,1380,26.7L1440,32L1440,60L1380,60C1320,60,1200,60,1080,60C960,60,840,60,720,60C600,60,480,60,360,60C240,60,120,60,60,60L0,60Z"></path>
    </svg>
</div>

<!-- Problem & Solution -->
<section class="py-16 px-4 md:px-8 bg-[#232946]">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <div class="glass rounded-2xl p-8 shadow-lg flex flex-col justify-center">
                <h2 class="text-3xl md:text-4xl font-bold text-indigo-300 mb-4">The Challenge</h2>
                <p class="text-xl text-muted mb-2">Students are overwhelmed by distractions, lack of motivation, and ineffective study routines. The result? Stress, burnout, and missed potential.</p>
                <ul class="list-disc list-inside text-lg text-muted mt-4 space-y-2">
                    <li>Difficulty staying consistent</li>
                    <li>Procrastination and lack of focus</li>
                    <li>Little accountability or support</li>
                </ul>
            </div>
            <div class="glass rounded-2xl p-8 shadow-lg flex flex-col justify-center">
                <h2 class="text-3xl md:text-4xl font-bold text-green-300 mb-4">The GrindlY Solution</h2>
                <p class="text-xl text-muted mb-2">GrindlY empowers you to build unstoppable habits, set clear goals, and connect with a community that keeps you accountable.</p>
                <ul class="list-disc list-inside text-lg text-muted mt-4 space-y-2">
                    <li>Track habits & goals visually</li>
                    <li>Peer groups for real accountability</li>
                    <li>Celebrate your progress & streaks</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- How it Works -->
<section class="py-20 px-4 md:px-8 bg-gradient-to-r from-indigo-900 via-[#232946] to-green-900">
    <div class="container mx-auto">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-14 gradient-text">How It Works</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Step 1 -->
            <div class="glass rounded-2xl shadow-xl p-8 flex flex-col items-center hover:scale-105 transition-transform duration-300">
                <svg class="feature-icon text-green-400 floating" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 6v6l4 2"></path><circle cx="12" cy="12" r="10"></circle></svg>
                <h3 class="text-xl font-semibold text-green-300 mb-2">Set Your Goals</h3>
                <p class="text-muted text-center">Pick 1–2 big goals for the week. Focus is your superpower.</p>
            </div>
            <!-- Step 2 -->
            <div class="glass rounded-2xl shadow-xl p-8 flex flex-col items-center hover:scale-105 transition-transform duration-300">
                <svg class="feature-icon text-indigo-400 floating" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"></rect><path d="M16 2v4"></path><path d="M8 2v4"></path><path d="M3 10h18"></path></svg>
                <h3 class="text-xl font-semibold text-indigo-300 mb-2">Track Habits Daily</h3>
                <p class="text-muted text-center">Log your progress. Build consistency with daily check-ins.</p>
            </div>
            <!-- Step 3 -->
            <div class="glass rounded-2xl shadow-xl p-8 flex flex-col items-center hover:scale-105 transition-transform duration-300">
                <svg class="feature-icon text-purple-400 floating" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"></circle><path d="M5.5 21a7.5 7.5 0 0 1 13 0"></path></svg>
                <h3 class="text-xl font-semibold text-purple-300 mb-2">Join Peer Groups</h3>
                <p class="text-muted text-center">Find your tribe. Get support and accountability from others.</p>
            </div>
            <!-- Step 4 -->
            <div class="glass rounded-2xl shadow-xl p-8 flex flex-col items-center hover:scale-105 transition-transform duration-300">
                <svg class="feature-icon text-pink-400 floating" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 2v8h8"></path><circle cx="12" cy="12" r="10"></circle></svg>
                <h3 class="text-xl font-semibold text-pink-300 mb-2">Celebrate Streaks</h3>
                <p class="text-muted text-center">Visualize your progress. Stay motivated with streaks & rewards.</p>
            </div>
        </div>
    </div>
</section>

<!-- Core Features -->
<section class="section-bg py-20 px-4 md:px-8" id="features">
    <div class="container mx-auto">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-14 gradient-text">Core Features</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Feature 1 -->
            <div class="glass rounded-2xl shadow-xl p-8 flex flex-col items-center hover:scale-105 transition-transform duration-300">
                <svg class="feature-icon text-green-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3"></path><circle cx="12" cy="12" r="10"></circle></svg>
                <h3 class="text-xl font-semibold text-green-300 mb-2">Goal & Habit Tracking</h3>
                <p class="text-muted text-center">Set goals, track habits, and monitor your daily progress visually.</p>
            </div>
            <!-- Feature 2 -->
            <div class="glass rounded-2xl shadow-xl p-8 flex flex-col items-center hover:scale-105 transition-transform duration-300">
                <svg class="feature-icon text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"></circle><path d="M5.5 21a7.5 7.5 0 0 1 13 0"></path></svg>
                <h3 class="text-xl font-semibold text-indigo-300 mb-2">Social Accountability</h3>
                <p class="text-muted text-center">Connect with peers, share progress, and stay accountable together.</p>
            </div>
            <!-- Feature 3 -->
            <div class="glass rounded-2xl shadow-xl p-8 flex flex-col items-center hover:scale-105 transition-transform duration-300">
                <svg class="feature-icon text-purple-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"></rect><path d="M3 9h18"></path><path d="M9 21V9"></path></svg>
                <h3 class="text-xl font-semibold text-purple-300 mb-2">Progress Visualization</h3>
                <p class="text-muted text-center">Visualize your streaks, track your progress, and stay motivated.</p>
            </div>
            <!-- Feature 4 -->
            <div class="glass rounded-2xl shadow-xl p-8 flex flex-col items-center hover:scale-105 transition-transform duration-300">
                <svg class="feature-icon text-pink-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="2"></rect></svg>
                <h3 class="text-xl font-semibold text-pink-300 mb-2">Distraction-Free Design</h3>
                <p class="text-muted text-center">Focus on what matters with a clean, intuitive, and distraction-free interface.</p>
            </div>
        </div>
    </div>
</section>

<!-- Why GrindlY? -->
<section class="py-20 px-4 md:px-8 bg-gradient-to-r from-green-700 via-indigo-800 to-purple-900">
    <div class="container mx-auto">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-10 gradient-text">Why GrindlY?</h2>
        <div class="max-w-2xl mx-auto glass rounded-2xl p-10 shadow-2xl">
            <ul class="list-disc list-inside text-xl text-muted space-y-4">
                <li>Built for students, by students – we know your struggles.</li>
                <li>Minimal, beautiful, and lightning-fast interface.</li>
                <li>Real accountability through peer groups and shared progress.</li>
                <li>Celebrate wins, learn from setbacks, and never grind alone.</li>
            </ul>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="bg-gradient-to-r from-green-700 via-indigo-800 to-purple-900 py-20 px-4 text-center">
    <div class="container mx-auto">
        <h2 class="text-3xl md:text-4xl font-bold mb-8 text-white">Ready to unlock your potential?</h2>
        <a href="#" class="bg-[#232946] text-green-300 font-bold py-4 px-12 rounded-full shadow-2xl transition duration-300 hover:bg-green-900 hover:text-white text-xl">Join the Beta Waitlist</a>
        <p class="text-muted mt-4">No spam. Early access. Real results.</p>
    </div>
</section>

<!-- Footer -->
<footer class="footer-bg py-10 px-4 text-center text-muted">
    <div class="container mx-auto">
        <p class="mb-4">&copy; 2025 GrindlY. All rights reserved.</p>
        <div class="flex justify-center space-x-8">
            <a href="#" class="footer-link hover:underline">About</a>
            <a href="#" class="footer-link hover:underline">Contact</a>
            <a href="#" class="footer-link hover:underline">Terms</a>
        </div>
    </div>
</footer>

</body>
</html>
