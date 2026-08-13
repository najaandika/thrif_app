@php
    $inputClass = 'h-12 w-full rounded-2xl border border-slate-200 bg-white px-4 text-sm font-bold text-slate-950 outline-none transition placeholder:text-slate-400 focus:border-slate-300 focus:ring-4 focus:ring-slate-100';
    $labelClass = 'mb-2 block text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400';
@endphp

<div class="grid gap-5 lg:grid-cols-2">
    <div class="lg:col-span-2 rounded-3xl border border-slate-200 bg-slate-50/70 p-4">
        <p class="text-sm font-black text-slate-950">Link sosial media.</p>
        <p class="mt-1 text-sm font-semibold leading-6 text-slate-500">Isi channel yang aktif saja. Link ini dipakai di landing page dan footer.</p>
    </div>

    <div>
        <label for="social_instagram" class="{{ $labelClass }}">Instagram</label>
        <input type="url" id="social_instagram" name="social_instagram" wire:model="social_instagram" placeholder="https://instagram.com/mr.crab_shopp" class="{{ $inputClass }}">
        @error('social_instagram') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="social_tiktok" class="{{ $labelClass }}">TikTok</label>
        <input type="url" id="social_tiktok" name="social_tiktok" wire:model="social_tiktok" placeholder="https://tiktok.com/@mr.crabshopp2nd" class="{{ $inputClass }}">
        @error('social_tiktok') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div class="lg:col-span-2">
        <label for="social_facebook" class="{{ $labelClass }}">Facebook</label>
        <input type="url" id="social_facebook" name="social_facebook" wire:model="social_facebook" placeholder="https://facebook.com/yourshop" class="{{ $inputClass }}">
        @error('social_facebook') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
    </div>
</div>
