{{-- Tentang Kami Tab --}}
<div>
<div class="space-y-6">
    <div>
        <label for="about_title" class="form-label">Judul Section</label>
        <input type="text" id="about_title" wire:model="about_title" placeholder="Tentang Kami" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white text-gray-900 placeholder-gray-500 dark:placeholder-gray-400 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md">
        @error('about_title') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="about_description" class="form-label">Deskripsi</label>
        <textarea id="about_description" wire:model="about_description" rows="4" placeholder="Ceritakan tentang toko Anda, visi, dan value proposition..." class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white text-gray-900 placeholder-gray-500 dark:placeholder-gray-400 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md"></textarea>
        @error('about_description') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div class="feature-grid grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label for="about_feature_1" class="form-label">Fitur 1</label>
            <input type="text" id="about_feature_1" wire:model="about_feature_1" placeholder="Pre-loved Quality" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white text-gray-900 placeholder-gray-500 dark:placeholder-gray-400 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md">
            @error('about_feature_1') <span class="form-error">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="about_feature_2" class="form-label">Fitur 2</label>
            <input type="text" id="about_feature_2" wire:model="about_feature_2" placeholder="Stok Real-time" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white text-gray-900 placeholder-gray-500 dark:placeholder-gray-400 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md">
            @error('about_feature_2') <span class="form-error">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="about_feature_3" class="form-label">Fitur 3</label>
            <input type="text" id="about_feature_3" wire:model="about_feature_3" placeholder="Terpercaya" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white text-gray-900 placeholder-gray-500 dark:placeholder-gray-400 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md">
            @error('about_feature_3') <span class="form-error">{{ $message }}</span> @enderror
        </div>
    </div>
</div>
</div>