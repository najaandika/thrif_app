{{-- Operasional Tab --}}
<div>
<div class="space-y-6">
    <div>
        <label for="operating_hours" class="form-label">Jam Operasional</label>
        <input type="text" id="operating_hours" wire:model="operating_hours" placeholder="Setiap Hari, 09:00 - 21:00" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white text-gray-900 placeholder-gray-500 dark:placeholder-gray-400 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md">
        @error('operating_hours') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="payment_methods" class="form-label">Metode Pembayaran</label>
        <input type="text" id="payment_methods" wire:model="payment_methods" placeholder="Transfer Bank & E-Wallet" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white text-gray-900 placeholder-gray-500 dark:placeholder-gray-400 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md">
        @error('payment_methods') <span class="form-error">{{ $message }}</span> @enderror
    </div>
</div>
</div>
