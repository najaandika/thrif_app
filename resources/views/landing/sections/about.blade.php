@php
    $aboutTitle = \App\Models\Setting::get('about_title', 'Tentang Kami');
    $aboutDescription = \App\Models\Setting::get('about_description', 'Tempat terbaik untuk menemukan koleksi pre-loved berkualitas dengan harga terjangkau.');
    $aboutFeature1 = \App\Models\Setting::get('about_feature_1', 'Pre-loved Quality');
    $aboutFeature2 = \App\Models\Setting::get('about_feature_2', 'Stok Real-time');
    $aboutFeature3 = \App\Models\Setting::get('about_feature_3', 'Terpercaya');
@endphp

<div class="h-full rounded-3xl border-2 border-gray-200 dark:border-gray-800 bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 dark:from-gray-900/80 dark:via-indigo-950/20 dark:to-purple-950/20 p-6 sm:p-8 space-y-5 relative overflow-hidden" id="tentang-kami" data-animate data-section="about">
    <!-- Decorative element -->
    <div class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-gradient-to-br from-indigo-500/10 to-purple-500/10 blur-2xl"></div>
    
    <div class="space-y-3 relative z-10">
        <div class="flex items-center gap-3">
            <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-indigo-600 to-purple-600 flex items-center justify-center text-white shadow-lg shadow-indigo-500/50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold tracking-[0.2em] text-indigo-600 dark:text-indigo-400 uppercase">Tentang</p>
            </div>
        </div>
    </div>
    
    <div class="space-y-4 relative z-10">
        <div class="flex gap-3">
            <div class="flex-shrink-0 mt-1">
                <div class="h-6 w-6 rounded-lg bg-indigo-100 dark:bg-indigo-900/40 flex items-center justify-center">
                    <svg class="w-3 h-3 text-indigo-600 dark:text-indigo-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
                {{ $aboutDescription }}
            </p>
        </div>
    </div>
    
    <div class="flex flex-wrap gap-3 pt-2 relative z-10">
        @if($aboutFeature1)
        <div class="inline-flex items-center gap-2 rounded-xl bg-indigo-100 dark:bg-indigo-900/40 px-4 py-2 text-sm font-medium text-indigo-700 dark:text-indigo-300">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            {{ $aboutFeature1 }}
        </div>
        @endif
        
        @if($aboutFeature2)
        <div class="inline-flex items-center gap-2 rounded-xl bg-purple-100 dark:bg-purple-900/40 px-4 py-2 text-sm font-medium text-purple-700 dark:text-purple-300">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ $aboutFeature2 }}
        </div>
        @endif
        
        @if($aboutFeature3)
        <div class="inline-flex items-center gap-2 rounded-xl bg-emerald-100 dark:bg-emerald-900/40 px-4 py-2 text-sm font-medium text-emerald-700 dark:text-emerald-300">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
            {{ $aboutFeature3 }}
        </div>
        @endif
    </div>
</div>
