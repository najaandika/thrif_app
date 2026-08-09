<div class="py-12">
    <div class="flex flex-row gap-6">
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
    {{-- Modal for Receipt --}}
    @include('livewire.orders._modal')
    <style>
        div.swal2-popup.swal-mobile-compact {
            width: 280px !important;
            padding: 1rem !important;
        }
        div.swal2-popup.swal-mobile-compact .swal2-title {
            font-size: 16px !important;
        }
        div.swal2-popup.swal-mobile-compact .swal2-html-container {
            font-size: 13px !important;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('show-pos-success', (event) => {
                Swal.fire({
                    title: 'Sukses!',
                    text: event.message,
                    imageUrl: "{{ asset('images/success-icon.svg') }}",
                    imageWidth: 50,
                    imageHeight: 50,
                    imageAlt: 'Success',
                    showDenyButton: true,
                    confirmButtonText: 'OK (Transaksi Baru)',
                    denyButtonText: 'Cetak Struk',
                    confirmButtonColor: '#10b981',
                    denyButtonColor: '#3b82f6',
                    width: '300px',
                    padding: '1.25rem',
                    customClass: {
                        popup: 'rounded-2xl swal-mobile-compact',
                        confirmButton: 'rounded-lg px-4 py-2 text-xs font-semibold',
                        denyButton: 'rounded-lg px-4 py-2 text-xs font-semibold',
                        title: 'font-bold',
                        htmlContainer: 'text-sm'
                    }
                }).then((result) => {
                    if (result.isDenied) {
                        // Trigger show receipt modal
                         @this.call('showLastReceipt', event.orderId);
                    }
                });
            });
        });
    </script>
</div>

