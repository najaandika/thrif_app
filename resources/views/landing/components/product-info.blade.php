<section class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-3xl p-6 space-y-5">
    <p class="{{ $labelClass }}">Produk</p>
    <div class="space-y-4">
        <div class="rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-800">
            @if ($product->image)
                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-44 object-cover">
            @else
                <div class="w-full h-44 bg-gradient-to-br from-slate-200 via-slate-100 to-slate-300 dark:from-slate-800 dark:via-slate-700 dark:to-slate-900 flex items-center justify-center text-xs text-gray-500 dark:text-gray-300">
                    Foto produk menyusul
                </div>
            @endif
        </div>
        <div class="space-y-2">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 leading-tight">{{ $product->name }}</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Kategori: {{ $product->category ?? 'Tanpa kategori' }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">Kondisi: {{ $product->condition_label }}</p>
            @if ($product->sizes->count() === 1)
                <p class="text-sm text-gray-500 dark:text-gray-400">Ukuran: <span class="font-semibold text-gray-700 dark:text-gray-200">{{ $product->sizes->first()->size }}</span></p>
            @endif
            @if ($product->description)
                <div class="pt-2 border-t border-gray-100 dark:border-gray-800">
                    <p class="text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Deskripsi:</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed whitespace-pre-line">{{ strip_tags($product->description) }}</p>
                </div>
            @endif
            <p class="text-3xl font-bold text-green-600 pt-2">{{ rupiah($product->price) }}</p>
        </div>
    </div>
    <div class="rounded-2xl bg-gray-50 dark:bg-gray-800/70 p-4 text-xs text-gray-600 dark:text-gray-300 space-y-1">
        <p>Stok tersedia: <span class="font-semibold">{{ $product->sizes->isNotEmpty() ? $product->total_stock : $product->stock }}</span></p>
        <p>Status: <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $product->is_available ? 'Ready to ship' : 'Sold Out' }}</span></p>
    </div>
    <div class="rounded-2xl border border-dashed border-gray-300 dark:border-gray-700 p-4 text-xs text-gray-500 dark:text-gray-400">
        Kamu bisa review kembali order ini setelah submit. Admin akan menghubungi lewat kontak yang kamu isi.
    </div>
</section>
