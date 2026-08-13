@php
    $inputClass = 'h-12 w-full rounded-2xl border border-slate-200 bg-white px-4 text-sm font-bold text-slate-950 outline-none transition placeholder:text-slate-400 focus:border-slate-300 focus:ring-4 focus:ring-slate-100';
    $labelClass = 'mb-2 block text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400';
@endphp

<div class="grid gap-5 lg:grid-cols-2">
    <div class="rounded-3xl border border-slate-200 bg-slate-50/70 p-4">
        <label for="operating_hours" class="{{ $labelClass }}">Jam buka</label>
        <input type="text" id="operating_hours" name="operating_hours" wire:model="operating_hours" placeholder="Setiap hari, 09:00 - 21:30" class="{{ $inputClass }}">
        <p class="mt-2 text-xs font-semibold leading-5 text-slate-500">Ditampilkan di footer dan info kontak landing page.</p>
        @error('operating_hours') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
    </div>

    <div class="rounded-3xl border border-slate-200 bg-slate-50/70 p-4">
        <label for="payment_methods" class="{{ $labelClass }}">Metode pembayaran</label>
        <input type="text" id="payment_methods" name="payment_methods" wire:model="payment_methods" placeholder="Cash, QRIS, Transfer Bank" class="{{ $inputClass }}">
        <p class="mt-2 text-xs font-semibold leading-5 text-slate-500">Tulis ringkas sesuai metode yang benar-benar diterima toko.</p>
        @error('payment_methods') <p class="mt-2 text-xs font-bold text-rose-600">{{ $message }}</p> @enderror
    </div>
</div>
