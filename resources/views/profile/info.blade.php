<x-profile.standalone-layout title="Informasi Akun" breadcrumb="Informasi Akun">
    <section class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow-lg rounded-2xl space-y-6">
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

    <section class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow-lg rounded-2xl">
        <div class="max-w-xl">
            <livewire:profile.delete-user-form />
        </div>
    </section>
</x-profile.standalone-layout>
