<x-profile.standalone-layout title="Keluar" breadcrumb="Logout">
    <section class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow-lg rounded-2xl">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-gray-400">Keluar</p>
                <h3 class="mt-1 text-xl font-semibold text-gray-900 dark:text-gray-100">Akhiri Sesi</h3>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Pastikan sudah menyimpan perubahan sebelum keluar dari akun.</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold shadow-lg shadow-red-500/50 hover:shadow-xl hover:shadow-red-500/50 hover:scale-105 transition-all duration-300">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </section>
</x-profile.standalone-layout>

