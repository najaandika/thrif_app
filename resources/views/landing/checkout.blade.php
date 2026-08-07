<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout Produk - {{ $shopName }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="midtrans-snap-token" content="{{ $snapToken }}">
    <meta name="midtrans-client-key" content="{{ config('services.midtrans.client_key') }}">
    <meta name="theme-color" content="#f7faf9">
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/css/landing.css', 'resources/js/app.js', 'resources/js/landing-checkout.js'])
</head>
<body class="bg-[#f7faf9] font-sans antialiased text-slate-950">
    <div class="min-h-screen pb-8 lg:pb-10">
        <header class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/92 backdrop-blur-xl">
            <div class="mx-auto flex h-16 max-w-6xl items-center justify-between gap-3 px-4 sm:px-6 lg:px-8">
                <a href="{{ $backUrl }}" class="inline-flex h-10 items-center gap-2 rounded-2xl border border-slate-200 bg-white px-3 text-sm font-bold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:text-slate-950" aria-label="Kembali ke {{ $backLabel }}">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    {{ $backLabel }}
                </a>

                <div class="text-right leading-tight">
                    <p class="text-sm font-extrabold tracking-tight text-slate-950">{{ $shopName }}</p>
                    <p class="text-[11px] font-semibold text-slate-500">Checkout aman</p>
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-6xl px-4 pt-5 sm:px-6 lg:px-8 lg:pt-10">
            @if ($errors->order->any())
                <div x-data x-init="setTimeout(() => $el.remove(), 5000)" class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700 shadow-sm" role="alert">
                    {{ $errors->order->first() }}
                </div>
            @endif

            <section class="mb-5 grid gap-4 lg:mb-7 lg:grid-cols-[minmax(0,1fr)_360px] lg:items-end">
                <div>
                    <p class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1.5 text-[11px] font-bold uppercase tracking-[0.16em] text-slate-500 shadow-sm">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        Checkout
                    </p>
                    <h1 class="mt-4 max-w-2xl text-3xl font-extrabold leading-[1.02] tracking-[-0.05em] text-slate-950 sm:text-5xl">Checkout item thrift ini.</h1>
                    <p class="mt-3 max-w-xl text-sm font-medium leading-7 text-slate-600">Pilih metode order, isi kontak, lalu konfirmasi. Stok item satuan akan diamankan setelah pembayaran atau COD disetujui admin.</p>
                </div>

                <div class="rounded-[1.5rem] border border-slate-200 bg-white p-4 shadow-[0_18px_50px_rgba(15,23,42,0.05)]">
                    <div class="grid grid-cols-3 divide-x divide-slate-100 text-center">
                        <div class="px-2">
                            <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-slate-400">Item</p>
                            <p class="mt-1 text-lg font-extrabold text-slate-950">1</p>
                        </div>
                        <div class="px-2">
                            <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-slate-400">Stok</p>
                            <p class="mt-1 text-lg font-extrabold text-emerald-700">Ready</p>
                        </div>
                        <div class="px-2">
                            <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-slate-400">Bayar</p>
                            <p class="mt-1 text-lg font-extrabold text-slate-950">Aman</p>
                        </div>
                    </div>
                </div>
            </section>

            <div class="grid gap-6 lg:grid-cols-[minmax(0,0.9fr)_minmax(430px,1.1fr)] lg:items-start">
                @include('landing.sections.checkout.product-info', ['product' => $product, 'labelClass' => $labelClass])

                <section class="rounded-[2rem] border border-slate-200 bg-white p-5 shadow-[0_18px_60px_rgba(15,23,42,0.06)] sm:p-6">
                    <form method="POST" action="{{ route('landing.products.order', $product) }}" class="space-y-5" id="checkout-form"
                          x-data='checkoutFormData(@json($prefill))'>
                        @csrf

                        <div class="grid grid-cols-4 gap-1 rounded-[1.25rem] border border-slate-200 bg-slate-50 p-1 text-center text-[10px] font-extrabold uppercase tracking-[0.12em] text-slate-400">
                            <span class="rounded-2xl bg-slate-950 px-2 py-2 text-white">Item</span>
                            <span class="px-2 py-2">Data</span>
                            <span class="px-2 py-2">Kirim</span>
                            <span class="px-2 py-2">Bayar</span>
                        </div>

                        <section class="space-y-3">
                            <div class="flex items-center gap-3">
                                <span class="flex h-7 w-7 items-center justify-center rounded-xl bg-slate-950 text-xs font-bold text-white">01</span>
                                <div>
                                    <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-slate-400">Metode</p>
                                    <h2 class="text-lg font-extrabold tracking-tight text-slate-950">Pilih cara order.</h2>
                                </div>
                            </div>

                            <div class="grid gap-3 sm:grid-cols-2">
                                <label class="cursor-pointer">
                                    <input type="radio" name="delivery_type" value="shipping" x-model="deliveryMethod" class="peer sr-only">
                                    <span class="block rounded-2xl border border-slate-200 bg-white p-4 transition peer-checked:border-slate-950 peer-checked:bg-slate-50 peer-focus-visible:ring-4 peer-focus-visible:ring-slate-950/10">
                                        <span class="block text-sm font-bold text-slate-950">Pesan antar</span>
                                        <span class="mt-1 block text-xs font-medium leading-5 text-slate-500">Kurir toko atau ekspedisi.</span>
                                    </span>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="delivery_type" value="pickup" x-model="deliveryMethod" class="peer sr-only">
                                    <span class="block rounded-2xl border border-slate-200 bg-white p-4 transition peer-checked:border-slate-950 peer-checked:bg-slate-50 peer-focus-visible:ring-4 peer-focus-visible:ring-slate-950/10">
                                        <span class="block text-sm font-bold text-slate-950">Ambil toko</span>
                                        <span class="mt-1 block text-xs font-medium leading-5 text-slate-500">Gratis ongkir.</span>
                                    </span>
                                </label>
                            </div>

                            <label class="block">
                                <span class="mb-1.5 block text-sm font-bold text-slate-700">Pembayaran</span>
                                <select name="payment_method" x-model="paymentMethod" class="h-12 w-full rounded-2xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-950 outline-none transition focus:border-slate-950 focus:ring-4 focus:ring-slate-950/10" required>
                                    <option value="cash" x-text="deliveryMethod === 'pickup' ? 'Bayar di toko (Cash / QRIS)' : 'Cash on Delivery'"></option>
                                    <option value="midtrans">Midtrans (Transfer / QRIS)</option>
                                </select>
                            </label>
                        </section>

                        <section class="space-y-3 border-t border-slate-100 pt-6">
                            <div class="flex items-center gap-3">
                                <span class="flex h-7 w-7 items-center justify-center rounded-xl bg-slate-950 text-xs font-bold text-white">02</span>
                                <div>
                                    <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-slate-400">Pembeli</p>
                                    <h2 class="text-lg font-extrabold tracking-tight text-slate-950">Data kontak.</h2>
                                </div>
                            </div>

                            <div class="grid gap-3 sm:grid-cols-2">
                                <label class="block">
                                    <span class="mb-1.5 block text-sm font-bold text-slate-700">Nama penerima</span>
                                    <input type="text" name="buyer_name" id="buyer_name" x-model="buyerName" autocomplete="name" required class="h-12 w-full rounded-2xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-950 outline-none transition placeholder:text-slate-400 focus:border-slate-950 focus:ring-4 focus:ring-slate-950/10">
                                    @error('buyer_name', 'order') <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p> @enderror
                                </label>
                                <label class="block">
                                    <span class="mb-1.5 block text-sm font-bold text-slate-700">Kontak WA / IG</span>
                                    <input type="text" name="buyer_contact" id="buyer_contact" x-model="buyerContact" autocomplete="tel" class="h-12 w-full rounded-2xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-950 outline-none transition placeholder:text-slate-400 focus:border-slate-950 focus:ring-4 focus:ring-slate-950/10">
                                    @error('buyer_contact', 'order') <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p> @enderror
                                </label>
                            </div>
                        </section>

                        <section class="space-y-3 border-t border-slate-100 pt-6">
                            <div class="flex items-center gap-3">
                                <span class="flex h-7 w-7 items-center justify-center rounded-xl bg-slate-950 text-xs font-bold text-white">03</span>
                                <div>
                                    <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-slate-400">Pengiriman</p>
                                    <h2 class="text-lg font-extrabold tracking-tight text-slate-950">Alamat dan catatan.</h2>
                                </div>
                            </div>

                            <label class="block" x-show="deliveryMethod === 'shipping'" x-transition>
                                <span class="mb-1.5 block text-sm font-bold text-slate-700">Alamat pengiriman</span>
                                <textarea name="shipping_address" id="shipping_address" x-model="shippingAddress" rows="3" placeholder="Tulis alamat lengkap untuk cek ongkir" autocomplete="street-address" :required="deliveryMethod === 'shipping'" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold leading-6 text-slate-950 outline-none transition placeholder:text-slate-400 focus:border-slate-950 focus:ring-4 focus:ring-slate-950/10"></textarea>
                                @error('shipping_address', 'order') <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p> @enderror
                            </label>

                            <div x-show="deliveryMethod === 'pickup'" x-cloak class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                <p class="text-[10px] font-bold uppercase tracking-[0.14em] text-slate-400">Lokasi toko</p>
                                <p class="mt-2 text-sm font-bold text-slate-950">{{ $shopName }}</p>
                                <p class="mt-1 text-sm font-medium leading-6 text-slate-600">{{ $shopAddress }}</p>
                                <input type="hidden" name="pickup_address_note" value="AMBIL DI TOKO" :disabled="deliveryMethod !== 'pickup'">
                            </div>

                            <label class="block">
                                <span class="mb-1.5 block text-sm font-bold text-slate-700">Catatan opsional</span>
                                <textarea name="notes" id="notes" x-model="notes" rows="2" placeholder="Contoh: patokan alamat, request packing, atau catatan lain" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold leading-6 text-slate-950 outline-none transition placeholder:text-slate-400 focus:border-slate-950 focus:ring-4 focus:ring-slate-950/10"></textarea>
                                @error('notes', 'order') <p class="mt-1 text-xs font-bold text-red-600">{{ $message }}</p> @enderror
                            </label>

                            <input type="hidden" name="size" value="{{ $product->size }}" required>
                            @error('size', 'order') <p class="text-xs font-bold text-red-600">{{ $message }}</p> @enderror
                        </section>

                        <section class="space-y-3 border-t border-slate-100 pt-6">
                            <div class="flex items-center gap-3">
                                <span class="flex h-7 w-7 items-center justify-center rounded-xl bg-slate-950 text-xs font-bold text-white">04</span>
                                <div>
                                    <p class="text-[11px] font-bold uppercase tracking-[0.16em] text-slate-400">Konfirmasi</p>
                                    <h2 class="text-lg font-extrabold tracking-tight text-slate-950">Ringkasan order.</h2>
                                </div>
                            </div>

                            @include('landing.components.order-summary', ['product' => $product, 'prefilledQuantity' => $prefilledQuantity])
                        </section>

                        <button type="submit" id="submit-order-btn" aria-live="polite" class="inline-flex min-h-[3.35rem] w-full items-center justify-center gap-2 rounded-2xl bg-slate-950 px-6 py-4 text-base font-extrabold text-white shadow-xl shadow-slate-950/15 transition hover:-translate-y-0.5 hover:bg-slate-800 disabled:cursor-not-allowed disabled:opacity-50 disabled:hover:translate-y-0">
                            <svg class="h-5 w-5 submit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <svg class="h-5 w-5 loading-spinner hidden animate-spin" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span class="submit-text">Checkout Sekarang</span>
                        </button>

                        <div class="grid grid-cols-3 divide-x divide-slate-100 rounded-[1.25rem] border border-slate-200 bg-slate-50 px-2 py-3 text-center">
                            <div class="px-2">
                                <p class="text-[10px] font-extrabold uppercase tracking-[0.12em] text-slate-400">Data</p>
                                <p class="mt-1 text-xs font-bold text-slate-700">Aman</p>
                            </div>
                            <div class="px-2">
                                <p class="text-[10px] font-extrabold uppercase tracking-[0.12em] text-slate-400">Stok</p>
                                <p class="mt-1 text-xs font-bold text-slate-700">Satuan</p>
                            </div>
                            <div class="px-2">
                                <p class="text-[10px] font-extrabold uppercase tracking-[0.12em] text-slate-400">Bayar</p>
                                <p class="mt-1 text-xs font-bold text-slate-700">Midtrans/COD</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </main>
    </div>

    <x-toast />

    @if(session('status'))
        <div data-checkout-status="{{ session('status') }}" data-checkout-redirect="{{ route('landing.orders.history') }}" class="hidden"></div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireScripts
</body>
</html>

