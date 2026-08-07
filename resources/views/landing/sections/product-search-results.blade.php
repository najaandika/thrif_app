@extends('layouts.app')

@section('title', 'Cari Produk')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Hasil Pencarian Produk</h1>
    <form action="{{ route('products.search') }}" method="get" class="mb-6 flex gap-2">
        <input type="text" name="q" value="{{ $query }}" placeholder="Cari produk..." class="w-full px-3 py-2 rounded-lg border border-gray-300 bg-white text-gray-900">
        <button type="submit" class="px-4 py-2 rounded-lg bg-emerald-600 text-white font-semibold">Cari</button>
    </form>
    @if($products->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="border rounded-xl p-4 bg-white shadow relative overflow-hidden">
                    <a href="{{ route('landing.products.show', $product) }}" class="block">
                        <div class="relative">
                            <img src="{{ $product->image ? media_url($product->image) : 'https://via.placeholder.com/200x150?text=No+Image' }}" alt="{{ $product->name }}" class="w-full h-36 object-cover rounded mb-2">
                            @if($product->is_on_sale)
                                <div class="absolute top-2 left-2 bg-gradient-to-r from-red-500 to-orange-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow">
                                    -{{ $product->discount_percent }}%
                                </div>
                            @endif
                        </div>
                        <div class="font-bold text-lg text-gray-900">{{ $product->name }}</div>
                        <div class="text-xs text-gray-500 mb-1">Kategori: {{ $product->category }}</div>
                        @if($product->is_on_sale)
                            <div class="flex items-center gap-2">
                                <span class="text-sm text-gray-400 line-through">{{ rupiah($product->price) }}</span>
                                <span class="text-red-500 font-bold">{{ rupiah($product->final_price) }}</span>
                            </div>
                        @else
                            <div class="text-emerald-600 font-semibold">{{ rupiah($product->price) }}</div>
                        @endif
                    </a>
                </div>
            @endforeach
        </div>
        <div class="mt-6">{{ $products->links() }}</div>
    @else
        <div class="text-gray-500 py-8 text-center">Tidak ada produk ditemukan untuk "{{ $query }}"</div>
    @endif
</div>
@endsection




