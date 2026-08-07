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
        <main class="min-h-screen overflow-hidden px-4 py-6 sm:px-6 lg:px-8">
            <div class="mx-auto grid min-h-[calc(100vh-3rem)] w-full max-w-5xl items-center gap-8 lg:grid-cols-[minmax(0,0.95fr)_minmax(360px,0.75fr)]">
                <section class="hidden lg:block">
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-3 rounded-[1.25rem] border border-slate-200 bg-white/85 px-4 py-3 shadow-sm transition hover:bg-white">
                        <img src="{{ asset('images/logo.png') }}" alt="Mr Crab Shop" class="h-11 w-11 rounded-2xl object-contain ring-1 ring-slate-200">
                        <span class="leading-tight">
                            <span class="block text-sm font-extrabold tracking-tight text-slate-950">Mr Crab Shop</span>
                            <span class="block text-xs font-semibold text-slate-500">Curated preloved goods</span>
                        </span>
                    </a>

                    <div class="mt-14 max-w-xl">
                        <p class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1.5 text-[11px] font-bold uppercase tracking-[0.16em] text-slate-500 shadow-sm">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                            Secure account
                        </p>
                        <h1 class="mt-5 text-6xl font-black leading-[0.96] tracking-[-0.06em] text-slate-950">
                            Belanja thrift dengan akun yang rapi.
                        </h1>
                        <p class="mt-5 max-w-md text-base font-medium leading-8 text-slate-600">
                            Simpan alamat, pantau order, dan checkout lebih cepat tanpa kehilangan detail item yang kamu pilih.
                        </p>
                    </div>

                    <div class="mt-10 grid max-w-xl grid-cols-3 divide-x divide-slate-100 rounded-[1.5rem] border border-slate-200 bg-white p-4 text-center shadow-[0_18px_60px_rgba(15,23,42,0.06)]">
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

                <section class="mx-auto w-full max-w-md">
                    <div class="mb-5 flex items-center justify-between lg:hidden">
                        <a href="{{ url('/') }}" class="inline-flex items-center gap-3">
                            <img src="{{ asset('images/logo.png') }}" alt="Mr Crab Shop" class="h-12 w-12 rounded-2xl object-contain ring-1 ring-slate-200">
                            <span class="leading-tight">
                                <span class="block text-base font-extrabold tracking-tight text-slate-950">Mr Crab Shop</span>
                                <span class="block text-xs font-semibold text-slate-500">Curated preloved goods</span>
                            </span>
                        </a>
                    </div>

                    <div class="rounded-[2rem] border border-slate-200 bg-white p-5 shadow-[0_24px_80px_rgba(15,23,42,0.08)] sm:p-7">
                        {{ $slot }}
                    </div>
                </section>
            </div>
        </main>

        @livewireScripts
    </body>
</html>