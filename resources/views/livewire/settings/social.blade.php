{{-- Social Media Tab --}}
<div>
<div class="space-y-6">
    <div>
        <label for="social_instagram" class="form-label">Instagram URL</label>
        <input type="url" id="social_instagram" wire:model="social_instagram" placeholder="https://instagram.com/yourshop" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white text-gray-900 placeholder-gray-500 dark:placeholder-gray-400 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md">
        @error('social_instagram') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="social_facebook" class="form-label">Facebook URL</label>
        <input type="url" id="social_facebook" wire:model="social_facebook" placeholder="https://facebook.com/yourshop" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white text-gray-900 placeholder-gray-500 dark:placeholder-gray-400 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md">
        @error('social_facebook') <span class="form-error">{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="social_tiktok" class="form-label">TikTok URL</label>
        <input type="url" id="social_tiktok" wire:model="social_tiktok" placeholder="https://tiktok.com/@yourshop" class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white text-gray-900 placeholder-gray-500 dark:placeholder-gray-400 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow-md">
        @error('social_tiktok') <span class="form-error">{{ $message }}</span> @enderror
    </div>
</div>
</div>
