<div class="px-4 py-8 sm:px-6 lg:px-10">
    @if (session()->has('message'))
        <x-alert :message="session('message')" type="success" />
    @endif

    <div class="mx-auto max-w-7xl space-y-6">
        <section class="flex flex-col gap-5 border-b border-slate-200 pb-6 lg:flex-row lg:items-end lg:justify-between">
            <div class="max-w-2xl">
                <p class="text-xs font-extrabold uppercase tracking-[0.22em] text-slate-400">Katalog toko</p>
                <h1 class="mt-3 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">Kategori produk.</h1>
                <p class="mt-2 text-base font-medium leading-7 text-slate-600">
                    Kelompokkan item thrift agar filter katalog tetap jelas dan mudah dipakai pembeli.
                </p>
            </div>

            <a
                href="{{ route('categories.create') }}"
                class="inline-flex h-12 items-center justify-center gap-2 rounded-2xl bg-slate-950 px-5 text-sm font-extrabold text-white shadow-[0_16px_40px_rgba(15,23,42,0.18)] transition hover:-translate-y-0.5 hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-200"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m7-7H5" />
                </svg>
                Kategori baru
            </a>
        </section>

        <section class="grid gap-3 sm:grid-cols-3">
            <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">Total kategori</p>
                <p class="mt-3 text-3xl font-black text-slate-950">{{ $categoryStats['total'] }}</p>
            </div>
            <div class="rounded-3xl border border-emerald-200 bg-emerald-50 p-5 shadow-sm">
                <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-emerald-700">Aktif dipakai</p>
                <p class="mt-3 text-3xl font-black text-slate-950">{{ $categoryStats['used'] }}</p>
            </div>
            <div class="rounded-3xl border border-amber-200 bg-amber-50 p-5 shadow-sm">
                <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-amber-700">Perlu isi produk</p>
                <p class="mt-3 text-3xl font-black text-slate-950">{{ $categoryStats['empty'] }}</p>
            </div>
        </section>

        <section class="overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_20px_70px_rgba(15,23,42,0.06)]">
            <div class="flex flex-col gap-4 border-b border-slate-200 p-5 sm:p-6 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h2 class="text-xl font-black text-slate-950">Daftar kategori</h2>
                    <p class="mt-1 text-sm font-semibold text-slate-500">Edit nama kategori tanpa masuk ke data produk.</p>
                </div>

                <div class="relative w-full lg:max-w-sm">
                    <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35m1.1-5.15a6.25 6.25 0 1 1-12.5 0 6.25 6.25 0 0 1 12.5 0Z" />
                    </svg>
                    <input
                        wire:model.live="search"
                        id="category_search"
                        name="category_search"
                        type="search"
                        autocomplete="off"
                        placeholder="Cari kategori"
                        class="h-12 w-full rounded-2xl border border-slate-200 bg-slate-50 pl-12 pr-4 text-sm font-bold text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-300 focus:bg-white focus:ring-4 focus:ring-slate-100"
                    >
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">Produk</th>
                            <th class="px-6 py-4 text-right text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($categories as $category)
                            <tr class="transition hover:bg-slate-50/80">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-950 text-white shadow-sm">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.5 0 1 .2 1.4.6l7 7a2 2 0 0 1 0 2.8l-7 7a2 2 0 0 1-2.8 0l-7-7A2 2 0 0 1 3 12V7a4 4 0 0 1 4-4Z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-base font-black text-slate-950">{{ $category->name }}</p>
                                            <p class="mt-0.5 text-xs font-bold uppercase tracking-[0.14em] text-slate-400">Filter katalog</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex items-center rounded-full border px-3 py-1.5 text-xs font-extrabold {{ $category->products_count > 0 ? 'border-emerald-200 bg-emerald-50 text-emerald-700' : 'border-amber-200 bg-amber-50 text-amber-700' }}">
                                        {{ $category->products_count }} produk
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex justify-end gap-2">
                                        <a
                                            href="{{ route('categories.edit', $category) }}"
                                            class="inline-flex h-10 items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 text-xs font-extrabold text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 hover:text-slate-950 focus:outline-none focus:ring-4 focus:ring-slate-100"
                                        >
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.86 3.49 3.65 3.65M4 20h4.6L19.7 8.9a2.58 2.58 0 0 0-3.65-3.65L4.95 16.35 4 20Z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <button
                                            type="button"
                                            onclick="confirmDelete({{ $category->id }})"
                                            class="inline-flex h-10 items-center justify-center gap-2 rounded-2xl border border-red-200 bg-red-50 px-4 text-xs font-extrabold text-red-600 shadow-sm transition hover:border-red-300 hover:bg-red-100 focus:outline-none focus:ring-4 focus:ring-red-100"
                                        >
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 7h12m-10 0 .7 12.1A2 2 0 0 0 10.7 21h2.6a2 2 0 0 0 2-1.9L16 7M10 11v6m4-6v6M9 7V5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-16">
                                    <div class="mx-auto max-w-sm text-center">
                                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-3xl bg-slate-100 text-slate-400">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.5 0 1 .2 1.4.6l7 7a2 2 0 0 1 0 2.8l-7 7a2 2 0 0 1-2.8 0l-7-7A2 2 0 0 1 3 12V7a4 4 0 0 1 4-4Z" />
                                            </svg>
                                        </div>
                                        <h3 class="mt-4 text-lg font-black text-slate-950">Kategori belum ada.</h3>
                                        <p class="mt-2 text-sm font-semibold leading-6 text-slate-500">Tambahkan kategori pertama agar produk bisa difilter dengan rapi.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($categories->hasPages())
                <div class="border-t border-slate-200 px-5 py-4 sm:px-6">
                    {{ $categories->links() }}
                </div>
            @endif
        </section>
    </div>
</div>
