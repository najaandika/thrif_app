<x-profile.standalone-layout title="Informasi Akun" breadcrumb="Data dan keamanan">
    <section class="space-y-4">
        <div class="rounded-[2rem] border border-slate-200 bg-white p-5 shadow-[0_18px_60px_rgba(15,23,42,0.06)] sm:p-7">
            <div class="mb-6">
                <p class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-[11px] font-bold uppercase tracking-[0.16em] text-slate-500">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                    Profil
                </p>
                <h1 class="mt-4 text-3xl font-black tracking-[-0.045em] text-slate-950">Data akun kamu.</h1>
                <p class="mt-2 max-w-xl text-sm font-medium leading-7 text-slate-600">Pastikan nama, email, dan kontak aktif supaya checkout dan konfirmasi order lebih mudah.</p>
            </div>

            <div class="grid gap-6 lg:grid-cols-2 lg:items-start">
                <livewire:profile.update-profile-information-form />
                <livewire:profile.update-password-form />
            </div>
        </div>

        <section class="rounded-[2rem] border border-red-100 bg-white p-5 shadow-sm sm:p-7">
            <livewire:profile.delete-user-form />
        </section>
    </section>
</x-profile.standalone-layout>