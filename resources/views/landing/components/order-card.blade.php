<article class="rounded-3xl border border-gray-200 bg-white shadow-sm p-5 flex flex-col md:flex-row gap-4">
    <div class="flex-1 space-y-2">
        <div class="flex items-center justify-between text-xs text-gray-500">
            <span>#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
            <span>{{ $order->created_at->translatedFormat('d M Y H:i') }}</span>
        </div>
        <h2 class="text-lg font-semibold text-gray-900">{{ $order->product->name ?? 'Produk terhapus' }}</h2>
        <p class="text-sm text-gray-500">Qty {{ $order->quantity }} · {{ rupiah($order->total_price) }}</p>
        <p class="text-sm text-gray-500">Status: <span class="font-semibold text-gray-900">{{ ucfirst($order->status) }}</span></p>
        @if ($order->notes)
            <p class="text-sm text-gray-500">Catatan: {{ $order->notes }}</p>
        @endif
    </div>
    <div class="md:w-64 rounded-2xl border border-gray-100 bg-gray-50 p-4 text-sm text-gray-600">
        <p class="font-semibold text-gray-900 mb-3">Detail Pengiriman</p>
        <div class="space-y-3">
            <div>
                <p class="text-xs text-gray-500">Nama Penerima</p>
                <p class="font-medium text-gray-900">{{ $order->buyer_name }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500">Kontak</p>
                <p class="font-medium text-gray-900">{{ $order->buyer_contact ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500">Alamat</p>
                <p class="font-medium text-gray-900">{{ $order->shipping_address ?? 'Belum diisi' }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500">Metode Pembayaran</p>
                <p class="font-medium text-gray-900">{{ $order->payment_method === 'cash' ? 'Cash On Delivery' : ucfirst($order->payment_method) }}</p>
            </div>
        </div>
    </div>
</article>



