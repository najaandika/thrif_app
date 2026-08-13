@php
    $inputClass = 'h-12 w-full rounded-2xl border border-slate-200 bg-white px-4 text-sm font-bold text-slate-950 outline-none transition placeholder:text-slate-400 focus:border-slate-300 focus:ring-4 focus:ring-slate-100';
    $textareaClass = 'min-h-36 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold leading-6 text-slate-950 outline-none transition placeholder:text-slate-400 focus:border-slate-300 focus:ring-4 focus:ring-slate-100';
    $labelClass = 'mb-2 block text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400';
@endphp

<div class="space-y-5">
    <div>
        <label for="about_title" class="{{ $labelClass }}">Judul section</label>
        <input
            type="text"
            id="about_title"
            name="about_title"
            wire:model="about_title"
            placeholder="Tentang Mr Crab Shop"
            class="{{ $inputClass }}"
        >
        @error('about_title') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="about_description" class="{{ $labelClass }}">Deskripsi</label>
        <textarea
            id="about_description"
            name="about_description"
            wire:model="about_description"
            rows="5"
            placeholder="Ceritakan alasan toko ini dipercaya, cara kurasi barang, dan kejelasan order."
            class="{{ $textareaClass }}"
        ></textarea>
        @error('about_description') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div class="grid gap-4 lg:grid-cols-3">
        <div class="rounded-3xl border border-slate-200 bg-slate-50/70 p-4">
            <label for="about_feature_1" class="{{ $labelClass }}">Fitur 1</label>
            <input
                type="text"
                id="about_feature_1"
                name="about_feature_1"
                wire:model="about_feature_1"
                placeholder="Pre-loved Quality"
                class="{{ $inputClass }}"
            >
            @error('about_feature_1') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
        </div>

        <div class="rounded-3xl border border-slate-200 bg-slate-50/70 p-4">
            <label for="about_feature_2" class="{{ $labelClass }}">Fitur 2</label>
            <input
                type="text"
                id="about_feature_2"
                name="about_feature_2"
                wire:model="about_feature_2"
                placeholder="Stok Real-time"
                class="{{ $inputClass }}"
            >
            @error('about_feature_2') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
        </div>

        <div class="rounded-3xl border border-slate-200 bg-slate-50/70 p-4">
            <label for="about_feature_3" class="{{ $labelClass }}">Fitur 3</label>
            <input
                type="text"
                id="about_feature_3"
                name="about_feature_3"
                wire:model="about_feature_3"
                placeholder="Terpercaya"
                class="{{ $inputClass }}"
            >
            @error('about_feature_3') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
        </div>
    </div>
</div>
