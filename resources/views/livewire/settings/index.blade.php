<div class="py-12">
    @if (session()->has('message'))
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
            <div class="p-4 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900 dark:to-emerald-900 text-green-700 dark:text-green-200 rounded-xl border-l-4 border-green-500 shadow-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-semibold">{{ session('message') }}</span>
                </div>
            </div>
        </div>
    @endif

    <div class="flex flex-row gap-4">
        <x-sidebar />

        <!-- Main Content -->
        <div class="flex-1 min-w-0 px-2 sm:px-6 lg:px-8 flex justify-center">
            <div class="w-full max-w-3xl">
                <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden">
                    <div class="p-4 sm:p-8">
                        <div class="mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Settings</h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Kelola informasi toko dan branding.</p>
                        </div>

                        <!-- Tab Navigation -->
                        <div class="border-b border-gray-200 dark:border-gray-700 mb-6">
                            <nav class="-mb-px flex space-x-4 overflow-x-auto" aria-label="Tabs">
                                <button 
                                    type="button"
                                    wire:click="$set('activeTab', 'shop')"
                                    class="whitespace-nowrap py-3 px-4 border-b-2 font-medium text-sm transition-colors {{ $activeTab === 'shop' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300' }}">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                        </svg>
                                        Informasi Toko
                                    </div>
                                </button>
                                <button 
                                    type="button"
                                    wire:click="$set('activeTab', 'social')"
                                    class="whitespace-nowrap py-3 px-4 border-b-2 font-medium text-sm transition-colors {{ $activeTab === 'social' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300' }}">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                                        </svg>
                                        Social Media
                                    </div>
                                </button>
                                <button 
                                    type="button"
                                    wire:click="$set('activeTab', 'operational')"
                                    class="whitespace-nowrap py-3 px-4 border-b-2 font-medium text-sm transition-colors {{ $activeTab === 'operational' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300' }}">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Operasional
                                    </div>
                                </button>
                                <button 
                                    type="button"
                                    wire:click="$set('activeTab', 'about')"
                                    class="whitespace-nowrap py-3 px-4 border-b-2 font-medium text-sm transition-colors {{ $activeTab === 'about' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300' }}">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Tentang Kami
                                    </div>
                                </button>
                            </nav>
                        </div>

                        <form wire:submit="save" class="space-y-6">
                            <!-- Tab: Informasi Toko -->
                            <div class="{{ $activeTab === 'shop' ? 'block' : 'hidden' }} space-y-6">
                            <!-- Shop Logo -->
                            <div>
                                <label for="new_logo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Logo Toko
                                </label>
                                
                                @if($shop_logo)
                                    <div class="mb-3 flex items-center gap-4">
                                        <img src="{{ Storage::url($shop_logo) }}" alt="Shop Logo" class="h-20 w-20 rounded-lg object-cover border-2 border-gray-200 dark:border-gray-700">
                                        <button type="button" wire:click="removeLogo" class="text-sm text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 font-medium">
                                            Hapus Logo
                                        </button>
                                    </div>
                                @endif
                                <input id="new_logo" name="new_logo" type="file" wire:model="new_logo" accept="image/*" class="block w-full text-sm text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 focus:outline-none">
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF up to 2MB</p>
                                @error('new_logo') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                            </div>

                            <!-- Shop Name -->
                            <div>
                                <label for="shop_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Nama Toko <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="shop_name" wire:model="shop_name" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                @error('shop_name') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                            </div>

                            <!-- Shop Tagline -->
                            <div>
                                <label for="shop_tagline" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Tagline
                                </label>
                                <input type="text" id="shop_tagline" wire:model="shop_tagline" placeholder="Your trusted thrift store" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                @error('shop_tagline') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                            </div>

                            <!-- Shop Email -->
                            <div>
                                <label for="shop_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Email Toko
                                </label>
                                <input type="email" id="shop_email" wire:model="shop_email" placeholder="contact@yourstore.com" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                @error('shop_email') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                            </div>

                            <!-- Shop Phone -->
                            <div>
                                <label for="shop_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Nomor Telepon
                                </label>
                                <input type="text" id="shop_phone" wire:model="shop_phone" placeholder="+62 812 3456 7890" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                @error('shop_phone') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                            </div>

                            <!-- Shop Address -->
                            <div>
                                <label for="shop_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Alamat Toko
                                </label>
                                <textarea id="shop_address" wire:model="shop_address" rows="3" placeholder="Jl. Contoh No. 123, Jakarta" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"></textarea>
                                @error('shop_address') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                            </div>
                            </div>

                            <!-- Tab: Social Media -->
                            <div class="{{ $activeTab === 'social' ? 'block' : 'hidden' }} space-y-6">
                            <!-- Instagram -->
                            <div>
                                <label for="social_instagram" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Instagram URL
                                </label>
                                <input type="url" id="social_instagram" wire:model="social_instagram" placeholder="https://instagram.com/yourshop" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                @error('social_instagram') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                            </div>

                            <!-- Facebook -->
                            <div>
                                <label for="social_facebook" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Facebook URL
                                </label>
                                <input type="url" id="social_facebook" wire:model="social_facebook" placeholder="https://facebook.com/yourshop" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                @error('social_facebook') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                            </div>

                            <!-- TikTok -->
                            <div>
                                <label for="social_tiktok" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    TikTok URL
                                </label>
                                <input type="url" id="social_tiktok" wire:model="social_tiktok" placeholder="https://tiktok.com/@yourshop" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                @error('social_tiktok') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                            </div>
                            </div>

                            <!-- Tab: Operasional -->
                            <div class="{{ $activeTab === 'operational' ? 'block' : 'hidden' }} space-y-6">
                            <!-- Operating Hours -->
                            <div>
                                <label for="operating_hours" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Jam Operasional
                                </label>
                                <input type="text" id="operating_hours" wire:model="operating_hours" placeholder="Setiap Hari, 09:00 - 21:00" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                @error('operating_hours') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                            </div>

                            <!-- Payment Methods -->
                            <div>
                                <label for="payment_methods" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Metode Pembayaran
                                </label>
                                <input type="text" id="payment_methods" wire:model="payment_methods" placeholder="Transfer Bank & E-Wallet" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                @error('payment_methods') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                            </div>
                            </div>

                            <!-- Tab: Tentang Kami -->
                            <div class="{{ $activeTab === 'about' ? 'block' : 'hidden' }} space-y-6">
                            <!-- About Title -->
                            <div>
                                <label for="about_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Judul Section
                                </label>
                                <input type="text" id="about_title" wire:model="about_title" placeholder="Tentang Kami" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                @error('about_title') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                            </div>

                            <!-- About Description -->
                            <div>
                                <label for="about_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Deskripsi
                                </label>
                                <textarea id="about_description" wire:model="about_description" rows="4" placeholder="Ceritakan tentang toko Anda, visi, dan value proposition..." class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"></textarea>
                                @error('about_description') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                            </div>

                            <!-- About Features -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="about_feature_1" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Fitur 1
                                    </label>
                                    <input type="text" id="about_feature_1" wire:model="about_feature_1" placeholder="Pre-loved Quality" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    @error('about_feature_1') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="about_feature_2" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Fitur 2
                                    </label>
                                    <input type="text" id="about_feature_2" wire:model="about_feature_2" placeholder="Stok Real-time" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    @error('about_feature_2') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="about_feature_3" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Fitur 3
                                    </label>
                                    <input type="text" id="about_feature_3" wire:model="about_feature_3" placeholder="Terpercaya" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    @error('about_feature_3') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                                <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-xl font-semibold text-sm text-white uppercase tracking-wider hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
