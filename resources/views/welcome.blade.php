<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mr Crab Shop</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <meta name="theme-color" content="#f3f4f6">
        <!-- Dark Mode Script (Prevent FOUC) -->
        <script>
            (function() {
                try {
                    const stored = localStorage.getItem('darkMode');
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    const isDark = stored === 'true' || (stored === null && prefersDark);
                    
                    const metaThemeColor = document.querySelector('meta[name="theme-color"]');
                    
                    if (isDark) {
                        document.documentElement.classList.add('dark');
                        document.documentElement.style.backgroundColor = '#111827'; // gray-900
                        if (metaThemeColor) metaThemeColor.setAttribute('content', '#111827');
                    } else {
                        document.documentElement.classList.remove('dark');
                        document.documentElement.style.backgroundColor = '#f9fafb'; // gray-50
                        if (metaThemeColor) metaThemeColor.setAttribute('content', '#f9fafb');
                    }
                } catch (e) {}
            })();
        </script>
        <style>
            [x-cloak] { display: none !important; }
            /* Critical CSS to prevent FOUC */
            html.dark body { background-color: #111827 !important; }
            html:not(.dark) body { background-color: #f9fafb !important; }
        </style>

        <!-- Styles -->
        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-gray-50 dark:bg-gray-900" x-data>
        <div class="min-h-screen flex flex-col">
            @include('landing.sections.header')

            <main class="flex-1">
                <div class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                    @if (session('status'))
                        <x-alert :message="session('status')" type="success" />
                    @endif

                    @if (session('error'))
                        <x-alert :message="session('error')" type="error" />
                    @endif

                    @include('landing.sections.hero', [
                        'featuredProducts' => $featuredProducts,
                        'hasMoreProducts' => $hasMoreProducts,
                    ])

                    <section class="mt-20 md:mt-24 grid gap-6 lg:gap-8 lg:grid-cols-2 items-stretch">
                        @include('landing.sections.about')
                        @include('landing.sections.contact')
                    </section>
                </div>
            </main>

            @include('landing.sections.footer')
        </div>
        @include('landing.sections.login-modal')
        <x-toast />
        @livewireScripts
    </body>
</html>
