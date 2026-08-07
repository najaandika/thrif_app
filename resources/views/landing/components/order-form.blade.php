<section class="bg-white border border-gray-200 rounded-3xl p-6 space-y-6">
    <div class="space-y-1">
        <p class="{{ $labelClass }}">Form Pembelian</p>
        <h2 class="text-2xl font-semibold text-gray-900">Isi data pengirimanmu</h2>
        <p class="text-sm text-gray-500">Semua data akan dijaga kerahasiaannya</p>
    </div>
    {{-- ...form isi pembelian, copy dari checkout.blade.php... --}}
    @include('landing.components.order-form-fields')
</section>



