@php
    $inputClass = 'h-12 w-full rounded-2xl border border-slate-200 bg-white px-4 text-sm font-bold text-slate-950 outline-none transition placeholder:text-slate-400 focus:border-slate-300 focus:ring-4 focus:ring-slate-100';
@endphp

<div class="px-4 py-8 sm:px-6 lg:px-10">
    <div class="mx-auto max-w-[112rem] space-y-6">
        <section class="flex flex-col gap-5 border-b border-slate-200 pb-6 xl:flex-row xl:items-end xl:justify-between">
            <div class="max-w-3xl">
                <nav class="mb-4 flex items-center gap-2 text-sm font-bold text-slate-400" aria-label="Breadcrumb">
                    <a href="{{ route('categories.index') }}" class="transition hover:text-slate-950">Kategori</a>
                    <span>/</span>
                    <span class="text-slate-950">Tambah</span>
                </nav>
                <p class="text-xs font-extrabold uppercase tracking-[0.22em] text-slate-400">Katalog toko</p>
                <h1 class="mt-3 text-3xl font-black tracking-[-0.04em] text-slate-950 sm:text-4xl">Kategori baru.</h1>
                <p class="mt-2 text-base font-medium leading-7 text-slate-600">
                    Buat kategori singkat yang mudah dipakai untuk filter katalog dan form produk.
                </p>
            </div>

            <div class="hidden h-14 w-14 items-center justify-center rounded-2xl bg-slate-950 text-white shadow-[0_18px_45px_rgba(15,23,42,0.16)] sm:flex" aria-hidden="true">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
            </div>
        </section>

        <form wire:submit.prevent="save" id="categoryForm" class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_24rem]">
            <section class="overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_20px_70px_rgba(15,23,42,0.06)]">
                <div class="border-b border-slate-200 p-5 sm:p-6">
                    <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">Informasi kategori</p>
                    <h2 class="mt-2 text-2xl font-black tracking-[-0.035em] text-slate-950">Nama yang tampil di katalog.</h2>
                </div>

                <div class="space-y-5 p-5 sm:p-6">
                    <div>
                        <label for="name" class="mb-2 block text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400">
                            Nama kategori <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <input
                                wire:model="name"
                                name="name"
                                autocomplete="off"
                                type="text"
                                id="name"
                                placeholder="Contoh: Hoodie, Shirt, Jacket"
                                class="{{ $inputClass }} pr-11"
                            >
                            <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-400">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </span>
                        </div>
                        <p class="mt-2 text-sm font-semibold leading-6 text-slate-500">
                            Kategori akan muncul sebagai pilihan filter dan membantu pembeli menemukan item lebih cepat.
                        </p>
                        @error('name')
                            <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            <aside class="space-y-6 xl:sticky xl:top-28 xl:self-start">
                <section class="rounded-[1.75rem] border border-slate-200 bg-slate-950 p-5 text-white shadow-[0_24px_80px_rgba(15,23,42,0.22)]">
                    <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-white/45">Checklist</p>
                    <div class="mt-4 space-y-3 text-sm font-bold text-white/80">
                        <div class="flex items-center gap-3"><span class="h-2 w-2 rounded-full bg-emerald-400"></span>Nama singkat dan jelas</div>
                        <div class="flex items-center gap-3"><span class="h-2 w-2 rounded-full bg-emerald-400"></span>Tidak duplikat kategori lama</div>
                        <div class="flex items-center gap-3"><span class="h-2 w-2 rounded-full bg-emerald-400"></span>Mudah dipakai untuk filter</div>
                    </div>
                </section>

                <div class="rounded-[1.75rem] border border-slate-200 bg-white p-4 shadow-[0_20px_70px_rgba(15,23,42,0.06)]">
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:target="save"
                        class="inline-flex min-h-[3.25rem] w-full items-center justify-center gap-2 rounded-2xl bg-slate-950 px-6 text-sm font-black text-white shadow-[0_18px_45px_rgba(15,23,42,0.18)] transition hover:-translate-y-0.5 hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-200 disabled:cursor-not-allowed disabled:bg-slate-300 disabled:text-slate-500 disabled:shadow-none disabled:hover:translate-y-0"
                    >
                        <span wire:loading.remove wire:target="save">Simpan kategori</span>
                        <span wire:loading wire:target="save">Menyimpan...</span>
                    </button>
                    <a href="{{ route('categories.index') }}" class="mt-3 inline-flex h-12 w-full items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 text-sm font-extrabold text-slate-700 transition hover:text-slate-950 focus:outline-none focus:ring-4 focus:ring-slate-100">
                        Batal
                    </a>
                </div>
            </aside>
        </form>
    </div>
</div>
