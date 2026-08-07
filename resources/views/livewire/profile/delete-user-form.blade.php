<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;

use function Livewire\Volt\rules;
use function Livewire\Volt\state;

state(['password' => '']);

rules(['password' => ['required', 'string', 'current_password']]);

$deleteUser = function (Logout $logout) {
    $this->validate();

    tap(Auth::user(), $logout(...))->delete();

    $this->redirect('/', navigate: true);
};

?>

<section>
    <header>
        <p class="text-[11px] font-extrabold uppercase tracking-[0.16em] text-red-400">Danger zone</p>
        <h2 class="mt-1 text-xl font-black tracking-[-0.035em] text-slate-950">Hapus akun.</h2>
        <p class="mt-2 max-w-2xl text-sm font-medium leading-7 text-slate-600">Akun, data profil, dan akses riwayat akan dihapus permanen. Gunakan hanya kalau kamu benar-benar yakin.</p>
    </header>

    <button
        type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="mt-5 inline-flex min-h-11 items-center justify-center rounded-2xl border border-red-200 bg-red-50 px-5 py-3 text-sm font-extrabold text-red-700 transition hover:bg-red-100"
    >
        Hapus akun
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="deleteUser" class="p-6">
            <h2 class="text-xl font-black tracking-[-0.035em] text-slate-950">Hapus akun ini?</h2>

            <p class="mt-2 text-sm font-medium leading-7 text-slate-600">Masukkan password untuk konfirmasi. Setelah dihapus, akun tidak bisa dikembalikan.</p>

            <div class="mt-6">
                <x-input-label for="password" value="Password" class="sr-only" />

                <x-text-input
                    wire:model="password"
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full rounded-2xl border-slate-200 px-4 py-3 text-sm font-semibold text-slate-950 focus:border-slate-950 focus:ring-4 focus:ring-slate-950/10"
                    placeholder="Password"
                />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex flex-wrap justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Batal
                </x-secondary-button>

                <button type="submit" class="inline-flex min-h-10 items-center justify-center rounded-xl bg-red-600 px-4 py-2 text-xs font-extrabold uppercase tracking-[0.08em] text-white transition hover:bg-red-700">
                    Hapus akun
                </button>
            </div>
        </form>
    </x-modal>
</section>