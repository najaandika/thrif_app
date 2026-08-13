<div class="px-4 py-8 sm:px-6 lg:px-10">
    <div class="mx-auto max-w-[112rem] space-y-6">
        <section class="flex flex-col gap-5 border-b border-slate-200 pb-6 xl:flex-row xl:items-end xl:justify-between">
            <div class="max-w-3xl">
                <p class="text-xs font-extrabold uppercase tracking-[0.22em] text-rose-500">Promo toko</p>
                <h1 class="mt-3 text-3xl font-black tracking-[-0.04em] text-slate-950 sm:text-4xl">Flash sale & diskon.</h1>
                <p class="mt-2 text-base font-medium leading-7 text-slate-600">
                    Pantau produk yang sedang punya potongan harga dan siap tampil di etalase sale.
                </p>
            </div>

            <a href="{{ route('products.index') }}" class="inline-flex h-12 w-fit items-center justify-center gap-2 rounded-2xl bg-slate-950 px-5 text-sm font-extrabold text-white shadow-[0_18px_45px_rgba(15,23,42,0.18)] transition hover:-translate-y-0.5 hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-200">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" />
                </svg>
                Atur produk
            </a>
        </section>

        <div class="grid gap-4 md:grid-cols-3">
            <div class="rounded-[1.5rem] border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">Total promo</p>
                <p class="mt-4 text-4xl font-black tracking-[-0.05em] text-slate-950">{{ $products->count() }}</p>
            </div>
            <div class="rounded-[1.5rem] border border-emerald-200 bg-emerald-50 p-5 shadow-sm">
                <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-emerald-700">Promo aktif</p>
                <p class="mt-4 text-4xl font-black tracking-[-0.05em] text-slate-950">{{ $activePromos }}</p>
            </div>
            <div class="rounded-[1.5rem] border border-rose-200 bg-rose-50 p-5 shadow-sm">
                <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-rose-700">Etalase sale</p>
                <p class="mt-4 text-4xl font-black tracking-[-0.05em] text-slate-950">{{ $products->where('is_available', true)->count() }}</p>
            </div>
        </div>

        <section class="overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_20px_70px_rgba(15,23,42,0.06)]">
            <div class="flex flex-col gap-4 border-b border-slate-200 p-5 sm:p-6 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">Produk diskon</p>
                    <h2 class="mt-2 text-2xl font-black tracking-[-0.035em] text-slate-950">Daftar item promo.</h2>
                </div>
                <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">{{ $products->count() }} hasil</p>
            </div>

            <div class="p-5 sm:p-6">
                @forelse($products as $product)
                    <a href="{{ route('products.edit', $product) }}" class="group mb-3 grid gap-4 rounded-3xl border border-slate-200 bg-slate-50/60 p-3 transition hover:-translate-y-0.5 hover:bg-white hover:shadow-[0_18px_50px_rgba(15,23,42,0.08)] sm:grid-cols-[4.75rem_minmax(0,1fr)_auto] sm:items-center">
                        @if($product->image)
                            <img src="{{ media_url($product->image) }}" alt="{{ $product->name }}" class="h-20 w-20 rounded-2xl object-cover ring-1 ring-slate-200" />
                        @else
                            <div class="flex h-20 w-20 items-center justify-center rounded-2xl bg-white text-xs font-black uppercase tracking-[0.16em] text-slate-300 ring-1 ring-slate-200">
                                Foto
                            </div>
                        @endif

                        <div class="min-w-0">
                            <p class="truncate text-base font-black text-slate-950">{{ $product->name }}</p>
                            <div class="mt-2 flex flex-wrap items-center gap-2">
                                <span class="text-sm font-black text-rose-600">{{ rupiah($product->final_price) }}</span>
                                <span class="text-sm font-bold text-slate-400 line-through">{{ rupiah($product->price) }}</span>
                                <span class="rounded-full border border-slate-200 bg-white px-3 py-1 text-[11px] font-extrabold uppercase tracking-[0.12em] text-slate-500">
                                    {{ $product->category ?: 'Tanpa kategori' }}
                                </span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between gap-3 sm:justify-end">
                            <span class="inline-flex h-10 items-center rounded-2xl bg-rose-600 px-4 text-sm font-black text-white">
                                -{{ $product->discount_percent }}%
                            </span>
                            <span class="inline-flex h-10 items-center rounded-2xl border border-slate-200 bg-white px-4 text-xs font-extrabold text-slate-600 transition group-hover:text-slate-950">
                                Edit
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="flex min-h-[22rem] flex-col items-center justify-center rounded-3xl border border-dashed border-slate-200 bg-slate-50/70 p-8 text-center">
                        <div class="flex h-16 w-16 items-center justify-center rounded-3xl bg-white text-2xl font-black text-rose-500 shadow-sm">%</div>
                        <h3 class="mt-5 text-2xl font-black tracking-[-0.04em] text-slate-950">Belum ada promo.</h3>
                        <p class="mt-2 max-w-md text-sm font-semibold leading-6 text-slate-500">Tambahkan persentase diskon dari halaman edit produk untuk menampilkan item di sini.</p>
                        <a href="{{ route('products.index') }}" class="mt-5 inline-flex h-12 items-center justify-center rounded-2xl bg-slate-950 px-5 text-sm font-black text-white">
                            Kelola produk
                        </a>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</div>
