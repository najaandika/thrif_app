<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Pembelian</title>
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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html, body { touch-action: pan-x pan-y; overscroll-behavior: none; overflow-x: hidden; }
    </style>
</head>
<body class="antialiased bg-gray-50 dark:bg-gray-900 font-sans" x-data>
    <div class="min-h-screen">
        <header class="bg-white/80 dark:bg-gray-900/80 border-b border-gray-200 dark:border-gray-800 backdrop-blur">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                <nav class="text-xs font-medium text-gray-600 dark:text-gray-300 flex items-center gap-3">
                    <a href="/" class="hover:text-indigo-600 inline-flex items-center gap-1">
                        <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Home
                    </a>
                    <span class="text-gray-300 dark:text-gray-700">•</span>
                    <span class="text-indigo-600">Riwayat</span>
                </nav>
            </div>
        </header>

        <main class="py-12">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
                <div class="space-y-1">
                    <p class="text-[11px] font-semibold tracking-[0.2em] text-gray-500 dark:text-gray-400 uppercase">Riwayat pembelian</p>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Halo, {{ $customer->name }} — berikut ringkasan order kamu.</h1>
                </div>

                @if (session('status'))
                    <div x-data x-init="setTimeout(() => $el.remove(), 4000)" class="rounded-2xl border-2 border-emerald-300 dark:border-emerald-700 bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-950/40 dark:to-green-950/40 px-5 py-4 flex items-start gap-4 shadow-lg shadow-emerald-500/20">
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

                <div class="space-y-4">
                    @forelse ($orders as $order)
                        <article class="rounded-3xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-sm p-5 flex flex-col md:flex-row gap-4">
                            <div class="flex-1 space-y-2">
                                <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                    <span>#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                                    <span>{{ $order->created_at->translatedFormat('d M Y H:i') }}</span>
                                </div>
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $order->product->name ?? 'Produk terhapus' }}</h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Qty {{ $order->quantity }} · Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Status: <span class="font-semibold text-gray-900 dark:text-gray-100">{{ ucfirst($order->status) }}</span></p>
                                @if ($order->notes)
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Catatan: {{ $order->notes }}</p>
                                @endif
                            </div>
                            <div class="md:w-64 rounded-2xl border border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/60 p-4 text-sm text-gray-600 dark:text-gray-300">
                                <p class="font-semibold text-gray-900 dark:text-gray-100 mb-3">Detail Pengiriman</p>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Nama Penerima</p>
                                        <p class="font-medium text-gray-900 dark:text-gray-200">{{ $order->buyer_name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Kontak</p>
                                        <p class="font-medium text-gray-900 dark:text-gray-200">{{ $order->buyer_contact ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Alamat</p>
                                        <p class="font-medium text-gray-900 dark:text-gray-200">{{ $order->shipping_address ?? 'Belum diisi' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Metode Pembayaran</p>
                                        <p class="font-medium text-gray-900 dark:text-gray-200">{{ $order->payment_method === 'cash' ? 'Cash On Delivery' : ucfirst($order->payment_method) }}</p>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="rounded-3xl border border-dashed border-gray-200 dark:border-gray-700 bg-white/60 dark:bg-gray-900/60 p-8 text-center text-sm text-gray-500 dark:text-gray-400">
                            Kamu belum memiliki order. Silakan kembali ke landing dan mulai belanja.
                        </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
    <x-toast />
    @livewireScripts
</body>
</html>
