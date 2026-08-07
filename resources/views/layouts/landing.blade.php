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

        <!-- AI Search Engine Optimization (JSON-LD Schema Markup) -->
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@graph": [
            {
              "@type": "WebSite",
              "name": "Mr Crab Shop",
              "url": "{{ url('/') }}",
              "description": "Toko thrift online terpercaya. Koleksi pakaian secondhand berkualitas, dikurasi manual, difoto apa adanya."
            },
            {
              "@type": "Store",
              "name": "Mr Crab Shop",
              "image": "{{ isset($ogImage) ? $ogImage : url('/images/logo.png') }}",
              "description": "Thrift store online menyediakan pakaian preloved berkualitas.",
              "url": "{{ url('/') }}",
              "priceRange": "$$"
            }
          ]
        }
        </script>

        <meta name="theme-color" content="#f3f4f6">
        <style>[x-cloak] { display: none !important; }</style>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Styles -->
        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/ajax-cart.js'])
    </head>
    <body class="antialiased font-sans bg-gray-50" x-data>
        <div class="min-h-screen flex flex-col">
            @include('landing.sections.header')

            <main class="flex-1 pb-6 lg:pb-0">
                {{ $slot }}
            </main>

            @include('landing.sections.footer')
        </div>
        @include('landing.sections.login-modal')
        <x-toast />
        @livewireScripts
    </body>
</html>



