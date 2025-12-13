<div class="py-12">
    <div class="flex flex-row gap-6">
        <x-sidebar />
        
        <div class="flex-1 min-w-0 px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-6xl bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100 dark:border-gray-700">
                <div class="p-8">
                    <!-- Header -->
                    <div class="mb-8">
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">POS (Kasir Offline)</h1>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola transaksi penjualan offline</p>
                    </div>

                    @include('livewire.pos._alerts')

                    <form wire:submit.prevent="saveTransaction">
                        <div class="flex flex-col lg:flex-row gap-6">
                            @include('livewire.pos._product-panel')
                            @include('livewire.pos._cart-and-payment')
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal removed as per request --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('show-pos-success', (event) => {
                Swal.fire({
                    title: 'Sukses!',
                    text: event.message, // Access message from event detail
                    imageUrl: "{{ asset('images/success-icon.svg') }}",
                    imageWidth: 80,
                    imageHeight: 80,
                    imageAlt: 'Success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#10b981', // emerald-500
                    customClass: {
                        popup: 'rounded-3xl',
                        confirmButton: 'rounded-xl px-6 py-2.5 font-semibold',
                        image: 'mb-4'
                    }
                });
            });
        });
    </script>
</div>
