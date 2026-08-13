@php
    $isEdit = isset($product);
    $submitAction = $isEdit ? 'update' : 'save';
    $submitLabel = $isEdit ? 'Simpan perubahan' : 'Simpan produk';
    $title = $isEdit ? 'Edit produk.' : 'Produk baru.';
    $subtitle = $isEdit
        ? 'Perbarui foto, harga, kondisi, diskon, dan status listing.'
        : 'Tambahkan item thrift baru dengan detail yang jelas untuk pembeli.';
    $inputClass = 'h-12 w-full rounded-2xl border border-slate-200 bg-white px-4 text-sm font-bold text-slate-950 outline-none transition placeholder:text-slate-400 focus:border-slate-300 focus:ring-4 focus:ring-slate-100';
    $textareaClass = 'min-h-32 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold leading-6 text-slate-950 outline-none transition placeholder:text-slate-400 focus:border-slate-300 focus:ring-4 focus:ring-slate-100';
    $labelClass = 'mb-2 block text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400';
    $conditionOptions = [
        'new' => 'New',
        'like-new' => 'Like New',
        'good' => 'Good',
        'fair' => 'Fair',
        'poor' => 'Poor',
    ];
@endphp

<div class="px-4 py-8 sm:px-6 lg:px-10">
    <div class="mx-auto max-w-[112rem] space-y-6">
        <section class="flex flex-col gap-5 border-b border-slate-200 pb-6 xl:flex-row xl:items-end xl:justify-between">
            <div class="max-w-3xl">
                <nav class="mb-4 flex items-center gap-2 text-sm font-bold text-slate-400" aria-label="Breadcrumb">
                    <a href="{{ route('products.index') }}" class="transition hover:text-slate-950">Produk</a>
                    <span>/</span>
                    <span class="text-slate-950">{{ $isEdit ? 'Edit' : 'Tambah' }}</span>
                </nav>
                <p class="text-xs font-extrabold uppercase tracking-[0.22em] text-slate-400">Katalog toko</p>
                <h1 class="mt-3 text-3xl font-black tracking-[-0.04em] text-slate-950 sm:text-4xl">{{ $title }}</h1>
                <p class="mt-2 text-base font-medium leading-7 text-slate-600">{{ $subtitle }}</p>
            </div>
        </section>

        <form wire:submit.prevent="{{ $submitAction }}" id="productForm" class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_24rem]">
            <div class="space-y-6">
                <section class="overflow-visible rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_20px_70px_rgba(15,23,42,0.06)]">
                    <div class="border-b border-slate-200 p-5 sm:p-6">
                        <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">Informasi utama</p>
                        <h2 class="mt-2 text-2xl font-black tracking-[-0.035em] text-slate-950">Detail yang tampil di katalog.</h2>
                    </div>

                    <div class="space-y-5 p-5 sm:p-6">
                        <div>
                            <label for="name" class="{{ $labelClass }}">Nama produk <span class="text-rose-500">*</span></label>
                            <input wire:model="name" name="name" autocomplete="off" type="text" id="name" placeholder="Contoh: Vintage Navy Crewneck" class="{{ $inputClass }}">
                            @error('name') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="description" class="{{ $labelClass }}">Catatan produk</label>
                            <textarea wire:model="description" name="description" autocomplete="off" id="description" rows="4" placeholder="Tulis kondisi, bahan, minus kecil, atau catatan pemakaian." class="{{ $textareaClass }}"></textarea>
                            @error('description') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid gap-5 md:grid-cols-2">
                            <div>
                                <label for="price" class="{{ $labelClass }}">Harga <span class="text-rose-500">*</span></label>
                                <div x-data="currencyInput('{{ $price ?? 0 }}', 'price')" class="relative">
                                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-sm font-black text-slate-400">Rp</span>
                                    <input
                                        type="text"
                                        id="price"
                                        name="price"
                                        :value="displayValue"
                                        @input="update"
                                        placeholder="0"
                                        class="{{ $inputClass }} pl-11"
                                    >
                                </div>
                                @error('price') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="size" class="{{ $labelClass }}">Ukuran <span class="text-rose-500">*</span></label>
                                <input wire:model="size" name="size" id="size" type="text" placeholder="Contoh: L, XL, 32, 42" class="{{ $inputClass }}">
                                @error('size') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid gap-5 md:grid-cols-2">
                            <div>
                                <label id="condition-label" class="{{ $labelClass }}">Kondisi <span class="text-rose-500">*</span></label>
                                <div
                                    x-data="{ open: false, selectedCondition: @entangle('condition') }"
                                    x-on:keydown.escape.window="open = false"
                                    class="relative"
                                >
                                    <button
                                        type="button"
                                        aria-labelledby="condition-label"
                                        x-on:click="open = ! open"
                                        class="flex h-12 w-full items-center justify-between rounded-2xl border border-slate-200 bg-white px-4 text-left text-sm font-black text-slate-950 outline-none transition hover:border-slate-300 focus:border-slate-300 focus:ring-4 focus:ring-slate-100"
                                    >
                                        <span x-text="{
                                            'new': 'New',
                                            'like-new': 'Like New',
                                            'good': 'Good',
                                            'fair': 'Fair',
                                            'poor': 'Poor'
                                        }[selectedCondition] || 'Pilih kondisi'"></span>
                                        <svg class="h-4 w-4 text-slate-400 transition" x-bind:class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6" />
                                        </svg>
                                    </button>

                                    <div
                                        x-cloak
                                        x-show="open"
                                        x-transition.origin.top
                                        x-on:click.outside="open = false"
                                        class="absolute left-0 right-0 top-[3.35rem] z-30 overflow-hidden rounded-3xl border border-slate-200 bg-white p-2 shadow-[0_24px_70px_rgba(15,23,42,0.14)]"
                                    >
                                        @foreach($conditionOptions as $value => $label)
                                            <button
                                                type="button"
                                                x-on:click="selectedCondition = '{{ $value }}'; open = false"
                                                class="flex h-11 w-full items-center justify-between rounded-2xl px-3 text-left text-sm font-extrabold transition hover:bg-slate-50"
                                                x-bind:class="selectedCondition === '{{ $value }}' ? 'bg-slate-950 text-white hover:bg-slate-950' : 'text-slate-600 hover:text-slate-950'"
                                            >
                                                <span>{{ $label }}</span>
                                                <span class="h-2 w-2 rounded-full" x-bind:class="selectedCondition === '{{ $value }}' ? 'bg-white' : 'bg-slate-200'"></span>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                                @error('condition') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label id="category-label" class="{{ $labelClass }}">Kategori</label>
                                <div
                                    x-data="{ open: false, selectedCategory: @entangle('category') }"
                                    x-on:keydown.escape.window="open = false"
                                    class="relative"
                                >
                                    <button
                                        type="button"
                                        aria-labelledby="category-label"
                                        x-on:click="open = ! open"
                                        class="flex h-12 w-full items-center justify-between rounded-2xl border border-slate-200 bg-white px-4 text-left text-sm font-black text-slate-950 outline-none transition hover:border-slate-300 focus:border-slate-300 focus:ring-4 focus:ring-slate-100"
                                    >
                                        <span x-text="selectedCategory || 'Pilih kategori'"></span>
                                        <svg class="h-4 w-4 text-slate-400 transition" x-bind:class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6" />
                                        </svg>
                                    </button>

                                    <div
                                        x-cloak
                                        x-show="open"
                                        x-transition.origin.top
                                        x-on:click.outside="open = false"
                                        class="absolute left-0 right-0 top-[3.35rem] z-30 max-h-72 overflow-y-auto rounded-3xl border border-slate-200 bg-white p-2 shadow-[0_24px_70px_rgba(15,23,42,0.14)]"
                                    >
                                        <button
                                            type="button"
                                            x-on:click="selectedCategory = ''; open = false"
                                            class="flex h-11 w-full items-center justify-between rounded-2xl px-3 text-left text-sm font-extrabold transition hover:bg-slate-50"
                                            x-bind:class="! selectedCategory ? 'bg-slate-950 text-white hover:bg-slate-950' : 'text-slate-600 hover:text-slate-950'"
                                        >
                                            <span>Tanpa kategori</span>
                                            <span class="h-2 w-2 rounded-full" x-bind:class="! selectedCategory ? 'bg-white' : 'bg-slate-200'"></span>
                                        </button>

                                        @foreach($categories as $cat)
                                            <button
                                                type="button"
                                                x-on:click='selectedCategory = @js($cat->name); open = false'
                                                class="flex h-11 w-full items-center justify-between rounded-2xl px-3 text-left text-sm font-extrabold transition hover:bg-slate-50"
                                                x-bind:class='selectedCategory === @js($cat->name) ? "bg-slate-950 text-white hover:bg-slate-950" : "text-slate-600 hover:text-slate-950"'
                                            >
                                                <span>{{ $cat->name }}</span>
                                                <span class="h-2 w-2 rounded-full" x-bind:class='selectedCategory === @js($cat->name) ? "bg-white" : "bg-slate-200"'></span>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                                @error('category') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </section>

                <section class="overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_20px_70px_rgba(15,23,42,0.06)]">
                    <div class="border-b border-slate-200 p-5 sm:p-6">
                        <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-rose-500">Promo</p>
                        <h2 class="mt-2 text-2xl font-black tracking-[-0.035em] text-slate-950">Diskon opsional.</h2>
                    </div>

                    <div class="grid gap-5 p-5 sm:p-6 lg:grid-cols-3">
                        <div>
                            <label for="discount_percentage" class="{{ $labelClass }}">Diskon</label>
                            <div class="relative">
                                <input
                                    wire:model.live.debounce.250ms="discount_percentage"
                                    x-on:input="$event.target.value = $event.target.value.replace(/[^0-9]/g, '').slice(0, 3); if (Number($event.target.value) > 100) $event.target.value = 100"
                                    name="discount_percentage"
                                    type="text"
                                    inputmode="numeric"
                                    id="discount_percentage"
                                    maxlength="3"
                                    placeholder="0"
                                    class="{{ $inputClass }} pr-10"
                                >
                                <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-sm font-black text-slate-400">%</span>
                            </div>
                            @error('discount_percentage') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="discount_start" class="{{ $labelClass }}">Mulai</label>
                            <div x-data x-init="flatpickr($refs.startPicker, { enableTime: true, dateFormat: 'Y-m-d H:i', time_24hr: true, disableMobile: true })">
                                <input wire:model="discount_start" name="discount_start" x-ref="startPicker" type="text" id="discount_start" placeholder="Pilih tanggal" class="{{ $inputClass }}">
                            </div>
                            @error('discount_start') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="discount_end" class="{{ $labelClass }}">Berakhir</label>
                            <div x-data x-init="flatpickr($refs.endPicker, { enableTime: true, dateFormat: 'Y-m-d H:i', time_24hr: true, disableMobile: true })">
                                <input wire:model="discount_end" name="discount_end" x-ref="endPicker" type="text" id="discount_end" placeholder="Pilih tanggal" class="{{ $inputClass }}">
                            </div>
                            @error('discount_end') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </section>

                <section class="overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_20px_70px_rgba(15,23,42,0.06)]">
                    <div class="border-b border-slate-200 p-5 sm:p-6">
                        <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">Galeri</p>
                        <h2 class="mt-2 text-2xl font-black tracking-[-0.035em] text-slate-950">Foto produk.</h2>
                    </div>

                    <div class="space-y-6 p-5 sm:p-6">
                        <div>
                            <label for="image" class="{{ $labelClass }}">{{ $isEdit && $product->image ? 'Ganti foto utama' : 'Foto utama' }}</label>
                            <input wire:model="image" name="image" type="file" id="image" accept="image/*" class="block w-full cursor-pointer rounded-2xl border border-slate-200 bg-white text-sm font-bold text-slate-500 file:mr-4 file:border-0 file:bg-slate-950 file:px-5 file:py-3 file:text-sm file:font-black file:text-white hover:file:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-100">
                            @error('image') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror

                            <div class="mt-4 grid gap-4 sm:grid-cols-2">
                                @if($isEdit && $product->image)
                                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-3">
                                        <p class="mb-2 text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400">Foto saat ini</p>
                                        <img src="{{ media_url($product->image) }}" alt="{{ $product->name }}" class="aspect-square w-full rounded-2xl object-cover">
                                    </div>
                                @endif

                                @if(!$isEdit && $imagePreviewUrl)
                                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-3">
                                        <p class="mb-2 text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400">Preview</p>
                                        <img src="{{ $imagePreviewUrl }}" alt="Preview produk" class="aspect-square w-full rounded-2xl object-cover">
                                    </div>
                                @elseif($isEdit && $image)
                                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-3">
                                        <p class="mb-2 text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400">Preview baru</p>
                                        <img src="{{ Storage::disk('public')->url('livewire-tmp/' . $image->getFilename()) }}" alt="Preview produk baru" class="aspect-square w-full rounded-2xl object-cover">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="border-t border-slate-200 pt-6">
                            <div class="mb-4 flex flex-col gap-1 sm:flex-row sm:items-end sm:justify-between">
                                <div>
                                    <p class="{{ $labelClass }} mb-1">Foto tambahan</p>
                                    <p class="text-sm font-semibold text-slate-500">Tambahkan sampai 5 gambar untuk detail produk.</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-5">
                                @if($isEdit)
                                    @foreach($product->images as $img)
                                        @if(in_array($img->id, $imagesToDelete)) @continue @endif
                                        <div class="group relative aspect-square overflow-hidden rounded-3xl border border-slate-200 bg-slate-50">
                                            <img src="{{ media_url($img->image_path) }}" alt="Foto tambahan produk" class="h-full w-full object-cover">
                                            <button type="button" wire:click="deleteExistingImage({{ $img->id }})" class="absolute inset-x-3 bottom-3 inline-flex h-10 items-center justify-center rounded-2xl bg-white/95 text-xs font-black text-rose-600 shadow-sm opacity-0 transition group-hover:opacity-100">
                                                Hapus
                                            </button>
                                        </div>
                                    @endforeach
                                @endif

                                @foreach ($additionalImagePreviews as $index => $preview)
                                    <div class="group relative aspect-square overflow-hidden rounded-3xl border border-slate-200 bg-slate-50">
                                        <img src="{{ $preview }}" alt="Preview foto tambahan" class="h-full w-full object-cover">
                                        <button type="button" wire:click="{{ $isEdit ? 'removeNewAdditionalImage' : 'removeAdditionalImage' }}({{ $index }})" class="absolute inset-x-3 bottom-3 inline-flex h-10 items-center justify-center rounded-2xl bg-white/95 text-xs font-black text-rose-600 shadow-sm opacity-0 transition group-hover:opacity-100">
                                            Hapus
                                        </button>
                                    </div>
                                @endforeach

                                <label for="additionalImages-{{ $uploadIteration }}" class="flex aspect-square cursor-pointer flex-col items-center justify-center rounded-3xl border border-dashed border-slate-300 bg-slate-50 text-center transition hover:border-slate-400 hover:bg-white">
                                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-2xl font-black text-slate-950 shadow-sm">+</span>
                                    <span class="mt-3 text-xs font-black uppercase tracking-[0.14em] text-slate-400">Tambah foto</span>
                                    <input wire:model="newAdditionalImages" name="newAdditionalImages[]" type="file" id="additionalImages-{{ $uploadIteration }}" multiple accept="image/*" class="hidden">
                                </label>
                            </div>
                            @error('additionalImages.*') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
                            @error('newAdditionalImages.*') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </section>
            </div>

            <aside class="space-y-6 xl:sticky xl:top-28 xl:self-start">
                <section class="rounded-[1.75rem] border border-slate-200 bg-white p-5 shadow-[0_20px_70px_rgba(15,23,42,0.06)]">
                    <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-slate-400">Status listing</p>
                    <div class="mt-4 rounded-3xl border border-slate-200 bg-slate-50/70 p-4">
                        @if($isEdit)
                            <label for="is_available" class="flex cursor-pointer items-center justify-between gap-4">
                                <span>
                                    <span class="block text-sm font-black text-slate-950">Tampil di katalog</span>
                                    <span class="mt-1 block text-xs font-semibold leading-5 text-slate-500">Matikan jika produk belum siap dijual.</span>
                                </span>
                                <input wire:model="is_available" name="is_available" id="is_available" type="checkbox" class="h-5 w-5 rounded-md border-slate-300 text-slate-950 focus:ring-4 focus:ring-slate-100">
                            </label>
                            @error('is_available') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
                        @else
                            <p class="text-sm font-black text-slate-950">Produk baru akan masuk sebagai listing ready.</p>
                            <p class="mt-2 text-xs font-semibold leading-5 text-slate-500">Kamu bisa mengubah statusnya setelah produk dibuat.</p>
                        @endif
                    </div>
                </section>

                <section class="rounded-[1.75rem] border border-slate-200 bg-slate-950 p-5 text-white shadow-[0_24px_80px_rgba(15,23,42,0.22)]">
                    <p class="text-xs font-extrabold uppercase tracking-[0.18em] text-white/45">Checklist</p>
                    <div class="mt-4 space-y-3 text-sm font-bold text-white/80">
                        <div class="flex items-center gap-3"><span class="h-2 w-2 rounded-full bg-emerald-400"></span>Nama dan ukuran jelas</div>
                        <div class="flex items-center gap-3"><span class="h-2 w-2 rounded-full bg-emerald-400"></span>Harga final sudah benar</div>
                        <div class="flex items-center gap-3"><span class="h-2 w-2 rounded-full bg-emerald-400"></span>Foto tidak blur atau kepotong</div>
                    </div>
                </section>

                <div class="rounded-[1.75rem] border border-slate-200 bg-white p-4 shadow-[0_20px_70px_rgba(15,23,42,0.06)]">
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:target="{{ $submitAction }}"
                        class="inline-flex min-h-[3.25rem] w-full items-center justify-center gap-2 rounded-2xl bg-slate-950 px-6 text-sm font-black text-white shadow-[0_18px_45px_rgba(15,23,42,0.18)] transition hover:-translate-y-0.5 hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-200 disabled:cursor-not-allowed disabled:bg-slate-300 disabled:text-slate-500 disabled:shadow-none disabled:hover:translate-y-0"
                    >
                        <span wire:loading.remove wire:target="{{ $submitAction }}">{{ $submitLabel }}</span>
                        <span wire:loading wire:target="{{ $submitAction }}">Menyimpan...</span>
                    </button>
                    <a href="{{ route('products.index') }}" class="mt-3 inline-flex h-12 w-full items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 text-sm font-extrabold text-slate-700 transition hover:text-slate-950 focus:outline-none focus:ring-4 focus:ring-slate-100">
                        Batal
                    </a>
                </div>
            </aside>
        </form>
    </div>
</div>
