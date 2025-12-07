<form method="POST" action="{{ route('landing.products.order', $product) }}" class="space-y-6" id="checkout-form">
    <div class="space-y-1">
        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Metode Pembayaran</label>
        <select name="payment_method" class="{{ $inputClass }}" required>
            <option value="cash">Cash On Delivery</option>
            <option value="transfer">Transfer</option>
            <option value="midtrans">Midtrans</option>
        </select>
    </div>
    @csrf

    <div class="space-y-3">
        <div class="flex items-center gap-2">
            <div class="h-8 w-8 rounded-xl bg-slate-900 text-slate-100 dark:bg-slate-800 dark:text-slate-100 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <p class="{{ $labelClass }}">Data Pembeli</p>
        </div>
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Nama penerima</label>
            <input type="text" name="buyer_name" value="{{ $prefill['buyer_name'] }}" class="{{ $inputClass }}" required>
            @error('buyer_name', 'order')
                <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Kontak (WA / IG)</label>
            <input type="text" name="buyer_contact" value="{{ $prefill['buyer_contact'] }}" class="{{ $inputClass }}">
            @error('buyer_contact', 'order')
                <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="space-y-3">
        <div class="flex items-center gap-2">
            <div class="h-8 w-8 rounded-xl bg-gradient-to-br from-emerald-500 to-green-500 flex items-center justify-center text-white">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            <p class="{{ $labelClass }}">Detail Pengiriman</p>
        </div>
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Alamat pengiriman</label>
            <textarea name="shipping_address" rows="3" class="{{ $inputClass }}" placeholder="Kota, detail alamat, atau info COD">{{ $prefill['shipping_address'] }}</textarea>
            @error('shipping_address', 'order')
                <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="space-y-2" x-show="variants.length > 1">
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Pilih Ukuran <span class="text-red-500">*</span></label>
            <div class="flex flex-wrap gap-2">
                <template x-for="variant in variants" :key="variant.size">
                    <button type="button"
                        @click="selectedSize = variant.size; maxStock = variant.stock"
                        :class="selectedSize == variant.size ? 'bg-indigo-600 text-white border-indigo-600' : 'bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 border-gray-300 dark:border-gray-600 hover:border-indigo-500'"
                        :disabled="variant.stock == 0"
                        class="px-4 py-2 border rounded-lg text-sm font-medium transition-all disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-1">
                        <span x-text="variant.size"></span>
                        <span x-show="variant.stock == 0" class="text-[10px] uppercase">(Habis)</span>
                    </button>
                </template>
            </div>
            <input type="hidden" name="size" x-model="selectedSize" required>
            @error('size', 'order')
                <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror
            <p x-show="selectedSize" class="text-xs text-gray-500 dark:text-gray-400" x-transition>Stok tersedia: <span x-text="maxStock" class="font-semibold"></span></p>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div class="space-y-1">
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah beli</label>
                <input type="number" name="quantity" min="1" :max="maxStock" value="{{ $prefilledQuantity }}" class="{{ $inputClass }}" required x-bind:disabled="!selectedSize || maxStock === 0">
                <p class="text-[11px] text-gray-500 dark:text-gray-400" x-text="selectedSize ? 'Maksimum ' + maxStock + ' item tersedia.' : 'Pilih ukuran terlebih dahulu.'"></p>
                @error('quantity', 'order')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="space-y-3">
        @include('landing.components.order-summary', ['product' => $product, 'prefilledQuantity' => $prefilledQuantity])
    </div>

    <div class="flex flex-col sm:flex-row sm:items-center gap-3 pt-1">
        <button type="submit" id="submit-order-btn" aria-live="polite" class="inline-flex items-center justify-center gap-2 flex-1 rounded-2xl bg-gray-800 px-6 py-3.5 text-sm font-semibold text-white shadow-xl shadow-gray-900/40 transition-all duration-300 hover:bg-gray-700 hover:scale-105 hover:shadow-2xl hover:shadow-gray-900/60 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100">
            <svg class="w-5 h-5 submit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <svg class="w-5 h-5 loading-spinner hidden animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="submit-text">Kirim Order</span>
        </button>
        <a href="/" class="inline-flex items-center justify-center gap-2 rounded-2xl border-2 border-gray-200 dark:border-gray-700 px-5 py-3.5 text-sm font-semibold text-gray-700 dark:text-gray-100 transition-all duration-300 hover:bg-gray-50 dark:hover:bg-gray-800 hover:border-gray-300 dark:hover:border-gray-600">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            Batalkan
        </a>
    </div>
</form>
