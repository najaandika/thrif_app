<x-profile.standalone-layout title="Alamat Pengiriman" breadcrumb="Alamat default">
    <section class="rounded-[2rem] border border-slate-200 bg-white p-5 shadow-[0_18px_60px_rgba(15,23,42,0.06)] sm:p-7">
        <header class="mb-6">
            <p class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-[11px] font-bold uppercase tracking-[0.16em] text-slate-500">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                Alamat
            </p>
            <h1 class="mt-4 text-3xl font-black tracking-[-0.045em] text-slate-950">Simpan alamat utama.</h1>
            <p class="mt-2 max-w-xl text-sm font-medium leading-7 text-slate-600">Alamat ini dipakai sebagai default saat checkout agar kamu tidak mengisi ulang data pengiriman.</p>
        </header>

        <livewire:profile.address-form />
    </section>
</x-profile.standalone-layout>