@props(['title' => 'Profile', 'breadcrumb' => null])

<x-clean-layout>
    <div class="min-h-screen bg-[#f7faf9] px-4 py-5 text-slate-950 sm:px-6 lg:px-8 lg:py-10">
        <div class="mx-auto max-w-4xl">
            <header class="flex items-center justify-between gap-3 rounded-[1.75rem] border border-slate-200 bg-white/90 p-3 shadow-[0_18px_60px_rgba(15,23,42,0.06)] backdrop-blur-xl sm:p-4">
                <a href="{{ route('profile') }}" class="inline-flex min-h-11 items-center gap-2 rounded-2xl px-3 text-sm font-extrabold text-slate-700 transition hover:bg-slate-50 hover:text-slate-950" aria-label="Kembali ke akun">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Akun
                </a>

                <div class="text-right leading-tight">
                    <p class="text-sm font-extrabold tracking-tight text-slate-950">{{ $title }}</p>
                    @if($breadcrumb)
                        <p class="text-xs font-semibold text-slate-500">{{ $breadcrumb }}</p>
                    @endif
                </div>
            </header>

            <main class="py-6 sm:py-8">
                {{ $slot }}
            </main>
        </div>
    </div>
</x-clean-layout>
