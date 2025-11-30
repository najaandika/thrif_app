<div class="py-12">
    <div>
        <div class="flex flex-col lg:flex-row gap-6">
            <x-sidebar />

            <!-- Main Content -->
            <div class="flex-1 min-w-0 px-4 sm:px-6 lg:px-8">
                <!-- Page Header -->
                <div class="mb-6">
                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-2">
                        <a href="{{ route('products.index') }}" class="hover:text-gray-700 dark:hover:text-gray-300 transition-colors">Products</a>
                        <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <span class="text-gray-900 dark:text-gray-100 font-medium">Create New</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-gray-900 dark:bg-gray-700 rounded-xl shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Create New Product</h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Add a new product to your inventory.</p>
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
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-0.5">Fill in all the details for your new product</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6">
                    <form wire:submit="save" id="productForm">
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
                                    <input wire:model="price" name="price" autocomplete="off" type="number" step="0.01" id="price" class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-all" placeholder="0">
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

                            <!-- Variants (Size & Stock) -->
                            <div class="bg-gray-50 dark:bg-gray-700/30 p-4 rounded-xl border border-gray-200 dark:border-gray-600">
                                <div class="flex items-center justify-between mb-3">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Product Variants (Size & Stock)</label>
                                    <button wire:click.prevent="addVariant" class="text-sm text-gray-900 hover:text-gray-700 dark:text-gray-300 dark:hover:text-gray-100 font-medium flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                        Add Variant
                                    </button>
                                </div>
                                
                                <div class="space-y-3">
                                    @foreach ($variants as $index => $variant)
                                        <div class="flex gap-4 items-start">
                                            <div class="flex-1">
                                                <input wire:model="variants.{{ $index }}.size" type="text" placeholder="Input Size" class="w-full px-4 py-2 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-all placeholder:text-gray-400 dark:placeholder:text-gray-500">
                                                @error('variants.'.$index.'.size') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="w-32">
                                                <input wire:model="variants.{{ $index }}.stock" type="number" min="0" placeholder="Stock" class="w-full px-4 py-2 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-all placeholder:text-gray-400 dark:placeholder:text-gray-500">
                                                @error('variants.'.$index.'.stock') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                                            </div>
                                            @if(count($variants) > 1)
                                                <button wire:click.prevent="removeVariant({{ $index }})" class="mt-2 text-gray-400 hover:text-red-500 transition-colors">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Image -->
                            <div>
                                <label for="image" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Product Image</label>
                                <input wire:model="image" name="image" type="file" id="image" accept="image/*" class="block w-full text-sm text-gray-500 dark:text-gray-400
                                    file:mr-4 file:py-2.5 file:px-4
                                    file:rounded-lg file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-gray-100 file:text-gray-900
                                    hover:file:bg-gray-200
                                    dark:file:bg-gray-700 dark:file:text-gray-200
                                    cursor-pointer">
                                @error('image') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                                
                                @if ($imagePreviewUrl)
                                    <div class="mt-3">
                                        <img src="{{ $imagePreviewUrl }}" alt="Preview" class="h-40 w-40 object-cover rounded-lg border-2 border-gray-200 dark:border-gray-600">
                                    </div>
                                @elseif($image)
                                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Preview tidak tersedia untuk file ini, tetapi file tetap bisa diunggah saat disimpan.</p>
                                @endif
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
                            Create Product
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>