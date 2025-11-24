<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-[260px_1fr]">
                <aside>
                    <x-sidebar.menu />
                </aside>

                <div class="space-y-6">
                    <section id="section-account" class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow rounded-2xl space-y-6">
                        <div>
                            <p class="text-xs uppercase tracking-[0.2em] text-gray-400">Profil</p>
                            <h3 class="mt-1 text-xl font-semibold text-gray-900 dark:text-gray-100">Informasi Akun</h3>
                        </div>
                        <div class="space-y-6">
                            <div class="max-w-xl">
                                <livewire:profile.update-profile-information-form />
                            </div>
                            <div class="max-w-xl">
                                <livewire:profile.update-password-form />
                            </div>
                        </div>
                    </section>

                    <section id="section-address" class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow rounded-2xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-[0.2em] text-gray-400">Alamat</p>
                                <h3 class="mt-1 text-xl font-semibold text-gray-900 dark:text-gray-100">Alamat Pengiriman</h3>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Fitur alamat khusus segera hadir. Untuk sementara, cantumkan alamat saat membuat order.</p>
                            </div>
                            <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300">Coming soon</span>
                        </div>
                    </section>

                    @if (auth()->user()?->isCustomer())
                        <section id="section-history" class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow rounded-2xl">
                            <livewire:profile.order-history />
                        </section>
                    @endif

                    <section id="section-wishlist" class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow rounded-2xl">
                        <div>
                            <p class="text-xs uppercase tracking-[0.2em] text-gray-400">Favorit</p>
                            <h3 class="mt-1 text-xl font-semibold text-gray-900 dark:text-gray-100">Wishlist</h3>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Belum ada item favorit. Tandai produk favorit pada halaman detail produk untuk melihatnya di sini.</p>
                        </div>
                    </section>

                    <section id="section-logout" class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow rounded-2xl">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div>
                                <p class="text-xs uppercase tracking-[0.2em] text-gray-400">Keluar</p>
                                <h3 class="mt-1 text-xl font-semibold text-gray-900 dark:text-gray-100">Akhiri sesi</h3>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Pastikan sudah menyimpan perubahan sebelum keluar dari akun.</p>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-5 py-3 rounded-xl bg-red-600 text-white font-semibold shadow hover:bg-red-700 transition">Keluar</button>
                            </form>
                        </div>
                    </section>

                    <section class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow rounded-2xl">
                        <div class="max-w-xl">
                            <livewire:profile.delete-user-form />
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
