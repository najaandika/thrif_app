<!-- Left Column: Search + Products -->
<div class="flex-1 space-y-6">
    <!-- Pencarian Produk -->
    <div class="bg-white dark:bg-gray-800/50 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-sm">
        <label for="product_selector_search" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Cari Produk</label>
        <div class="flex gap-3 items-center">
            <div class="flex-1">
                <livewire:product-selector />
            </div>
            <button wire:click="toggleBrowse" type="button" class="inline-flex items-center px-4 py-2.5 border-2 border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-800 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 shadow-sm hover:shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                </svg>
                Browse
            </button>
        </div>
    </div>

    <!-- Daftar Produk -->
    @if($loadProducts)
        <div class="bg-white dark:bg-gray-800/50 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3">
                @forelse ($products as $product)
                    <button type="button" wire:click="addToCart({{ $product->id }})" class="group relative flex flex-col bg-white dark:bg-gray-800 rounded-xl border-2 border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-lg hover:border-gray-900 dark:hover:border-gray-100 transition-all duration-200 overflow-hidden text-left">
                        <!-- Product Image -->
                        <div class="aspect-square w-full bg-gray-100 dark:bg-gray-700 overflow-hidden">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Card Content -->
                        <div class="p-3 flex flex-col flex-1">
                            <!-- Stock Badge -->
                            <div class="mb-2">
                                <span class="px-2 py-0.5 inline-flex text-xs font-semibold rounded-full {{ $product->stock > 10 ? 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-200' : ($product->stock > 0 ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-200' : 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-200') }}">
                                    {{ $product->stock }}
                                </span>
                            </div>
                            
                            <!-- Product Name -->
                            <h3 class="text-sm font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-black dark:group-hover:text-white transition-colors flex-1">
                                {{ $product->name }}
                            </h3>
                            
                            <!-- Price -->
                            <div class="mt-auto">
                                <p class="text-sm font-bold text-gray-900 dark:text-white whitespace-nowrap">
                                    {{ rupiah($product->price) }}
                                </p>
                            </div>
                        </div>
                        
                        <!-- Hover Effect -->
                        <div class="absolute inset-0 bg-gray-900/0 group-hover:bg-gray-900/5 transition-colors duration-200 pointer-events-none"></div>
                    </button>
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-12 text-gray-400">
                        <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <p>Produk tidak ditemukan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    @endif
</div>
