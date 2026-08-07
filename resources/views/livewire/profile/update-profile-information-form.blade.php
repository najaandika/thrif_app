<?php

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

use function Livewire\Volt\state;

state([
    'name' => fn () => auth()->user()->name,
    'email' => fn () => auth()->user()->email,
    'phone' => fn () => auth()->user()->phone
]);

$updateProfileInformation = function () {
    $user = Auth::user();

    $validated = $this->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        'phone' => ['nullable', 'string', 'max:255'],
    ]);

    $user->fill($validated);

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    $user->save();

    $this->dispatch('profile-updated', name: $user->name);
};

$sendVerification = function () {
    $user = Auth::user();

    if ($user->hasVerifiedEmail()) {
        $this->redirectIntended(default: route('dashboard', absolute: false));

        return;
    }

    $user->sendEmailVerificationNotification();

    Session::flash('status', 'verification-link-sent');
};

?>

<section class="rounded-[1.5rem] border border-slate-200 bg-slate-50/70 p-4 sm:p-5">
    <header>
        <p class="text-[11px] font-extrabold uppercase tracking-[0.16em] text-slate-400">Akun</p>
        <h2 class="mt-1 text-xl font-black tracking-[-0.035em] text-slate-950">Informasi profil.</h2>
        <p class="mt-2 text-sm font-medium leading-6 text-slate-600">Data ini dipakai untuk checkout dan konfirmasi order.</p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-5 space-y-4">
        <div>
            <x-input-label for="name" value="Nama" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-2 block w-full rounded-2xl border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-950 shadow-sm focus:border-slate-950 focus:ring-4 focus:ring-slate-950/10" required autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-2 block w-full rounded-2xl border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-950 shadow-sm focus:border-slate-950 focus:ring-4 focus:ring-slate-950/10" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div class="mt-3 rounded-2xl border border-amber-200 bg-amber-50 p-3 text-sm font-medium leading-6 text-amber-800">
                    Email belum terverifikasi.
                    <button wire:click.prevent="sendVerification" class="font-extrabold underline decoration-amber-300 underline-offset-4 hover:decoration-amber-700">
                        Kirim ulang link verifikasi.
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-bold text-emerald-700">Link verifikasi baru sudah dikirim.</p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="phone" value="Nomor WhatsApp" />
            <x-text-input wire:model="phone" id="phone" name="phone" type="text" class="mt-2 block w-full rounded-2xl border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-950 shadow-sm focus:border-slate-950 focus:ring-4 focus:ring-slate-950/10" placeholder="08..." autocomplete="tel" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div class="flex flex-wrap items-center gap-3 pt-1">
            <button type="submit" class="inline-flex min-h-11 items-center justify-center rounded-2xl bg-slate-950 px-5 py-3 text-sm font-extrabold text-white shadow-lg shadow-slate-950/15 transition hover:-translate-y-0.5 hover:bg-slate-800">
                Simpan profil
            </button>

            <x-action-message class="text-sm font-bold text-emerald-700" on="profile-updated">
                Tersimpan.
            </x-action-message>
        </div>
    </form>
</section>