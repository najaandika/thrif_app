@extends('layouts.app')

@section('title', 'Cari Produk')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Hasil Pencarian Produk</h1>
    <form action="{{ route('products.search') }}" method="get" class="mb-6 flex gap-2">
        <input type="text" name="q" value="{{ $query }}" placeholder="Cari produk..." class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
        <button type="submit" class="px-4 py-2 rounded-lg bg-emerald-600 text-white font-semibold">Cari</button>
    </form>
    @if($products->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="border rounded-xl p-4 bg-white dark:bg-gray-900 shadow">
                    <a href="{{ route('landing.products.checkout', $product) }}" class="block">
                        <img src="{{ $product->image ? Storage::url($product->image) : 'https://via.placeholder.com/200x150?text=No+Image' }}" alt="{{ $product->name }}" class="w-full h-36 object-cover rounded mb-2">
                        <div class="font-bold text-lg text-gray-900 dark:text-gray-100">{{ $product->name }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">Kategori: {{ $product->category }}</div>
                        <div class="text-emerald-600 dark:text-emerald-400 font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="mt-6">{{ $products->links() }}</div>
    @else
        <div class="text-gray-500 dark:text-gray-400 py-8 text-center">Tidak ada produk ditemukan untuk "{{ $query }}"</div>
    @endif
</div>
@endsection
