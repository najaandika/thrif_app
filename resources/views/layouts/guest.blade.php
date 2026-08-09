<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Mr Crab Shop') }}</title>
        <meta name="theme-color" content="#f7faf9">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="bg-[#f7faf9] font-sans antialiased text-slate-950">
        @php
            $authShopLogo = \App\Models\Setting::get('shop_logo');
            $authShopName = \App\Models\Setting::get('shop_name', 'Mr Crab Shop');
        @endphp
        <main class="min-h-screen overflow-hidden px-4 py-5 sm:px-6 lg:px-8">
            <div class="mx-auto grid min-h-[calc(100vh-2.5rem)] w-full max-w-5xl items-center gap-8 lg:grid-cols-[minmax(0,0.95fr)_1px_minmax(380px,0.72fr)] lg:gap-10">
                <section class="hidden self-center lg:block">
                    <a href="{{ url('/') }}" class="auth-brand-pill">
                        @if($authShopLogo)
                            <img src="{{ media_url($authShopLogo) }}" alt="{{ $authShopName }}" class="auth-brand-logo">
                        @else
                            <span class="auth-brand-logo auth-brand-fallback">MC</span>
                        @endif
                        <span class="leading-tight">
                            <span class="block text-sm font-extrabold tracking-tight text-slate-950">{{ $authShopName }}</span>
                            <span class="block text-xs font-semibold text-slate-500">Akun belanja thrift</span>
                        </span>
                    </a>

                    <div class="mt-12 max-w-lg">
                        <p class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1.5 text-[11px] font-bold uppercase tracking-[0.16em] text-slate-500 shadow-sm">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                            Checkout lebih rapi
                        </p>
                        <h1 class="mt-5 text-5xl font-extrabold leading-[0.98] tracking-[-0.055em] text-slate-950">
                            Akun thrift yang jelas dari awal.
                        </h1>
                        <p class="mt-5 max-w-md text-base font-medium leading-8 text-slate-600">
                            Simpan alamat, lanjutkan checkout, dan pantau pesanan tanpa mengulang detail setiap kali order.
                        </p>
                    </div>

                    <div class="mt-10 grid max-w-lg grid-cols-3 divide-x divide-slate-100 border-y border-slate-200 py-5 text-center">
                        <div class="px-3">
                            <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Order</p>
                            <p class="mt-1 text-lg font-extrabold text-slate-950">Cepat</p>
                        </div>
                        <div class="px-3">
                            <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Alamat</p>
                            <p class="mt-1 text-lg font-extrabold text-emerald-700">Tersimpan</p>
                        </div>
                        <div class="px-3">
                            <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Riwayat</p>
                            <p class="mt-1 text-lg font-extrabold text-slate-950">Jelas</p>
                        </div>
                    </div>
                </section>

                <div class="auth-split-divider" aria-hidden="true"></div>

                <section class="mx-auto w-full max-w-[430px] lg:mx-0">
                    <div class="mb-7 flex items-center justify-between lg:hidden">
                        <a href="{{ url('/') }}" class="inline-flex items-center gap-3">
                            @if($authShopLogo)
                                <img src="{{ media_url($authShopLogo) }}" alt="{{ $authShopName }}" class="h-12 w-12 rounded-full object-cover ring-1 ring-slate-200">
                            @else
                                <span class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-950 text-xs font-black text-white ring-1 ring-slate-200">MC</span>
                            @endif
                            <span class="leading-tight">
                                <span class="block text-base font-extrabold tracking-tight text-slate-950">{{ $authShopName }}</span>
                                <span class="block text-xs font-semibold text-slate-500">Akun belanja aman</span>
                            </span>
                        </a>
                    </div>

                    {{ $slot }}
                </section>
            </div>
        </main>

        @livewireScripts
    </body>
</html>
