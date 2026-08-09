<x-profile.standalone-layout title="Keluar" breadcrumb="Logout">
    <section class="profile-panel">
        <div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_minmax(280px,0.72fr)] lg:items-center">
            <div>
                <p class="profile-kicker">Keluar akun</p>
                <h1 class="profile-title">Akhiri sesi belanja?</h1>
                <p class="profile-copy">Kamu bisa masuk lagi kapan saja. Pastikan perubahan profil atau alamat sudah tersimpan sebelum keluar.</p>

                <div class="mt-6 grid gap-3 sm:grid-cols-3">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Cart</p>
                        <p class="mt-1 text-sm font-extrabold text-slate-950">Tetap aman</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Alamat</p>
                        <p class="mt-1 text-sm font-extrabold text-slate-950">Tersimpan</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <p class="text-[10px] font-extrabold uppercase tracking-[0.14em] text-slate-400">Login</p>
                        <p class="mt-1 text-sm font-extrabold text-slate-950">Bisa ulang</p>
                    </div>
                </div>
            </div>

            <div class="rounded-[1.75rem] border border-slate-200 bg-slate-50 p-4 sm:p-5">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-red-600 shadow-sm">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </div>
                <p class="mt-4 text-base font-extrabold text-slate-950">Konfirmasi keluar dari perangkat ini.</p>
                <p class="mt-2 text-sm font-medium leading-6 text-slate-600">Sesi aktif akan dihentikan dan kamu akan kembali ke halaman utama.</p>

                <form method="POST" action="{{ route('logout') }}" class="mt-5 space-y-3">
                    @csrf
                    <button type="submit" class="inline-flex min-h-12 w-full items-center justify-center gap-2 rounded-2xl bg-red-600 px-5 py-3 text-sm font-extrabold text-white shadow-lg shadow-red-600/15 transition hover:-translate-y-0.5 hover:bg-red-700">
                        Keluar sekarang
                    </button>
                    <a href="{{ route('profile') }}" class="profile-secondary-btn w-full">
                        Batal
                    </a>
                </form>
            </div>
        </div>
    </section>
</x-profile.standalone-layout>

