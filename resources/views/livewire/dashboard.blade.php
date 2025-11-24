<div class="py-12">
    <div class="flex flex-row gap-6">
        <x-sidebar />
        
        <div class="flex-1 min-w-0 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
        <div class="space-y-6">
                    <!-- Stats & Chart -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Donut chart card -->
                        <div class="lg:col-span-2 bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-lg p-6">
                            <div class="flex flex-col sm:flex-row items-center gap-6">
                                <div class="flex-1 w-full">
                                    <div class="flex items-center justify-between mb-4">
                                        <div>
                                            <p class="text-xs font-semibold tracking-wider text-gray-500 dark:text-gray-400 uppercase">Status Produk</p>
                                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Ringkasan</h3>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-3">
                                        <div class="flex items-center gap-3 p-3 rounded-xl bg-white dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 shadow-sm">
                                            <div class="h-8 w-8 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center flex-shrink-0">
                                                <div class="h-3 w-3 rounded-full bg-emerald-500"></div>
                                            </div>
                                            <div>
                                                <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Available</p>
                                                <p class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ $stats['available_products'] }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-3 p-3 rounded-xl bg-white dark:bg-gray-800/50 border border-gray-200 dark:border-gray-700 shadow-sm">
                                            <div class="h-8 w-8 rounded-full bg-rose-100 dark:bg-rose-900/30 flex items-center justify-center flex-shrink-0">
                                                <div class="h-3 w-3 rounded-full bg-rose-500"></div>
                                            </div>
                                            <div>
                                                <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Sold</p>
                                                <p class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ $stats['sold_products'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-40 h-40 flex-shrink-0 relative">
                                    <canvas id="statusChart"
                                            data-available="{{ $stats['available_products'] }}"
                                            data-sold="{{ $stats['sold_products'] }}"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Total value card -->
                        <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl shadow-lg p-8 text-white">
                            <div class="flex flex-col h-full justify-between">
                                <div>
                                    <p class="text-xs font-semibold tracking-wider uppercase opacity-90">Total Value</p>
                                    <div class="mt-6">
                                        <p class="text-sm font-medium opacity-75">Rp</p>
                                        <p class="mt-1 text-4xl font-bold">{{ number_format($stats['total_value'], 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <div class="mt-6 pt-6 border-t border-white/20">
                                    <p class="text-sm opacity-90">Akumulasi nilai semua produk yang kamu listing.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Recent Products -->
                        <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-lg overflow-hidden">
                            <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-base font-bold text-gray-900 dark:text-gray-100">Recent Products</h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Produk terakhir yang kamu tambahkan</p>
                                    </div>
                                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900/50 transition-colors">
                                        Lihat semua
                                    </a>
                                </div>
                            </div>

                            <div class="p-6 space-y-3">
                                @forelse($recent_products as $product)
                                    <div class="flex items-center gap-4 rounded-xl border-2 border-gray-200 dark:border-gray-700 p-4 hover:border-indigo-300 dark:hover:border-indigo-600 hover:bg-gray-50 dark:hover:bg-gray-800/60 transition-all duration-200">
                                        @if($product->image)
                                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="h-12 w-12 rounded-lg object-cover ring-2 ring-gray-200 dark:ring-gray-700" />
                                        @else
                                            <div class="h-12 w-12 rounded-lg bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 flex items-center justify-center text-gray-400 ring-2 ring-gray-200 dark:ring-gray-700">
                                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif

                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate">{{ $product->name }}</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                        </div>

                                        <div>
                                            @if($product->is_available)
                                                <span class="inline-flex items-center rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-900/50 dark:text-emerald-300 px-3 py-1 text-xs font-semibold">Available</span>
                                            @else
                                                <span class="inline-flex items-center rounded-full bg-rose-100 text-rose-700 dark:bg-rose-900/50 dark:text-rose-300 px-3 py-1 text-xs font-semibold">Sold</span>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="flex flex-col items-center justify-center py-12 text-center">
                                        <div class="h-16 w-16 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center mb-4">
                                            <svg class="h-8 w-8 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                        </div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Belum ada produk</p>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Mulai dengan menambahkan produk pertama</p>
                                        <a href="{{ route('products.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-semibold rounded-xl shadow-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 hover:scale-105">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                            Tambah produk pertama
                                        </a>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-lg overflow-hidden">
                            <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-base font-bold text-gray-900 dark:text-gray-100">Quick Actions</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Aksi yang sering kamu pakai</p>
                            </div>

                            <div class="p-6 space-y-3">
                                <a href="{{ route('products.create') }}" class="flex items-center justify-between rounded-xl border-2 border-gray-200 dark:border-gray-700 p-4 hover:border-indigo-300 dark:hover:border-indigo-600 hover:bg-gray-50 dark:hover:bg-gray-800/60 transition-all duration-200 group">
                                    <div class="flex items-center gap-4">
                                        <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white shadow-lg group-hover:scale-110 transition-transform duration-200">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">Tambah produk baru</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Tambah barang baru untuk dijual</p>
                                        </div>
                                    </div>
                                    <span class="text-xs font-mono text-gray-400 dark:text-gray-500 bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded">⌘N</span>
                                </a>

                                <a href="{{ route('products.index') }}" class="flex items-center justify-between rounded-xl border-2 border-gray-200 dark:border-gray-700 p-4 hover:border-sky-300 dark:hover:border-sky-600 hover:bg-gray-50 dark:hover:bg-gray-800/60 transition-all duration-200 group">
                                    <div class="flex items-center gap-4">
                                        <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-sky-500 to-blue-600 flex items-center justify-center text-white shadow-lg group-hover:scale-110 transition-transform duration-200">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">Kelola produk</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Lihat dan edit semua listing</p>
                                        </div>
                                    </div>
                                    <span class="text-xs font-mono text-gray-400 dark:text-gray-500 bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded">⌘P</span>
                                </a>

                                <div class="flex flex-col justify-between rounded-xl border-2 border-gray-200 dark:border-gray-700 p-4 hover:border-indigo-300 dark:hover:border-indigo-600 hover:bg-gray-50 dark:hover:bg-gray-800/60 transition-all duration-200 group cursor-pointer">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center gap-3">
                                            <div class="h-10 w-10 rounded-lg bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">Weekly Sales</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Last 7 days performance</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-bold text-gray-900 dark:text-gray-100">Rp {{ number_format($chart_data->sum(), 0, ',', '.') }}</p>
                                        </div>
                                    </div>

                                    <!-- Mini Bar Chart -->
                                    <div class="flex items-end justify-between h-12 gap-1 pt-2">
                                        @php $max = $chart_data->max() ?: 1; @endphp
                                        @foreach($chart_data as $value)
                                            <div class="w-full bg-indigo-100 dark:bg-indigo-900/30 rounded-t-sm relative group/bar">
                                                <div style="height: {{ ($value / $max) * 100 }}%" class="bg-indigo-500 rounded-t-sm transition-all duration-500"></div>
                                                <!-- Tooltip -->
                                                <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-1 hidden group-hover/bar:block z-10">
                                                    <div class="bg-gray-900 text-white text-xs rounded py-1 px-2 whitespace-nowrap">
                                                        Rp {{ number_format($value, 0, ',', '.') }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
