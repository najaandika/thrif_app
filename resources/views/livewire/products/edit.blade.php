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
                        <div class="p-3 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-lg">
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

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-2xl border-l-4 border-indigo-500">
                    <!-- Card Header -->
                    <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-indigo-50/50 to-purple-50/50 dark:from-indigo-900/20 dark:to-purple-900/20">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                        <svg class="w-4 h-4 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                        <span>Product Name <span class="text-red-500">*</span></span>
                                    </div>
                                </label>
                                <input wire:model="name" name="name" autocomplete="name" type="text" id="name" class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                                @error('name') <span class="text-xs text-red-600 dark:text-red-400 mt-2 flex items-center"><svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>{{ $message }}</span> @enderror
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Description</label>
                                <textarea wire:model="description" name="description" autocomplete="off" id="description" rows="4" class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"></textarea>
                                @error('description') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Price -->
                                <div>
                                    <label for="price" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Price (Rp) <span class="text-red-500">*</span></label>
                                    <input wire:model="price" name="price" autocomplete="off" type="number" step="0.01" id="price" class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                                    @error('price') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                                </div>

                                <!-- Stock -->
                                <div>
                                    <label for="stock" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Stock <span class="text-red-500">*</span></label>
                                    <input wire:model="stock" name="stock" autocomplete="off" type="number" min="0" id="stock" class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                                    @error('stock') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Condition -->
                                <div>
                                    <label for="condition" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Condition <span class="text-red-500">*</span></label>
                                    <select wire:model="condition" name="condition" id="condition" class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                                        <option value="new">New</option>
                                        <option value="like-new">Like New</option>
                                        <option value="good">Good</option>
                                        <option value="fair">Fair</option>
                                        <option value="poor">Poor</option>
                                    </select>
                                    @error('condition') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                                </div>

                                <!-- Category -->
                                <div>
                                    <label for="category" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Category</label>
                                    <select wire:model="category" name="category" id="category" class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                                        <option value="">Select a category</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
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
                                <label for="image" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ $product->image ? 'Replace Image' : 'Product Image' }}</label>
                                <input wire:model="image" name="image" type="file" id="image" accept="image/*" class="block w-full text-sm text-gray-500 dark:text-gray-400
                                    file:mr-4 file:py-2.5 file:px-4
                                    file:rounded-lg file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-indigo-50 file:text-indigo-700
                                    hover:file:bg-indigo-100
                                    dark:file:bg-indigo-900 dark:file:text-indigo-200
                                    cursor-pointer">
                                @error('image') <span class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</span> @enderror
                                
                                @if ($image)
                                    <div class="mt-3">
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">New image preview:</p>
                                        <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="h-40 w-40 object-cover rounded-lg border-2 border-gray-200 dark:border-gray-600">
                                    </div>
                                @endif
                            </div>

                            <!-- Availability -->
                            <div>
                                <label class="flex items-center">
                                    <input wire:model="is_available" name="is_available" type="checkbox" class="rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500">
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
                        <button type="submit" form="productForm" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider hover:from-indigo-700 hover:to-purple-700 transition-all shadow-lg hover:shadow-xl">
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