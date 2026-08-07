<div>
    @if (session()->has('addressSaved'))
        <div class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-bold text-emerald-700" role="status">
            {{ session('addressSaved') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-5">
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label for="recipient_name" class="text-sm font-bold text-slate-700">Nama penerima</label>
                <input type="text" id="recipient_name" name="recipient_name" wire:model.defer="recipient_name" class="mt-2 h-12 w-full rounded-2xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-950 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-950 focus:ring-4 focus:ring-slate-950/10" placeholder="Nama lengkap" autocomplete="name" />
                @error('recipient_name')
                    <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="text-sm font-bold text-slate-700">Nomor WhatsApp</label>
                <input type="text" id="phone" name="phone" wire:model.defer="phone" class="mt-2 h-12 w-full rounded-2xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-950 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-950 focus:ring-4 focus:ring-slate-950/10" placeholder="08xxxxxxxxxx" autocomplete="tel" />
                @error('phone')
                    <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="address_line" class="text-sm font-bold text-slate-700">Alamat lengkap</label>
            <textarea id="address_line" name="address_line" wire:model.defer="address_line" rows="4" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold leading-6 text-slate-950 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-950 focus:ring-4 focus:ring-slate-950/10" placeholder="Nama jalan, nomor rumah, kecamatan, kota, dan patokan"></textarea>
            @error('address_line')
                <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid gap-3 rounded-[1.5rem] border border-slate-200 bg-slate-50 p-4 sm:grid-cols-3 sm:divide-x sm:divide-slate-100">
            <div class="sm:px-2">
                <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Status</p>
                <p class="mt-1 text-sm font-extrabold text-slate-950">{{ $hasAddress ? 'Tersimpan' : 'Belum ada' }}</p>
            </div>
            <div class="sm:px-2">
                <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Checkout</p>
                <p class="mt-1 text-sm font-extrabold text-slate-950">Lebih cepat</p>
            </div>
            <div class="sm:px-2">
                <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Update</p>
                <p class="mt-1 text-sm font-extrabold text-slate-950">{{ $hasAddress && $lastUpdatedHuman ? $lastUpdatedHuman : '-' }}</p>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <button type="submit" class="inline-flex min-h-12 items-center justify-center rounded-2xl bg-slate-950 px-6 py-3 text-sm font-extrabold text-white shadow-xl shadow-slate-950/15 transition hover:-translate-y-0.5 hover:bg-slate-800">
                Simpan alamat
            </button>

            <a href="{{ route('landing.products.index') }}" class="inline-flex min-h-12 items-center justify-center rounded-2xl border border-slate-200 bg-white px-6 py-3 text-sm font-extrabold text-slate-700 shadow-sm transition hover:bg-slate-50 hover:text-slate-950">
                Buka katalog
            </a>
        </div>
    </form>
</div>