@php
    $inputClass = 'h-12 w-full rounded-2xl border border-slate-200 bg-white px-4 text-sm font-bold text-slate-950 outline-none transition placeholder:text-slate-400 focus:border-slate-300 focus:ring-4 focus:ring-slate-100';
    $textareaClass = 'min-h-28 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-bold leading-6 text-slate-950 outline-none transition placeholder:text-slate-400 focus:border-slate-300 focus:ring-4 focus:ring-slate-100';
    $labelClass = 'mb-2 block text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400';
    $hintClass = 'mt-2 text-xs font-semibold leading-5 text-slate-500';
@endphp

<div class="space-y-6">
    <section class="rounded-3xl border border-slate-200 bg-slate-50/70 p-4">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-4">
                @if($shop_logo)
                    <img src="{{ media_url($shop_logo) }}" alt="{{ $shop_name }}" class="h-20 w-20 rounded-3xl object-cover ring-1 ring-slate-200">
                @else
                    <div class="flex h-20 w-20 items-center justify-center rounded-3xl bg-slate-950 text-xl font-black text-white">
                        {{ strtoupper(substr($shop_name ?: 'M', 0, 1)) }}
                    </div>
                @endif
                <div>
                    <p class="text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400">Logo toko</p>
                    <p class="mt-1 text-sm font-bold text-slate-600">PNG/JPG maksimal 2MB.</p>
                </div>
            </div>

            @if($shop_logo)
                <button type="button" wire:click="removeLogo" class="inline-flex h-11 items-center justify-center rounded-2xl border border-rose-200 bg-rose-50 px-4 text-xs font-extrabold text-rose-700 transition hover:bg-rose-100 focus:outline-none focus:ring-4 focus:ring-rose-100">
                    Hapus logo
                </button>
            @endif
        </div>

        <div class="mt-4">
            <input id="new_logo" name="new_logo" type="file" wire:model="new_logo" accept="image/*" class="block w-full cursor-pointer rounded-2xl border border-slate-200 bg-white text-sm font-bold text-slate-500 file:mr-4 file:border-0 file:bg-slate-950 file:px-5 file:py-3 file:text-sm file:font-black file:text-white hover:file:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-100">
            @error('new_logo') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
        </div>
    </section>

    <div class="grid gap-5 lg:grid-cols-2">
        <div>
            <label for="shop_name" class="{{ $labelClass }}">Nama toko <span class="text-rose-500">*</span></label>
            <input type="text" id="shop_name" name="shop_name" wire:model="shop_name" class="{{ $inputClass }}" placeholder="Mr Crab Shop">
            @error('shop_name') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="shop_tagline" class="{{ $labelClass }}">Tagline</label>
            <input type="text" id="shop_tagline" name="shop_tagline" wire:model="shop_tagline" placeholder="Curated preloved goods" class="{{ $inputClass }}">
            @error('shop_tagline') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="shop_email" class="{{ $labelClass }}">Email toko</label>
            <input type="email" id="shop_email" name="shop_email" wire:model="shop_email" placeholder="contact@mrcrabshop.com" class="{{ $inputClass }}">
            @error('shop_email') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="shop_phone" class="{{ $labelClass }}">Nomor WhatsApp</label>
            <input type="text" id="shop_phone" name="shop_phone" wire:model="shop_phone" placeholder="0813-8905-1455" class="{{ $inputClass }}">
            @error('shop_phone') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
        </div>

        <div class="lg:col-span-2">
            <label for="shop_address" class="{{ $labelClass }}">Alamat toko</label>
            <textarea id="shop_address" name="shop_address" wire:model="shop_address" rows="3" placeholder="Jl. Pulau Pisang, Sukarame, Bandar Lampung" class="{{ $textareaClass }}"></textarea>
            <p class="{{ $hintClass }}">Dipakai untuk footer dan fallback pencarian Google Maps.</p>
            @error('shop_address') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="shop_location_name" class="{{ $labelClass }}">Nama lokasi</label>
            <input type="text" id="shop_location_name" name="shop_location_name" wire:model="shop_location_name" placeholder="Mr Crab Shop, Bandar Lampung" class="{{ $inputClass }}">
            @error('shop_location_name') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="shop_maps_url" class="{{ $labelClass }}">Link Google Maps</label>
            <input type="url" id="shop_maps_url" name="shop_maps_url" wire:model="shop_maps_url" placeholder="https://maps.google.com/..." class="{{ $inputClass }}">
            <p class="{{ $hintClass }}">Salin dari Google Maps lewat menu Bagikan.</p>
            @error('shop_maps_url') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
        </div>
    </div>
</div>
