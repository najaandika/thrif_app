<x-clean-layout>
    <div class="py-8 sm:py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back to Home -->
            <div class="mb-6">
                <a
                    href="{{ auth()->user()?->homePath() ?? url('/') }}"
                    class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-slate-900 to-slate-700 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-slate-800/50 transition-all duration-300 hover:shadow-xl hover:shadow-slate-900/60 hover:scale-105 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-slate-500"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Beranda
                </a>
            </div>

            <!-- Header -->
            <div class="mb-6">
                <p class="text-xs uppercase tracking-[0.2em] text-gray-400">Menu Profile</p>
                <h3 class="mt-1 text-2xl font-bold text-gray-900 dark:text-gray-100">Kelola Akun Kamu</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Pilih menu untuk mengelola profil, alamat, riwayat, dan pengaturan lainnya.</p>
            </div>

            <!-- Navigation Cards -->
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-2 max-w-3xl">
                <!-- Informasi Akun -->
                <a href="{{ route('profile.info') }}" class="group block p-5 bg-white dark:bg-gray-800 shadow-lg rounded-2xl border-2 border-transparent hover:border-blue-300 dark:hover:border-blue-600 transition-all duration-300 hover:scale-105">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0 h-10 w-10 rounded-xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center text-blue-600 dark:text-blue-400 group-hover:scale-110 transition-transform">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-1">Informasi Akun</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Edit nama, email, dan password</p>
                        </div>
                    </div>
                </a>

                @if(auth()->user()?->isCustomer())
                    <!-- Alamat -->
                    <a href="{{ route('profile.address') }}" class="group block p-5 bg-white dark:bg-gray-800 shadow-lg rounded-2xl border-2 border-transparent hover:border-indigo-300 dark:hover:border-indigo-600 transition-all duration-300 hover:scale-105">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 h-10 w-10 rounded-xl bg-indigo-100 dark:bg-indigo-900/40 flex items-center justify-center text-indigo-600 dark:text-indigo-400 group-hover:scale-110 transition-transform">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-1">Alamat</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Kelola alamat pengiriman default</p>
                            </div>
                        </div>
                    </a>
                @endif

                @if(auth()->user()?->isCustomer())
                    <!-- Riwayat Pembelian -->
                    <a href="{{ route('profile.history') }}" class="group block p-5 bg-white dark:bg-gray-800 shadow-lg rounded-2xl border-2 border-transparent hover:border-emerald-300 dark:hover:border-emerald-600 transition-all duration-300 hover:scale-105">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 h-10 w-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/40 flex items-center justify-center text-emerald-600 dark:text-emerald-400 group-hover:scale-110 transition-transform">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-1">Riwayat Pembelian</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Lihat histori order kamu</p>
                            </div>
                        </div>
                    </a>

                @endif

                <!-- Keluar -->
                <a href="{{ route('profile.logout') }}" class="group block p-5 bg-white dark:bg-gray-800 shadow-lg rounded-2xl border-2 border-transparent hover:border-red-300 dark:hover:border-red-600 transition-all duration-300 hover:scale-105">
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0 h-10 w-10 rounded-xl bg-red-100 dark:bg-red-900/40 flex items-center justify-center text-red-600 dark:text-red-400 group-hover:scale-110 transition-transform">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-1">Keluar</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Logout dari akun</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-clean-layout>
