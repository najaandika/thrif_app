@props(['mobile' => false, 'pendingOrdersCount' => 0, 'readyProductsCount' => 0])

@php
    $itemBase = $mobile
        ? 'group relative flex min-h-12 items-center gap-2.5 rounded-2xl px-3 py-2.5 text-[13px] font-extrabold transition-all duration-200'
        : 'group relative flex h-11 items-center gap-3 rounded-2xl px-3 text-sm font-bold transition-all duration-200';
    $activeClasses = 'bg-slate-950 text-white shadow-sm';
    $inactiveClasses = 'text-slate-600 hover:bg-slate-100 hover:text-slate-950';
    $iconBase = 'h-4 w-4 shrink-0';

    $sections = [
        [
            'label' => 'Operasional',
            'items' => [
                [
                    'label' => 'Dashboard',
                    'route' => 'dashboard',
                    'active' => request()->routeIs('dashboard') || request()->is('dashboard'),
                    'icon' => 'dashboard',
                ],
                [
                    'label' => 'POS',
                    'route' => 'pos.index',
                    'active' => request()->routeIs('pos.*'),
                    'icon' => 'cart',
                ],
                [
                    'label' => 'Pesanan',
                    'route' => 'orders.index',
                    'active' => request()->routeIs('orders.*'),
                    'icon' => 'orders',
                    'badge' => $pendingOrdersCount,
                ],
            ],
        ],
        [
            'label' => 'Katalog',
            'items' => [
                [
                    'label' => 'Produk',
                    'route' => 'products.index',
                    'active' => request()->routeIs('products.*'),
                    'icon' => 'box',
                ],
                [
                    'label' => 'Kategori',
                    'route' => 'categories.index',
                    'active' => request()->routeIs('categories.*'),
                    'icon' => 'tag',
                ],
                [
                    'label' => 'Promo',
                    'route' => 'promotions.index',
                    'active' => request()->routeIs('promotions.*'),
                    'icon' => 'percent',
                ],
            ],
        ],
        [
            'label' => 'Insight',
            'items' => [
                [
                    'label' => 'Customer',
                    'route' => 'customers.index',
                    'active' => request()->routeIs('customers.*'),
                    'icon' => 'users',
                ],
                [
                    'label' => 'Laporan',
                    'route' => 'reports.index',
                    'active' => request()->routeIs('reports.*'),
                    'icon' => 'chart',
                ],
                [
                    'label' => 'Pembayaran',
                    'route' => 'transactions.index',
                    'active' => request()->routeIs('transactions.*'),
                    'icon' => 'wallet',
                ],
            ],
        ],
        [
            'label' => 'Sistem',
            'items' => [
                [
                    'label' => 'Pengaturan',
                    'route' => 'settings.index',
                    'active' => request()->routeIs('settings.*'),
                    'icon' => 'settings',
                ],
            ],
        ],
    ];
@endphp

