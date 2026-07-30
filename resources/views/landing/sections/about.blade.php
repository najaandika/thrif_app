@php
    $aboutFeatures = array_values(array_filter([$aboutFeature1, $aboutFeature2, $aboutFeature3]));
@endphp

<section class="flex h-full flex-col rounded-[1.5rem] border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-800 dark:bg-gray-900 sm:p-6 lg:p-7" id="tentang-kami" data-section="about">
    <div class="notion-caption mb-5"><span></span>Store notes</div>
    <div class="flex items-start justify-between gap-5">
        <div class="max-w-md">
            <p class="text-[11px] font-semibold uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400">Tentang toko</p>
            <h2 class="mt-2 text-2xl font-semibold leading-tight tracking-tight text-gray-950 dark:text-gray-50">Kurasi thrift yang jelas sebelum kamu checkout.</h2>
        </div>
        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-gray-200 bg-gray-50 text-gray-700 dark:border-gray-800 dark:bg-gray-950 dark:text-gray-200" aria-hidden="true">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4M20 7l-8-4-8 4v6c0 5 3.5 8 8 9 4.5-1 8-4 8-9V7z" />
            </svg>
        </div>
    </div>

    <p class="mt-5 text-sm leading-7 text-gray-600 dark:text-gray-300">
        {{ $aboutDescription }}
    </p>

    @if(count($aboutFeatures))
        <div class="mt-6 grid gap-3 sm:grid-cols-3 lg:grid-cols-1 xl:grid-cols-3">
            @foreach($aboutFeatures as $feature)
                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-3 dark:border-gray-800 dark:bg-gray-950">
                    <div class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-teal-50 text-teal-700 dark:bg-teal-950/50 dark:text-teal-300" aria-hidden="true">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M5 13l4 4L19 7" />
                            </svg>
                        </span>
                        <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $feature }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="mt-auto pt-6">
        <div class="rounded-2xl border border-gray-200 bg-gray-50 p-4 dark:border-gray-800 dark:bg-gray-950">
            <p class="text-[11px] font-semibold uppercase tracking-[0.16em] text-gray-500 dark:text-gray-400">Proses kurasi</p>
            <div class="mt-4 grid gap-4 sm:grid-cols-3 lg:grid-cols-1 xl:grid-cols-3">
                <div>
                    <p class="text-sm font-semibold text-gray-950 dark:text-gray-100">Foto real</p>
                    <p class="mt-1 text-xs leading-5 text-gray-500 dark:text-gray-400">Gambar mengikuti kondisi barang yang siap dijual.</p>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-950 dark:text-gray-100">Detail ringkas</p>
                    <p class="mt-1 text-xs leading-5 text-gray-500 dark:text-gray-400">Kondisi, ukuran, dan harga dibuat mudah dibaca.</p>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-950 dark:text-gray-100">Stok terbatas</p>
                    <p class="mt-1 text-xs leading-5 text-gray-500 dark:text-gray-400">Satu item bisa cepat habis karena barang preloved.</p>
                </div>
            </div>
        </div>
    </div>
</section>