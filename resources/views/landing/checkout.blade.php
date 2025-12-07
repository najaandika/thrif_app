<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout Produk · Thrif Studio</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    @vite(['resources/css/app.css', 'resources/css/landing.css', 'resources/js/app.js', 'resources/js/landing-checkout.js'])
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}">
    </script>
    <script>
        window.snapToken = @json($snapToken);
    </script>
</head>
<body class="antialiased bg-gray-50 dark:bg-gray-900 font-sans" x-data="{ 
}" 
">
    <div class="min-h-screen">
        <header class="bg-white/80 dark:bg-gray-900/80 border-b border-gray-200 dark:border-gray-800 backdrop-blur">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-end">
                <nav class="text-xs font-medium text-gray-600 dark:text-gray-300 flex items-center gap-3">
                    <a href="/" class="hover:text-slate-900 dark:hover:text-slate-100 inline-flex items-center gap-1">
                        <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Home
                    </a>
                    <span class="text-gray-300 dark:text-gray-700">•</span>
                    <span class="text-gray-400 cursor-not-allowed">Checkout</span>
                </nav>
            </div>
        </header>

        <main class="py-10">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                @if (session('status'))
                    <div x-data x-init="setTimeout(() => $el.remove(), 4000)" class="mb-6 rounded-2xl border-2 border-emerald-300 dark:border-emerald-700 bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-950/40 dark:to-green-950/40 px-5 py-4 flex items-start gap-4 shadow-lg shadow-emerald-500/20">
                        <div class="flex-shrink-0 mt-0.5">
                            <div class="h-8 w-8 rounded-xl bg-gradient-to-br from-emerald-600 to-green-600 flex items-center justify-center text-white shadow-lg shadow-emerald-500/50">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs font-semibold tracking-wide text-emerald-600 dark:text-emerald-400 uppercase mb-1">Success</p>
                            <p class="text-sm font-medium text-emerald-900 dark:text-emerald-100">{{ session('status') }}</p>
                        </div>
                    </div>
                @endif

                @if ($errors->order->any())
                    <div x-data x-init="setTimeout(() => $el.remove(), 4000)" class="mb-6 rounded-2xl border-2 border-red-300 dark:border-red-700 bg-gradient-to-r from-red-50 to-pink-50 dark:from-red-950/40 dark:to-pink-950/40 px-5 py-4 flex items-start gap-4 shadow-lg shadow-red-500/20">
                        <div class="flex-shrink-0 mt-0.5">
                            <div class="h-8 w-8 rounded-xl bg-gradient-to-br from-red-600 to-pink-600 flex items-center justify-center text-white shadow-lg shadow-red-500/50">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs font-semibold tracking-wide text-red-600 dark:text-red-400 uppercase mb-1">Error</p>
                            <p class="text-sm font-medium text-red-900 dark:text-red-100">{{ $errors->order->first() }}</p>
                        </div>
                    </div>
                @endif

                <div class="grid gap-6 lg:grid-cols-[0.85fr,1.15fr]">
                    <section class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-3xl p-6 space-y-5">
                        <p class="{{ $labelClass }}">Produk</p>

                        <div class="space-y-4">
                            <div class="rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-800">
                                @if ($product->image)
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-44 object-cover">
                                @else
                                    <div class="w-full h-44 bg-gradient-to-br from-slate-200 via-slate-100 to-slate-300 dark:from-slate-800 dark:via-slate-700 dark:to-slate-900 flex items-center justify-center text-xs text-gray-500 dark:text-gray-300">
                                        Foto produk menyusul
                                    </div>
                                @endif
                            </div>

                            <div class="space-y-2">
                                <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 leading-tight">{{ $product->name }}</h1>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Kategori: {{ $product->category ?? 'Tanpa kategori' }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Kondisi: {{ $product->condition_label }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Ukuran: <span class="font-semibold text-gray-700 dark:text-gray-200">{{ $product->size ?? '-' }}</span></p>
                                @if ($product->description)
                                    <div class="pt-2 border-t border-gray-100 dark:border-gray-800">
                                        <p class="text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Deskripsi:</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed whitespace-pre-line">{{ strip_tags($product->description) }}</p>
                                    </div>
                                @endif
                                <p class="text-3xl font-bold text-green-600 pt-2">{{ rupiah($product->price) }}</p>
                            </div>
                        </div>

                        <div class="rounded-2xl bg-gray-50 dark:bg-gray-800/70 p-4 text-xs text-gray-600 dark:text-gray-300 space-y-1">
                            <!-- Stok dihapus, hanya tampil status -->
                            <p>Status: <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $product->is_available ? 'Ready to ship' : 'Sold Out' }}</span></p>
                        </div>

                        <div class="rounded-2xl border border-dashed border-gray-300 dark:border-gray-700 p-4 text-xs text-gray-500 dark:text-gray-400">
                            Kamu bisa review kembali order ini setelah submit. Admin akan menghubungi lewat kontak yang kamu isi.
                        </div>
                    </section>

                    <section class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-3xl p-6 space-y-6">
                        <div class="space-y-1">
                            <p class="{{ $labelClass }}">Form Pembelian</p>
                            <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Isi data pengirimanmu</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Semua data akan dijaga kerahasiaannya</p>
                        </div>

                        <form method="POST" action="{{ route('landing.products.order', $product) }}" class="space-y-6" id="checkout-form">
                                                        <div class="space-y-1">
                                                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Metode Pembayaran</label>
                                                            <select name="payment_method" class="{{ $inputClass }}" required>
                                                                <option value="cash">Cash On Delivery</option>
                                                                <option value="transfer">Transfer</option>
                                                                <option value="midtrans">Midtrans</option>
                                                            </select>
                                                        </div>
                            @csrf

                            <div class="space-y-3">
                                <div class="flex items-center gap-2">
                                    <div class="h-8 w-8 rounded-xl bg-slate-900 text-slate-100 dark:bg-slate-800 dark:text-slate-100 flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <p class="{{ $labelClass }}">Data Pembeli</p>
                                </div>
                                <div class="space-y-1">
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Nama penerima</label>
                                    <input type="text" name="buyer_name" value="{{ $prefill['buyer_name'] }}" class="{{ $inputClass }}" required>
                                    @error('buyer_name', 'order')
                                        <p class="text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-1">
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Kontak (WA / IG)</label>
                                    <input type="text" name="buyer_contact" value="{{ $prefill['buyer_contact'] }}" class="{{ $inputClass }}">
                                    @error('buyer_contact', 'order')
                                        <p class="text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div class="flex items-center gap-2">
                                    <div class="h-8 w-8 rounded-xl bg-gradient-to-br from-emerald-500 to-green-500 flex items-center justify-center text-white">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <p class="{{ $labelClass }}">Detail Pengiriman</p>
                                </div>
                                <div class="space-y-1">
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Alamat pengiriman</label>
                                    <textarea name="shipping_address" rows="3" class="{{ $inputClass }}" placeholder="Kota, detail alamat, atau info COD">{{ $prefill['shipping_address'] }}</textarea>
                                    @error('shipping_address', 'order')
                                        <p class="text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-1">
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Catatan (Opsional)</label>
                                    <textarea name="notes" rows="2" class="{{ $inputClass }}" placeholder="Tambahkan catatan untuk pesanan ini...">{{ $prefill['notes'] }}</textarea>
                                    @error('notes', 'order')
                                        <p class="text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Size Selector -->
                                <input type="hidden" name="size" value="{{ $product->size }}" required>
                                @error('size', 'order')
                                    <p class="text-xs text-red-500">{{ $message }}</p>
                                @enderror

                                <div class="grid gap-4 sm:grid-cols-2">

                                </div>
                            </div>

                            <div class="space-y-3">
                                    @include('landing.components.order-summary', ['product' => $product, 'prefilledQuantity' => $prefilledQuantity])
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center gap-3 pt-1">
                                <button type="submit" id="submit-order-btn" aria-live="polite" class="inline-flex items-center justify-center gap-2 flex-1 rounded-2xl bg-gray-800 px-6 py-3.5 text-sm font-semibold text-white shadow-xl shadow-gray-900/40 transition-all duration-300 hover:bg-gray-700 hover:scale-105 hover:shadow-2xl hover:shadow-gray-900/60 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100">
                                    <svg class="w-5 h-5 submit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <svg class="w-5 h-5 loading-spinner hidden animate-spin" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span class="submit-text">Kirim Order</span>
                                </button>
                                <a href="/" class="inline-flex items-center justify-center gap-2 rounded-2xl border-2 border-gray-200 dark:border-gray-700 px-5 py-3.5 text-sm font-semibold text-gray-700 dark:text-gray-100 transition-all duration-300 hover:bg-gray-50 dark:hover:bg-gray-800 hover:border-gray-300 dark:hover:border-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Batalkan
                                </a>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </main>
    </div>

    <x-toast />
    @livewireScripts
</body>
</html>
