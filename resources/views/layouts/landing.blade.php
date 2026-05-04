<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="google-site-verification" content="O2SB5f86omCMI4ga40t9GFKcbyIrksri6XEHdxy5adk" />
        <title>{{ $title ?? 'Mr Crab Shop - Thrift Store Terpercaya' }}</title>
        <meta name="description" content="{{ $metaDescription ?? 'Mr Crab Shop - Toko thrift online terpercaya. Koleksi pakaian secondhand berkualitas, dikurasi manual, difoto apa adanya. Pengiriman cepat ke seluruh Indonesia.' }}">
        <link rel="canonical" href="{{ url()->current() }}">

        <!-- Open Graph -->
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ $title ?? 'Mr Crab Shop - Thrift Store Terpercaya' }}">
        <meta property="og:description" content="{{ $metaDescription ?? 'Toko thrift online terpercaya. Koleksi pakaian secondhand berkualitas, dikurasi manual, difoto apa adanya.' }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="Mr Crab Shop">
        @if(isset($ogImage))
        <meta property="og:image" content="{{ $ogImage }}">
        @endif

        <!-- Fonts: self-hosted via app.css @font-face -->

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
                        document.documentElement.style.backgroundColor = '#111827';
                        if (metaThemeColor) metaThemeColor.setAttribute('content', '#111827');
                    } else {
                        document.documentElement.classList.remove('dark');
                        document.documentElement.style.backgroundColor = '#f9fafb';
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

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Styles -->
        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/ajax-cart.js'])
    </head>
    <body class="antialiased font-sans bg-gray-50 dark:bg-gray-900" x-data>
        <div class="min-h-screen flex flex-col">
            @include('landing.sections.header')

            <main class="flex-1">
                {{ $slot }}
            </main>

            @include('landing.sections.footer')
        </div>
        @include('landing.sections.login-modal')
        <x-toast />
        @livewireScripts
    </body>
</html>
