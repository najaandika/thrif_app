<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        <style>
            html, body { touch-action: pan-x pan-y; overscroll-behavior: none; overflow-x: hidden; }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 relative overflow-hidden">
            <!-- Decorative background elements -->
            <div class="absolute inset-0 pointer-events-none overflow-hidden">
                <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-indigo-400/20 to-purple-400/20 rounded-full blur-3xl transform translate-x-1/3 -translate-y-1/3"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-br from-purple-400/20 to-pink-400/20 rounded-full blur-3xl transform -translate-x-1/3 translate-y-1/3"></div>
            </div>

            <div class="relative z-10 mb-8">
                <a href="/" wire:navigate class="flex items-center gap-3 group focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-indigo-500 rounded-2xl">
                    <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-indigo-600 to-purple-600 text-white font-bold flex items-center justify-center shadow-xl shadow-indigo-500/50 transition-transform group-hover:scale-110">
                        <span class="text-xl">MC</span>
                    </div>
                    <div>
                        <div class="text-lg font-bold text-gray-900 dark:text-gray-100">Mr. Crab Shopp</div>
                        <div class="text-xs text-gray-600 dark:text-gray-400">Thrifting curated drops</div>
                    </div>
                </a>
            </div>

            <div class="relative z-10 w-full sm:max-w-md px-4 sm:px-5 py-6 bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl shadow-2xl overflow-hidden sm:rounded-3xl border border-gray-200 dark:border-gray-700">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <div class="relative z-10 mt-5 text-center space-y-1.5">
                <p class="text-xs text-gray-600 dark:text-gray-400">
                    &copy; {{ date('Y') }} Mr. Crab Shopp. All rights reserved.
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-500">
                    Powered by <span class="font-medium">Laravel</span> & <span class="font-medium">PHP</span>
                </p>
            </div>
        </div>
        @livewireScripts
        <script>
        if (localStorage.getItem('darkMode') === 'true') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        </script>
    </body>
</html>
