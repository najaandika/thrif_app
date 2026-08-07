<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Order - {{ config('app.name', 'Mr Crab Shop') }}</title>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" defer></script>
</head>
<body class="bg-[#f7faf9] font-sans antialiased text-slate-950" x-data>
    @php
        $statusTone = [
            'pending' => 'border-amber-200 bg-amber-50 text-amber-700',
            'paid' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
            'completed' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
            'cancelled' => 'border-red-200 bg-red-50 text-red-700',
            'failed' => 'border-red-200 bg-red-50 text-red-700',
            'shipped' => 'border-blue-200 bg-blue-50 text-blue-700',
        ];
    @endphp

    <div class="min-h-screen pb-8 lg:pb-12">
        <header class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/90 backdrop-blur-xl">
            <div class="mx-auto flex h-16 max-w-6xl items-center justify-between gap-3 px-4 sm:px-6 lg:px-8">
                <a href="{{ route('landing.products.index') }}" class="inline-flex h-10 items-center gap-2 rounded-2xl border border-slate-200 bg-white px-3 text-sm font-bold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:text-slate-950" aria-label="Kembali ke katalog">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Katalog
                </a>

                <div class="text-right leading-tight">
                    <p class="text-sm font-extrabold tracking-tight text-slate-950">Mr Crab Shop</p>
                    <p class="text-[11px] font-semibold text-slate-500">Riwayat order</p>
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-6xl px-4 pt-5 sm:px-6 lg:px-8 lg:pt-10">
            <section class="mb-6 grid gap-4 lg:mb-8 lg:grid-cols-[minmax(0,1fr)_360px] lg:items-end">
                <div>
                    <p class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1.5 text-[11px] font-bold uppercase tracking-[0.16em] text-slate-500 shadow-sm">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        Order history
                    </p>
                    <h1 class="mt-4 max-w-2xl text-3xl font-extrabold leading-[1.03] tracking-[-0.045em] text-slate-950 sm:text-5xl">
                        Riwayat belanja kamu.
                    </h1>
                    <p class="mt-3 max-w-xl text-sm font-medium leading-7 text-slate-600">
                        Cek status order, total pembayaran, detail item, dan struk pembelian dalam satu tempat.
                    </p>
                </div>

                <div class="rounded-[1.5rem] border border-slate-200 bg-white p-4 shadow-[0_18px_50px_rgba(15,23,42,0.05)]">
                    <div class="grid grid-cols-3 divide-x divide-slate-100 text-center">
                        <div class="px-2">
                            <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-slate-400">Order</p>
                            <p class="mt-1 text-lg font-extrabold text-slate-950">{{ $orders->count() }}</p>
                        </div>
                        <div class="px-2">
                            <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-slate-400">Pending</p>
                            <p class="mt-1 text-lg font-extrabold text-amber-600">{{ $orders->where('status', 'pending')->count() }}</p>
                        </div>
                        <div class="px-2">
                            <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-slate-400">Selesai</p>
                            <p class="mt-1 text-lg font-extrabold text-emerald-700">{{ $orders->whereIn('status', ['paid', 'completed'])->count() }}</p>
                        </div>
                    </div>
                </div>
            </section>

            @if(session('status'))
                <div class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700 shadow-sm" role="status">
                    {{ session('status') }}
                </div>
            @endif

            @forelse ($orders as $order)
                @php
                    $firstItem = $order->items->first();
                    $itemCount = $order->items->sum('quantity');
                    $totalOriginalPrice = $order->items->sum(function ($item) {
                        return (float) ($item->product->price ?? $item->price) * $item->quantity;
                    });
                    $hasSavings = $totalOriginalPrice > (float) $order->total_price;
                    $paymentLabel = $order->payment_method === 'cash'
                        ? ($order->shipping_address === 'AMBIL DI TOKO' ? 'Bayar di toko' : 'COD')
                        : 'Midtrans';
                    $deliveryLabel = $order->shipping_address === 'AMBIL DI TOKO' ? 'Ambil toko' : 'Antar';
                    $badgeClass = $statusTone[$order->status] ?? 'border-slate-200 bg-slate-100 text-slate-700';
                @endphp

                <article class="mb-4 overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-[0_18px_60px_rgba(15,23,42,0.06)]">
                    <div class="grid gap-0 lg:grid-cols-[minmax(0,1fr)_320px]">
                        <div class="p-5 sm:p-6">
                            <div class="flex flex-wrap items-start justify-between gap-3">
                                <div>
                                    <p class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-[11px] font-extrabold tracking-[0.08em] text-slate-500">
                                        {{ $order->invoice_number }}
                                    </p>
                                    <h2 class="mt-3 text-xl font-extrabold leading-tight tracking-[-0.03em] text-slate-950 sm:text-2xl">
                                        {{ $firstItem?->product?->name ?? 'Produk terhapus' }}
                                    </h2>
                                </div>

                                <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-extrabold {{ $badgeClass }}">
                                    {{ $order->status_label }}
                                </span>
                            </div>

                            <div class="mt-4 flex flex-wrap gap-2">
                                <span class="rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-bold text-slate-600">{{ $itemCount }} item</span>
                                <span class="rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-bold text-slate-600">{{ $deliveryLabel }}</span>
                                <span class="rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-bold text-slate-600">{{ $paymentLabel }}</span>
                            </div>

                            <div class="mt-5 grid gap-3 sm:grid-cols-3">
                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                    <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Tanggal</p>
                                    <p class="mt-1 text-sm font-bold text-slate-950">{{ $order->created_at->translatedFormat('d M Y') }}</p>
                                    <p class="text-xs font-semibold text-slate-500">{{ $order->created_at->format('H:i') }}</p>
                                </div>
                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                    <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Penerima</p>
                                    <p class="mt-1 truncate text-sm font-bold text-slate-950">{{ $order->buyer_name }}</p>
                                    <p class="truncate text-xs font-semibold text-slate-500">{{ $order->buyer_contact ?? '-' }}</p>
                                </div>
                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                    <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Total</p>
                                    <p class="mt-1 text-lg font-extrabold text-slate-950">{{ rupiah($order->total_price) }}</p>
                                    @if($hasSavings)
                                        <p class="text-xs font-bold text-red-500">Hemat {{ rupiah($totalOriginalPrice - $order->total_price) }}</p>
                                    @endif
                                </div>
                            </div>

                            @if($order->items->count() > 1)
                                <div class="mt-4 rounded-2xl border border-slate-200 bg-white p-4">
                                    <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Item lain</p>
                                    <div class="mt-2 space-y-2">
                                        @foreach($order->items->skip(1)->take(3) as $item)
                                            <div class="flex items-center justify-between gap-3 text-sm">
                                                <span class="truncate font-bold text-slate-800">{{ $item->product->name ?? 'Produk terhapus' }}</span>
                                                <span class="shrink-0 font-semibold text-slate-500">x{{ $item->quantity }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <aside class="border-t border-slate-100 bg-slate-50/80 p-5 sm:p-6 lg:border-l lg:border-t-0">
                            <p class="text-[10px] font-extrabold uppercase tracking-[0.16em] text-slate-400">Detail order</p>

                            <div class="mt-4 space-y-4">
                                <div>
                                    <p class="text-xs font-bold text-slate-400">Alamat</p>
                                    @if($order->shipping_address === 'AMBIL DI TOKO')
                                        <p class="mt-1 text-sm font-bold leading-6 text-slate-950">Ambil di toko</p>
                                        <p class="text-xs font-semibold leading-5 text-slate-500">{{ \App\Models\Setting::get('shop_address') ?? 'Alamat toko' }}</p>
                                    @else
                                        <p class="mt-1 text-sm font-semibold leading-6 text-slate-700">{{ $order->shipping_address ?? 'Belum diisi' }}</p>
                                    @endif
                                </div>

                                @if ($order->notes)
                                    <div>
                                        <p class="text-xs font-bold text-slate-400">Catatan</p>
                                        <p class="mt-1 text-sm font-semibold leading-6 text-slate-700">{{ $order->notes }}</p>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-5 grid gap-2">
                                @if($order->status !== 'pending')
                                    <button
                                        type="button"
                                        x-on:click="Livewire.dispatch('open-receipt-modal', { orderId: {{ $order->id }} })"
                                        class="inline-flex min-h-11 items-center justify-center gap-2 rounded-2xl bg-slate-950 px-4 py-3 text-sm font-extrabold text-white shadow-lg shadow-slate-950/15 transition hover:-translate-y-0.5 hover:bg-slate-800"
                                    >
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Lihat struk
                                    </button>
                                @else
                                    <a href="{{ route('landing.cart.index') }}" class="inline-flex min-h-11 items-center justify-center rounded-2xl bg-slate-950 px-4 py-3 text-sm font-extrabold text-white shadow-lg shadow-slate-950/15 transition hover:-translate-y-0.5 hover:bg-slate-800">
                                        Lanjut bayar
                                    </a>
                                @endif

                                <a href="{{ route('landing.products.index') }}" class="inline-flex min-h-11 items-center justify-center rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-extrabold text-slate-700 transition hover:bg-slate-50 hover:text-slate-950">
                                    Belanja lagi
                                </a>
                            </div>
                        </aside>
                    </div>
                </article>
            @empty
                <section class="rounded-[2rem] border border-slate-200 bg-white p-7 text-center shadow-[0_18px_60px_rgba(15,23,42,0.06)] sm:p-10">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-3xl border border-slate-200 bg-slate-50 text-slate-400 shadow-sm">
                        <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M6 2h12l1 20-7-3-7 3L6 2z" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9 7h6M9 11h6" stroke-linecap="round" />
                        </svg>
                    </div>
                    <h2 class="mt-5 text-2xl font-extrabold tracking-[-0.03em] text-slate-950">Belum ada order.</h2>
                    <p class="mx-auto mt-3 max-w-sm text-sm font-medium leading-7 text-slate-600">Pilih item thrift yang kondisinya cocok dulu. Setelah checkout, status order akan tampil di sini.</p>
                    <a href="{{ route('landing.products.index') }}" class="mt-6 inline-flex min-h-12 items-center justify-center rounded-2xl bg-slate-950 px-6 py-3 text-sm font-extrabold text-white shadow-xl shadow-slate-950/15 transition hover:-translate-y-0.5 hover:bg-slate-800">
                        Buka katalog
                    </a>
                </section>
            @endforelse
        </main>
    </div>

    <x-toast />

    @if(session('status'))
        <div data-checkout-status="{{ session('status') }}" data-checkout-redirect="{{ route('landing.orders.history') }}" class="hidden"></div>
    @endif

    @livewire('orders.customer-receipt-modal')
    @livewireScripts
</body>
</html>