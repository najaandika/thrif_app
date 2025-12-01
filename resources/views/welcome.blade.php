<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Thrif Dashboard</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <script>
            (function() {
                try {
                    const stored = localStorage.getItem('darkMode');
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    if (stored === 'true' || (stored === null && prefersDark)) {
                        document.documentElement.classList.add('dark');
                    }
                } catch (e) {}
            })();
        </script>
        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            html, body { touch-action: pan-x pan-y; overscroll-behavior: none; overflow-x: hidden; }
        </style>
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
