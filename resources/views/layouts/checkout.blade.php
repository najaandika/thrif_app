<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'Checkout - ' . config('app.name') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#f7faf9">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <style>[x-cloak] { display: none !important; }</style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles

        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    </head>
    <body class="bg-[#f7faf9] font-sans antialiased text-slate-950">
        @php
            $shopLogo = \App\Models\Setting::get('shop_logo');
            $shopName = \App\Models\Setting::get('shop_name', 'Mr Crab Shop');
        @endphp

        <header class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/92 backdrop-blur-xl">
            <div class="mx-auto flex h-16 max-w-6xl items-center justify-between gap-3 px-4 sm:px-6 lg:px-8">
                <a href="{{ route('landing.home') }}" class="flex min-w-0 items-center gap-3" aria-label="Kembali ke home">
                    @if($shopLogo)
                        <img src="{{ media_url($shopLogo) }}" alt="{{ $shopName }}" class="h-10 w-10 shrink-0 rounded-2xl object-cover ring-1 ring-slate-200">
                    @else
                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-slate-950 text-sm font-black text-white">M</span>
                    @endif
                    <span class="min-w-0 leading-tight">
                        <span class="block truncate text-sm font-black tracking-tight text-slate-950">{{ $shopName }}</span>
                        <span class="block truncate text-[11px] font-semibold text-slate-500">Checkout aman</span>
                    </span>
                </a>
            </div>
        </header>

        <main>
            {{ $slot }}
        </main>

        @livewireScripts
        @stack('scripts')
    </body>
</html>

