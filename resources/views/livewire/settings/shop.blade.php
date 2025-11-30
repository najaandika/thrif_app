{{-- Informasi Toko Tab --}}
<div>
<div class="space-y-6">
    <!-- Shop Logo -->
    <div>
        <label for="new_logo" class="form-label">Logo Toko</label>
        @if($shop_logo)
            <div class="logo-preview">
                <img src="{{ Storage::url($shop_logo) }}" alt="Shop Logo" class="logo-image">
                <button type="button" wire:click="removeLogo" class="remove-logo-btn">Hapus Logo</button>
            </div>
        @endif
        <input id="new_logo" name="new_logo" type="file" wire:model="new_logo" accept="image/*" class="w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-900 hover:file:bg-gray-200 dark:file:bg-gray-700 dark:file:text-gray-200 cursor-pointer">
        <p class="form-hint">PNG, JPG, GIF up to 2MB</p>
        @error('new_logo') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <!-- Shop Name -->
    <div>
        <label for="shop_name" class="form-label">Nama Toko <span class="text-red-500">*</span></label>
        <input type="text" id="shop_name" wire:model="shop_name" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white text-gray-900 placeholder-gray-500 dark:placeholder-gray-400 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md">
        @error('shop_name') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <!-- Shop Tagline -->
    <div>
        <label for="shop_tagline" class="form-label">Tagline</label>
        <input type="text" id="shop_tagline" wire:model="shop_tagline" placeholder="Your trusted thrift store" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white text-gray-900 placeholder-gray-500 dark:placeholder-gray-400 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md">
        @error('shop_tagline') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <!-- Shop Email -->
    <div>
        <label for="shop_email" class="form-label">Email Toko</label>
        <input type="email" id="shop_email" wire:model="shop_email" placeholder="contact@yourstore.com" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white text-gray-900 placeholder-gray-500 dark:placeholder-gray-400 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md">
        @error('shop_email') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <!-- Shop Phone -->
    <div>
        <label for="shop_phone" class="form-label">Nomor Telepon</label>
        <input type="text" id="shop_phone" wire:model="shop_phone" placeholder="+62 812 3456 7890" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white text-gray-900 placeholder-gray-500 dark:placeholder-gray-400 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md">
        @error('shop_phone') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <!-- Shop Address -->
    <div>
        <label for="shop_address" class="form-label">Alamat Toko</label>
        <textarea id="shop_address" wire:model="shop_address" rows="3" placeholder="Jl. Contoh No. 123, Jakarta" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white text-gray-900 placeholder-gray-500 dark:placeholder-gray-400 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md"></textarea>
        @error('shop_address') <span class="form-error">{{ $message }}</span> @enderror
    </div>
</div>
</div>