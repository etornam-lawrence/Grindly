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
    <body class="font-sans text-gray-900 antialiased">
        <nav class="fixed top-0 left-0 w-full z-50 bg-[#232946]/80 backdrop-blur-md shadow-md transition-all duration-300">
            <div class="container mx-auto px-4 py-4 flex justify-between items-center">
                <a href="/" class="flex items-center space-x-2">
                    <img src="{{ asset('storage/images/grindly-logo.png') }}" alt="GrindlY Logo" class="h-10 w-auto md:h-12 transition-transform duration-200 hover:scale-105 rounded-lg shadow" style="max-width: 120px;">
                    <span class="text-3xl font-black tracking-tight text-white leading-tight hidden sm:inline">
                        Grindl<span class="text-indigo-800">Y</span>
                    </span>
                </a>
                <div class="space-x-4">
                    <a href="{{ route('register') }}" class="text-white hover:text-green-400">Sign Up</a>
                    <a href="{{ route('login') }}" class="text-white hover:text-green-400">Sign In</a>
                </div>
            </div>
        </nav>
        <div class="py-35"></div>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            {{-- <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div> --}}

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
