<div class="dashboard-container">
    <div class="dashboard-content-wrapper">
        <div class="dashboard-content">
            @if (session()->has('message'))
                <x-alert :message="session('message')" type="success" />
            @endif

            <section class="dashboard-page-header">
                <div>
                    <p class="dashboard-eyebrow">Katalog toko</p>
                    <h1 class="dashboard-title">Produk thrift.</h1>
                    <p class="dashboard-subtitle">Kelola item ready, promo aktif, ukuran, kondisi, dan tampilan produk dari satu tempat.</p>
                </div>

                <a href="{{ route('products.create') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-950 px-5 py-3 text-sm font-extrabold text-white shadow-xl shadow-slate-950/15 transition hover:-translate-y-0.5 hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-300">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.4" d="M12 5v14m7-7H5" />
                    </svg>
                    Tambah produk
                </a>
            </section>

            <section class="grid gap-3 sm:grid-cols-2 xl:grid-cols-4">
                <div class="rounded-[1.35rem] border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">Total produk</p>
                    <div class="mt-4 flex items-end justify-between">
                        <p class="text-4xl font-black tracking-[-0.05em] text-slate-950">{{ $productStats['total'] }}</p>
                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600">Listing</span>
                    </div>
                </div>

                <div class="rounded-[1.35rem] border border-emerald-100 bg-emerald-50/60 p-5 shadow-sm">
                    <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-emerald-700">Ready</p>
                    <div class="mt-4 flex items-end justify-between">
                        <p class="text-4xl font-black tracking-[-0.05em] text-slate-950">{{ $productStats['ready'] }}</p>
                        <span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-emerald-700 shadow-sm">Bisa dijual</span>
                    </div>
                </div>

                <div class="rounded-[1.35rem] border border-rose-100 bg-rose-50/70 p-5 shadow-sm">
                    <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-rose-700">Terjual</p>
                    <div class="mt-4 flex items-end justify-between">
                        <p class="text-4xl font-black tracking-[-0.05em] text-slate-950">{{ $productStats['sold'] }}</p>
                        <span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-rose-700 shadow-sm">Archive</span>
                    </div>
                </div>

                <div class="rounded-[1.35rem] border border-amber-100 bg-amber-50/70 p-5 shadow-sm">
                    <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-amber-700">Promo aktif</p>
                    <div class="mt-4 flex items-end justify-between">
                        <p class="text-4xl font-black tracking-[-0.05em] text-slate-950">{{ $productStats['promo'] }}</p>
                        <span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-amber-700 shadow-sm">Sale</span>
                    </div>
                </div>
            </section>

            <section class="mt-6 overflow-hidden rounded-[1.5rem] border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-4 py-4 sm:px-6">
                    <div class="flex flex-col gap-1 sm:flex-row sm:items-end sm:justify-between">
                        <div>
                            <h2 class="text-xl font-black tracking-[-0.04em] text-slate-950">Daftar produk</h2>
                            <p class="text-sm font-medium text-slate-500">Edit data produk tanpa masuk ke tampilan pelanggan.</p>
                        </div>
                        <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">{{ $products->total() }} hasil</p>
                    </div>
                </div>

                <div class="p-4 sm:p-6">
                    @include('livewire.products._filters')
                    @include('livewire.products._table')
                </div>
            </section>
        </div>
    </div>
</div>
