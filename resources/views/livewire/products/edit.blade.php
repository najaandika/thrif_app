<div class="py-12">
    <div>
        <div class="flex flex-col lg:flex-row gap-6">
            <x-sidebar />

            <!-- Main Content -->
            <div class="flex-1 min-w-0 px-4 sm:px-6 lg:px-8">
                <!-- Page Header -->
                <div class="mb-6">
                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-2">
                        <a href="{{ route('products.index') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Products</a>
                        <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <span class="text-gray-900 dark:text-gray-100 font-medium">Edit</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-gray-900 dark:bg-gray-700 rounded-xl shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Edit Product</h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Update product information.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-2xl border-l-4 border-gray-900 dark:border-gray-600">
                    <!-- Card Header -->
                    <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                                <svg class="w-5 h-5 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Product Information</h3>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-0.5">Modify the details for this product</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6">
                    <form wire:submit="update" id="productForm">
                        <div class="space-y-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                        <span>Product Name <span class="text-red-500">*</span></span>
                                    </div>
                                </label>
                                <input wire:model="name" name="name" autocomplete="name" type="text" id="name" class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-all">
                                @error('name') <span class="text-xs text-red-600 dark:text-red-400 mt-2 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</span> @enderror
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Description</label>
                                <textarea wire:model="description" name="description" autocomplete="off" id="description" rows="4" class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-all"></textarea>
                                @error('description') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Price -->
                                <div>
                                    <label for="price" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Price (Rp) <span class="text-red-500">*</span></label>
                                    <div x-data="currencyInput('{{ $price ?? 0 }}', 'price')">
                                        <input 
                                            type="text" 
                                            id="price" 
                                            name="price"
                                            :value="displayValue" 
                                            @input="update"
                                            class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-all"
                                            placeholder="0"
                                        >
                                    </div>
                                    @error('price') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                                </div>

                                <!-- Condition -->
                                <div>
                                    <label for="condition" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Condition <span class="text-red-500">*</span></label>
                                    <select wire:model="condition" name="condition" id="condition" class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-all">
                                        <option value="new">New</option>
                                        <option value="like-new">Like New</option>
                                        <option value="good">Good</option>
                                        <option value="fair">Fair</option>
                                        <option value="poor">Poor</option>
                                    </select>
                                    @error('condition') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Category -->
                            <div>
                                <label for="category" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Category</label>
                                <select wire:model="category" name="category" id="category" class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-all">
                                    <option value="">Select a category</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @error('category') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- Size & Stock (Single) -->
                            <div class="bg-gray-50 dark:bg-gray-700/30 p-4 rounded-xl border border-gray-200 dark:border-gray-600">
                                <label for="size" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Size</label>
                                <div>
                                    <input wire:model="size" name="size" id="size" type="text" placeholder="Size (e.g. S, M, 42)" class="w-full px-4 py-2 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-all placeholder:text-gray-400 dark:placeholder:text-gray-500">
                                    @error('size') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Discount Section -->
                            <div class="bg-gradient-to-r from-red-50 to-orange-50 dark:from-red-900/20 dark:to-orange-900/20 p-4 rounded-xl border border-red-200 dark:border-red-800">
                                <div class="flex items-center gap-2 mb-4">
                                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Diskon (Opsional)</label>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label for="discount_percentage" class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Persentase Diskon</label>
                                        <div class="relative">
                                            <input wire:model="discount_percentage" name="discount_percentage" type="number" id="discount_percentage" min="0" max="100" step="1" 
                                                class="w-full px-4 py-2 pr-8 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all" 
                                                placeholder="0">
                                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 font-semibold">%</span>
                                        </div>
                                        @error('discount_percentage') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label for="discount_start" class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Mulai Diskon</label>
                                        <div x-data x-init="flatpickr($refs.startPicker, { enableTime: true, dateFormat: 'Y-m-d H:i', time_24hr: true, disableMobile: true })">
                                            <input wire:model="discount_start" name="discount_start" x-ref="startPicker" type="text" id="discount_start" 
                                                class="w-full px-4 py-2 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all placeholder-gray-400"
                                                placeholder="Pilih Tanggal...">
                                        </div>
                                        @error('discount_start') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label for="discount_end" class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Berakhir Diskon</label>
                                        <div x-data x-init="flatpickr($refs.endPicker, { enableTime: true, dateFormat: 'Y-m-d H:i', time_24hr: true, disableMobile: true })">
                                            <input wire:model="discount_end" name="discount_end" x-ref="endPicker" type="text" id="discount_end" 
                                                class="w-full px-4 py-2 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all placeholder-gray-400"
                                                placeholder="Pilih Tanggal...">
                                        </div>
                                        @error('discount_end') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Kosongkan tanggal untuk diskon tanpa batas waktu.</p>
                            </div>
                            </div>

                            <!-- Current Image -->
                            @if ($product->image)
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Current Image</label>
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="h-40 w-40 object-cover rounded-lg border-2 border-gray-200 dark:border-gray-600">
                                </div>
                            @endif

                            <!-- New Image -->
                            <div>
                                <label for="image" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ $product->image ? 'Replace Main Image' : 'Main Product Image' }}</label>
                                <input wire:model="image" name="image" type="file" id="image" accept="image/*" class="block w-full text-sm text-gray-500 dark:text-gray-400
                                    file:mr-4 file:py-2.5 file:px-4
                                    file:rounded-lg file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-gray-100 file:text-gray-900
                                    hover:file:bg-gray-200
                                    dark:file:bg-gray-700 dark:file:text-gray-200
                                    cursor-pointer">
                                @error('image') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                                
                                @if ($image)
                                    <div class="mt-3">
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">New main image preview:</p>
                                        <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="h-40 w-40 object-cover rounded-lg border-2 border-gray-200 dark:border-gray-600">
                                    </div>
                                @endif
                            </div>

                            <!-- Additional Images Section (Unified Gallery) -->
                            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">Additional Images (Optional)</label>

                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                                    <!-- 1. Existing Additional Images -->
                                    @foreach($product->images as $img)
                                        @if(in_array($img->id, $imagesToDelete)) @continue @endif
                                        <div class="relative group aspect-square">
                                            <img src="{{ Storage::url($img->image_path) }}" class="h-full w-full object-cover rounded-xl border border-gray-200 dark:border-gray-600">
                                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center">
                                                <button type="button" wire:click="deleteExistingImage({{ $img->id }})" 
                                                    class="p-2 bg-red-500 text-white rounded-full hover:bg-red-600 transition shadow-sm"
                                                    title="Delete Image">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach

                                    <!-- 2. New Images Preview -->
                                    @foreach ($additionalImagePreviews as $index => $preview)
                                        <div class="relative group aspect-square">
                                            <img src="{{ $preview }}" class="h-full w-full object-cover rounded-xl border-2 border-indigo-500 dark:border-indigo-400">
                                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center">
                                                <button type="button" wire:click="removeNewAdditionalImage({{ $index }})" 
                                                    class="p-2 bg-red-500 text-white rounded-full hover:bg-red-600 transition shadow-sm"
                                                    title="Remove Upload">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach

                                    <!-- 3. Add Image Button (Hidden Input Trigger) -->
                                    <div class="aspect-square">
                                        <label for="additionalImages-{{ $uploadIteration }}" class="flex flex-col items-center justify-center h-full w-full border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors group">
                                            <div class="p-3 rounded-full bg-gray-100 dark:bg-gray-700 group-hover:bg-indigo-50 dark:group-hover:bg-indigo-900/30 transition-colors">
                                                <svg class="w-6 h-6 text-gray-400 dark:text-gray-500 group-hover:text-indigo-500 dark:group-hover:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                </svg>
                                            </div>
                                            <span class="mt-2 text-xs font-medium text-gray-500 dark:text-gray-400 group-hover:text-indigo-600 dark:group-hover:text-indigo-400">Add Image</span>
                                            <input wire:model="newAdditionalImages" name="newAdditionalImages[]" type="file" id="additionalImages-{{ $uploadIteration }}" multiple accept="image/*" class="hidden">
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    @error('additionalImages.*') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                                    @error('newAdditionalImages.*') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Availability -->
                            <div>
                                <label for="is_available" class="flex items-center cursor-pointer">
                                    <input wire:model="is_available" name="is_available" id="is_available" type="checkbox" class="rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-gray-900 shadow-sm focus:ring-gray-500">
                                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Product is available for sale</span>
                                </label>
                                @error('is_available') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </form>
                    </div>

                    <!-- Card Footer -->
                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-200 dark:border-gray-700 flex items-center justify-end gap-3">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-5 py-2.5 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg font-medium text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">
                            Cancel
                        </a>
                        <button type="submit" form="productForm" class="inline-flex items-center px-5 py-2.5 bg-gray-900 dark:bg-gray-700 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider hover:bg-gray-800 dark:hover:bg-gray-600 transition-all shadow-lg hover:shadow-xl">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update Product
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>