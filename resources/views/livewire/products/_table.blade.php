@php
    $statusBadge = fn ($product) => $product->is_available
        ? 'border-emerald-200 bg-emerald-50 text-emerald-700'
        : 'border-rose-200 bg-rose-50 text-rose-700';

    $conditionTone = fn ($product) => match ($product->condition) {
        'new' => 'border-indigo-200 bg-indigo-50 text-indigo-700',
        'like-new', 'like_new' => 'border-blue-200 bg-blue-50 text-blue-700',
        'good' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
        'fair' => 'border-amber-200 bg-amber-50 text-amber-700',
        'poor', 'defect' => 'border-rose-200 bg-rose-50 text-rose-700',
        default => 'border-slate-200 bg-slate-50 text-slate-600',
    };
@endphp

<div class="hidden overflow-hidden rounded-[1.25rem] border border-slate-200 lg:block">
    <table class="w-full divide-y divide-slate-200">
        <thead class="bg-slate-50/80">
            <tr>
                <th class="px-5 py-4 text-left text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400">Produk</th>
                <th class="px-5 py-4 text-left text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400">Harga</th>
                <th class="px-5 py-4 text-left text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400">Kategori</th>
                <th class="px-5 py-4 text-left text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400">Kondisi</th>
                <th class="px-5 py-4 text-left text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400">Status</th>
                <th class="px-5 py-4 text-right text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200 bg-white">
            @forelse ($products as $product)
                <tr class="transition hover:bg-slate-50/80">
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            @if ($product->image)
                                <img src="{{ media_url($product->image) }}" alt="{{ $product->name }}" class="h-16 w-16 rounded-2xl object-cover ring-1 ring-slate-200">
                            @else
                                <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-slate-400 ring-1 ring-slate-200">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 0 1 2.828 0L16 16m-2-2 1.586-1.586a2 2 0 0 1 2.828 0L20 14m-6-6h.01M6 20h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Z" />
                                    </svg>
                                </div>
                            @endif
                            <div class="min-w-0">
                                <p class="truncate text-sm font-black text-slate-950">{{ $product->name }}</p>
                                <p class="mt-1 text-xs font-bold uppercase tracking-[0.16em] text-slate-400">Size {{ $product->size ?: '-' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-4">
                        @if ($product->is_on_sale)
                            <p class="text-xs font-bold text-slate-400 line-through">{{ rupiah($product->price) }}</p>
                            <div class="mt-1 flex items-center gap-2">
                                <p class="text-sm font-black text-red-600">{{ rupiah($product->final_price) }}</p>
                                <span class="rounded-full bg-red-600 px-2 py-0.5 text-[10px] font-black text-white">-{{ $product->discount_percent }}%</span>
                            </div>
                        @else
                            <p class="text-sm font-black text-slate-950">{{ rupiah($product->price) }}</p>
                        @endif
                    </td>
                    <td class="px-5 py-4">
                        <span class="rounded-full border border-slate-200 bg-white px-3 py-1 text-xs font-bold text-slate-600">{{ $product->category ?: '-' }}</span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="rounded-full border px-3 py-1 text-xs font-bold {{ $conditionTone($product) }}">{{ $product->condition_label }}</span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="rounded-full border px-3 py-1 text-xs font-bold {{ $statusBadge($product) }}">{{ $product->is_available ? 'Ready' : 'Terjual' }}</span>
                    </td>
                    <td class="px-5 py-4">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('products.edit', $product) }}" class="inline-flex items-center rounded-full border border-slate-200 bg-white px-3 py-2 text-xs font-extrabold text-slate-700 transition hover:border-slate-300 hover:bg-slate-50">
                                Edit
                            </a>
                            <a href="{{ route('landing.products.show', $product) }}" target="_blank" class="inline-flex items-center rounded-full border border-slate-200 bg-white px-3 py-2 text-xs font-extrabold text-slate-700 transition hover:border-slate-300 hover:bg-slate-50">
                                Lihat
                            </a>
                            <button type="button" onclick="confirmDelete({{ $product->id }})" class="inline-flex items-center rounded-full border border-rose-200 bg-rose-50 px-3 py-2 text-xs font-extrabold text-rose-700 transition hover:bg-rose-100">
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-5 py-16 text-center">
                        <p class="text-lg font-black text-slate-950">Produk tidak ditemukan.</p>
                        <p class="mt-2 text-sm font-medium text-slate-500">Coba ubah kata kunci atau reset filter produk.</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="grid gap-3 lg:hidden">
    @forelse ($products as $product)
        <article class="overflow-hidden rounded-[1.25rem] border border-slate-200 bg-white shadow-sm">
            <div class="flex gap-3 p-3">
                @if ($product->image)
                    <img src="{{ media_url($product->image) }}" alt="{{ $product->name }}" class="h-24 w-24 shrink-0 rounded-2xl object-cover ring-1 ring-slate-200">
                @else
                    <div class="flex h-24 w-24 shrink-0 items-center justify-center rounded-2xl bg-slate-100 text-slate-400 ring-1 ring-slate-200">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 0 1 2.828 0L16 16m-2-2 1.586-1.586a2 2 0 0 1 2.828 0L20 14m-6-6h.01M6 20h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Z" />
                        </svg>
                    </div>
                @endif

                <div class="min-w-0 flex-1">
                    <div class="flex items-start justify-between gap-2">
                        <div class="min-w-0">
                            <h3 class="line-clamp-2 text-base font-black leading-tight text-slate-950">{{ $product->name }}</h3>
                            <p class="mt-1 text-xs font-extrabold uppercase tracking-[0.16em] text-slate-400">{{ $product->category ?: '-' }} - Size {{ $product->size ?: '-' }}</p>
                        </div>
                        <span class="shrink-0 rounded-full border px-2.5 py-1 text-[10px] font-black {{ $statusBadge($product) }}">{{ $product->is_available ? 'Ready' : 'Sold' }}</span>
                    </div>

                    <div class="mt-3 flex items-end justify-between gap-2">
                        <div>
                            @if ($product->is_on_sale)
                                <p class="text-xs font-bold text-slate-400 line-through">{{ rupiah($product->price) }}</p>
                                <p class="text-base font-black text-red-600">{{ rupiah($product->final_price) }}</p>
                            @else
                                <p class="text-base font-black text-slate-950">{{ rupiah($product->price) }}</p>
                            @endif
                        </div>
                        <span class="rounded-full border px-2.5 py-1 text-[10px] font-black {{ $conditionTone($product) }}">{{ $product->condition_label }}</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-2 border-t border-slate-200 p-3">
                <a href="{{ route('products.edit', $product) }}" class="rounded-2xl bg-slate-950 px-3 py-2.5 text-center text-xs font-extrabold text-white">Edit</a>
                <a href="{{ route('landing.products.show', $product) }}" target="_blank" class="rounded-2xl border border-slate-200 px-3 py-2.5 text-center text-xs font-extrabold text-slate-700">Lihat</a>
                <button type="button" onclick="confirmDelete({{ $product->id }})" class="rounded-2xl border border-rose-200 bg-rose-50 px-3 py-2.5 text-xs font-extrabold text-rose-700">Hapus</button>
            </div>
        </article>
    @empty
        <div class="rounded-[1.25rem] border border-slate-200 bg-white px-5 py-12 text-center">
            <p class="text-lg font-black text-slate-950">Produk tidak ditemukan.</p>
            <p class="mt-2 text-sm font-medium text-slate-500">Coba ubah kata kunci atau reset filter produk.</p>
        </div>
    @endforelse
</div>

<div class="mt-5">
    {{ $products->links() }}
</div>