<div class="{{ $mobile ? 'px-2 py-3' : '' }}">
    @if($mobile)
        <div class="w-full rounded-3xl border border-slate-200 bg-white p-3 shadow-sm">
    @endif

    <div class="{{ $mobile ? 'space-y-3.5' : 'space-y-5' }}">
        @foreach($sections as $section)
            <div>
                <p
                    class="{{ $mobile ? 'mb-1.5 px-3 text-[10px] tracking-[0.16em]' : 'mb-2 px-3 text-[10px] tracking-[0.18em] transition-all duration-200' }} font-extrabold uppercase text-slate-400"
                    @unless($mobile)
                        x-bind:class="collapsed ? 'sr-only' : ''"
                    @endunless
                >
                    {{ $section['label'] }}
                </p>

                <nav class="{{ $mobile ? 'grid grid-cols-2 gap-2' : 'space-y-1' }}" @unless($mobile) x-bind:class="collapsed ? 'flex flex-col items-center gap-1.5 space-y-0' : ''" @endunless>
                    @foreach($section['items'] as $item)
                        <a
                            href="{{ route($item['route']) }}"
                            @if($mobile) @click="$dispatch('close-drawer')" @endif
                            @unless($mobile)
                                x-bind:title="collapsed ? '{{ $item['label'] }}' : null"
                                x-bind:class="collapsed ? 'h-11 w-11 justify-center gap-0 rounded-2xl px-0' : ''"
                            @endunless
                            class="{{ $itemBase }} {{ $item['active'] ? $activeClasses : $inactiveClasses }}"
                        >
                            @if($item['active'])
                                <span
                                    class="absolute inset-y-2 left-0 w-1 rounded-r-full bg-white/80"
                                    @unless($mobile)
                                        x-bind:class="collapsed ? 'hidden' : ''"
                                    @endunless
                                ></span>
                            @endif

                            @switch($item['icon'])
                                @case('dashboard')
                                    <svg class="{{ $iconBase }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 13h6V4H4v9Zm0 7h6v-4H4v4Zm10 0h6v-9h-6v9Zm0-16v4h6V4h-6Z" />
                                    </svg>
                                    @break

                                @case('cart')
                                    <svg class="{{ $iconBase }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <circle cx="9" cy="21" r="1" />
                                        <circle cx="20" cy="21" r="1" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h4l2.7 13.4A2 2 0 009.6 16h9.8a2 2 0 002-1.6L23 6H6" />
                                    </svg>
                                    @break

                                @case('orders')
                                    <svg class="{{ $iconBase }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 3h10a2 2 0 012 2v16l-3-2-2 2-2-2-2 2-2-2-3 2V5a2 2 0 012-2Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8h6M9 12h6M9 16h3" />
                                    </svg>
                                    @break

                                @case('box')
                                    <svg class="{{ $iconBase }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7 12 3 4 7m16 0-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    @break

                                @case('tag')
                                    <svg class="{{ $iconBase }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.5 0 1 .2 1.4.6l7 7a2 2 0 010 2.8l-7 7a2 2 0 01-2.8 0l-7-7A2 2 0 013 12V7a4 4 0 014-4Z" />
                                    </svg>
                                    @break

                                @case('percent')
                                    <svg class="{{ $iconBase }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 5 5 19M7.5 8.5a2 2 0 100-4 2 2 0 000 4ZM16.5 19.5a2 2 0 100-4 2 2 0 000 4Z" />
                                    </svg>
                                    @break

                                @case('users')
                                    <svg class="{{ $iconBase }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11a4 4 0 10-8 0 4 4 0 008 0ZM4 21a8 8 0 0116 0M20 8v6M23 11h-6" />
                                    </svg>
                                    @break

                                @case('chart')
                                    <svg class="{{ $iconBase }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 19V5M4 19h16M8 16v-5M12 16V8M16 16v-3" />
                                    </svg>
                                    @break

                                @case('wallet')
                                    <svg class="{{ $iconBase }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V9a2 2 0 012-2Zm14 5h2M6 7V5a2 2 0 012-2h8a2 2 0 012 2v2" />
                                    </svg>
                                    @break

                                @default
                                    <svg class="{{ $iconBase }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.3 4.3c.4-1.7 2.9-1.7 3.4 0a1.7 1.7 0 002.5 1.1c1.5-.9 3.3.8 2.4 2.4a1.7 1.7 0 001.1 2.5c1.7.4 1.7 2.9 0 3.4a1.7 1.7 0 00-1.1 2.5c.9 1.5-.8 3.3-2.4 2.4a1.7 1.7 0 00-2.5 1.1c-.4 1.7-2.9 1.7-3.4 0a1.7 1.7 0 00-2.5-1.1c-1.5.9-3.3-.8-2.4-2.4a1.7 1.7 0 00-1.1-2.5c-1.7-.4-1.7-2.9 0-3.4a1.7 1.7 0 001.1-2.5c-.9-1.5.8-3.3 2.4-2.4 1 .6 2.3.1 2.5-1.1Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0Z" />
                                    </svg>
                            @endswitch

                            <span
                                class="min-w-0 flex-1 transition-all duration-200"
                                @unless($mobile)
                                    x-bind:class="collapsed ? 'sr-only' : ''"
                                @endunless
                            >
                                {{ $item['label'] }}
                            </span>

                            @if(($item['badge'] ?? 0) > 0)
                                <span
                                    class="inline-flex min-w-5 items-center justify-center rounded-full bg-red-500 px-1.5 py-0.5 text-[11px] font-extrabold text-white"
                                    @unless($mobile)
                                        x-bind:class="collapsed ? 'absolute right-1.5 top-1.5 h-2.5 min-w-0 w-2.5 overflow-hidden p-0 text-[0px]' : ''"
                                    @endunless
                                >
                                    {{ $item['badge'] }}
                                </span>
                            @endif
                        </a>
                    @endforeach
                </nav>
            </div>
        @endforeach

        @unless($mobile)
            <div
                class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 p-3 transition-all duration-200"
                x-bind:class="collapsed ? 'mx-auto flex h-11 w-11 items-center justify-center rounded-2xl bg-white p-0 shadow-sm' : ''"
            >
                <div class="flex items-center gap-2 text-[10px] font-extrabold uppercase tracking-[0.18em] text-slate-400">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    <span x-bind:class="collapsed ? 'sr-only' : ''">Status toko</span>
                </div>
                <div
                    class="mt-3 grid grid-cols-2 gap-2"
                    x-bind:class="collapsed ? 'hidden' : ''"
                >
                    <div class="rounded-xl bg-white p-3 ring-1 ring-slate-200">
                        <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400" x-bind:class="collapsed ? 'sr-only' : ''">Ready</p>
                        <p class="mt-1 text-lg font-extrabold text-slate-950">{{ $readyProductsCount }}</p>
                    </div>
                    <div class="rounded-xl bg-white p-3 ring-1 ring-slate-200">
                        <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400" x-bind:class="collapsed ? 'sr-only' : ''">Pending</p>
                        <p class="mt-1 text-lg font-extrabold text-slate-950">{{ $pendingOrdersCount }}</p>
                    </div>
                </div>
            </div>
        @endunless
    </div>

    @if($mobile)
        </div>
    @endif
</div>
