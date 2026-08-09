<x-profile.standalone-layout title="Informasi Akun" breadcrumb="Data dan keamanan">
    <section class="space-y-4">
        <div class="profile-panel">
            <div class="mb-6">
                <p class="profile-kicker">Profil</p>
                <h1 class="profile-title">Data akun kamu.</h1>
                <p class="profile-copy">Pastikan nama, email, dan kontak aktif supaya checkout dan konfirmasi order lebih mudah.</p>
            </div>

            <div class="grid gap-6 lg:grid-cols-2 lg:items-start">
                <livewire:profile.update-profile-information-form />
                <livewire:profile.update-password-form />
            </div>
        </div>

        <section class="profile-panel">
            <livewire:profile.delete-user-form />
        </section>
    </section>
</x-profile.standalone-layout>
