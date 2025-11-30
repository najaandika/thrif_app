<div class="profile-section">
    @if (session()->has('addressSaved'))
        <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
            {{ session('addressSaved') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="profile-section">
        <div class="grid gap-6 md:grid-cols-2">
            <div class="space-y-2">
                <label class="text-sm font-semibold text-gray-700 dark:text-gray-200">Nama penerima</label>
                <input type="text" wire:model.defer="recipient_name" class="w-full rounded-xl border-2 border-gray-200 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100" placeholder="Nama lengkap" />
                @error('recipient_name')
                    <p class="text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="text-sm font-semibold text-gray-700 dark:text-gray-200">Nomor kontak</label>
                <input type="text" wire:model.defer="phone" class="w-full rounded-xl border-2 border-gray-200 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100" placeholder="08xxxxxxxxxx" />
                @error('phone')
                    <p class="text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="space-y-2">
            <label class="text-sm font-semibold text-gray-700 dark:text-gray-200">Alamat lengkap</label>
            <textarea wire:model.defer="address_line" rows="3" class="w-full rounded-xl border-2 border-gray-200 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100" placeholder="Nama jalan, nomor rumah, detail patokan"></textarea>
            @error('address_line')
                <p class="text-sm font-semibold text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-wrap items-center gap-4">
            <button type="submit" class="inline-flex items-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Simpan alamat</button>

            @if ($hasAddress && $lastUpdatedHuman)
                <p class="text-sm text-gray-500 dark:text-gray-400">Terakhir diperbarui {{ $lastUpdatedHuman }}.</p>
            @endif
        </div>
    </form>
</div>
