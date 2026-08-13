<div class="px-4 py-8 sm:px-6 lg:px-10">
    <div class="mx-auto max-w-[112rem] space-y-6">
        <section class="flex flex-col gap-5 border-b border-slate-200 pb-6 lg:flex-row lg:items-end lg:justify-between">
            <div class="max-w-2xl">
                <p class="text-xs font-extrabold uppercase tracking-[0.22em] text-slate-400">Kasir toko</p>
                <h1 class="mt-3 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">POS offline.</h1>
                <p class="mt-2 text-base font-medium leading-7 text-slate-600">
                    Pilih item ready, cek total, lalu simpan transaksi kasir dari satu layar.
                </p>
            </div>

            <div class="inline-flex w-fit items-center gap-2 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-xs font-extrabold uppercase tracking-[0.16em] text-emerald-700">
                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                Kasir aktif
            </div>
        </section>

        @include('livewire.pos._alerts')

        <form wire:submit.prevent="saveTransaction">
            <div class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_27rem]">
                @include('livewire.pos._product-panel')
                @include('livewire.pos._cart-and-payment')
            </div>
        </form>
    </div>

    @include('livewire.orders._modal')

    <style>
        div.swal2-popup.swal-mobile-compact {
            width: 300px !important;
            padding: 1rem !important;
            border-radius: 1.25rem !important;
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
                    title: 'Transaksi tersimpan',
                    text: event.message,
                    imageUrl: "{{ asset('images/success-icon.svg') }}",
                    imageWidth: 48,
                    imageHeight: 48,
                    imageAlt: 'Success',
                    showDenyButton: true,
                    confirmButtonText: 'Transaksi baru',
                    denyButtonText: 'Cetak struk',
                    confirmButtonColor: '#020617',
                    denyButtonColor: '#2563eb',
                    width: '300px',
                    padding: '1.25rem',
                    customClass: {
                        popup: 'swal-mobile-compact',
                        confirmButton: 'rounded-xl px-4 py-2 text-xs font-bold',
                        denyButton: 'rounded-xl px-4 py-2 text-xs font-bold',
                        title: 'font-bold',
                        htmlContainer: 'text-sm'
                    }
                }).then((result) => {
                    if (result.isDenied) {
                        @this.call('showLastReceipt', event.orderId);
                    }
                });
            });
        });
    </script>
</div>
