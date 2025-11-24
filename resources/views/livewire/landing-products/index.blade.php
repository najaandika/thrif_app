<div class="max-w-7xl mx-auto px-6 py-8">

    <form action="{{ route('landing.products.index') }}" method="get" class="mb-8 flex items-center justify-center gap-2">
        <a href="{{ route('landing.home') }}" class="p-2.5 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-gray-800 rounded-lg transition-colors" aria-label="Kembali">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
        </a>
        <div class="relative w-full max-w-lg">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
        </div>
        <button type="submit" class="inline-flex items-center justify-center px-4 py-2.5 rounded-lg bg-emerald-600 text-white font-semibold shadow-sm hover:bg-emerald-700 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
    </form>
    @if($products->count())
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 sm:gap-6">
            @foreach($products as $product)
                <div class="relative border rounded-xl bg-white dark:bg-gray-900 shadow overflow-hidden transition-all duration-200 hover:shadow-lg hover:-translate-y-1 group">
                    <a href="{{ route('landing.products.checkout', $product) }}" class="block">
                        <div class="relative">
                            <img src="{{ $product->image ? Storage::url($product->image) : 'https://via.placeholder.com/200x150?text=No+Image' }}" alt="{{ $product->name }}" class="w-full h-[140px] object-cover bg-gray-100 dark:bg-gray-800">
                            @if($product->stock === 0)
                                <span class="absolute top-1.5 left-1.5 bg-rose-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded">Out of Stock</span>
                            @elseif($product->created_at && $product->created_at->gt(now()->subDays(7)))
                                <span class="absolute top-1.5 left-1.5 bg-indigo-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded">New</span>
                            @endif
                        </div>
                        <div class="p-3">
                            <div class="font-bold text-sm text-gray-900 dark:text-gray-100 mb-1 line-clamp-1 group-hover:text-emerald-600 transition-colors">{{ $product->name }}</div>
                            <div class="text-emerald-600 dark:text-emerald-400 font-bold text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="mt-8 flex justify-center">{{ $products->links() }}</div>
    @else
        <div class="text-gray-500 dark:text-gray-400 py-8 text-center">Tidak ada produk ditemukan untuk "{{ request('search') }}"</div>
    @endif
</div>
