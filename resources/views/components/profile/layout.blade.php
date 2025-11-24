@props(['active' => 'account'])

@php
    $homeUrl = auth()->user()?->homePath() ?? url('/');

    $navItems = [
        ['key' => 'account', 'label' => 'Informasi Akun', 'route' => 'profile'],
        ['key' => 'address', 'label' => 'Alamat', 'route' => 'profile.address'],
    ];

    if (auth()->user()?->isCustomer()) {
        $navItems[] = ['key' => 'history', 'label' => 'Riwayat Pembelian', 'route' => 'profile.history'];
    }

    $navItems[] = ['key' => 'wishlist', 'label' => 'Favorit / Wishlist', 'route' => 'profile.wishlist'];
    $navItems[] = ['key' => 'logout', 'label' => 'Keluar', 'route' => 'profile.logout', 'danger' => true];
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <div class="md:hidden sticky top-0 z-20 -mx-4 mb-3 px-4 py-3 bg-white/95 dark:bg-gray-900/95 backdrop-blur border-b border-gray-200 dark:border-gray-700">
                    <a
                        href="{{ $homeUrl }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/50 transition-all duration-300 hover:shadow-xl hover:shadow-indigo-500/50 hover:scale-105 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-indigo-500 dark:from-indigo-600 dark:to-purple-700"
                    >
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 12H5" />
                            <path d="M12 19l-7-7 7-7" />
                        </svg>
                        Kembali ke halaman utama
                    </a>
                </div>

                <div class="hidden md:block">
                    <a
                        href="{{ $homeUrl }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/50 transition-all duration-300 hover:shadow-xl hover:shadow-indigo-500/50 hover:scale-105 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-indigo-500 dark:from-indigo-600 dark:to-purple-700"
                    >
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 12H5" />
                            <path d="M12 19l-7-7 7-7" />
                        </svg>
                        Kembali ke halaman utama
                    </a>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-[260px_1fr]">
                <aside class="bg-white dark:bg-gray-800 shadow rounded-2xl p-6 h-max">
                    <nav class="space-y-3 text-sm font-semibold text-gray-600 dark:text-gray-300">
                        @foreach ($navItems as $item)
                            @php
                                $isActive = $active === $item['key'];
                                $isDanger = $item['danger'] ?? false;
                            @endphp
                            <a
                                href="{{ route($item['route']) }}"
                                @class([
                                    'block px-3 py-2 rounded-xl transition',
                                    'hover:bg-indigo-50 dark:hover:bg-gray-700/60' => ! $isDanger,
                                    'hover:bg-red-50 dark:hover:bg-red-900/40 text-red-600 dark:text-red-300' => $isDanger && ! $isActive,
                                    'bg-indigo-50 text-indigo-600 dark:bg-gray-700/60 dark:text-white' => $isActive && ! $isDanger,
                                    'bg-red-50 text-red-600 dark:bg-red-900/60 dark:text-red-100' => $isActive && $isDanger,
                                ])
                            >
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                    </nav>
                </aside>

                <div class="space-y-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
