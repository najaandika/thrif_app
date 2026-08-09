<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

use function Livewire\Volt\rules;
use function Livewire\Volt\state;

state([
    'current_password' => '',
    'password' => '',
    'password_confirmation' => ''
]);

rules([
    'current_password' => ['required', 'string', 'current_password'],
    'password' => ['required', 'string', Password::defaults(), 'confirmed'],
]);

$updatePassword = function () {
    try {
        $validated = $this->validate();
    } catch (ValidationException $e) {
        $this->reset('current_password', 'password', 'password_confirmation');

        throw $e;
    }

    Auth::user()->update([
        'password' => Hash::make($validated['password']),
    ]);

    $this->reset('current_password', 'password', 'password_confirmation');

    $this->dispatch('password-updated');
};

?>

<section class="profile-card bg-white">
    <header>
        <p class="text-[11px] font-extrabold uppercase tracking-[0.16em] text-slate-400">Keamanan</p>
        <h2 class="mt-1 text-xl font-extrabold tracking-[-0.035em] text-slate-950">Ganti password.</h2>
        <p class="mt-2 text-sm font-medium leading-6 text-slate-600">Gunakan password yang kuat agar akun dan riwayat order tetap aman.</p>
    </header>

    <form wire:submit="updatePassword" class="profile-form">
        <div>
            <x-input-label for="update_password_current_password" value="Password saat ini" />
            <x-text-input wire:model="current_password" id="update_password_current_password" name="current_password" type="password" class="profile-field" autocomplete="current-password" />
            <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" value="Password baru" />
            <x-text-input wire:model="password" id="update_password_password" name="password" type="password" class="profile-field" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" value="Konfirmasi password baru" />
            <x-text-input wire:model="password_confirmation" id="update_password_password_confirmation" name="password_confirmation" type="password" class="profile-field" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-wrap items-center gap-3 pt-1">
            <button type="submit" class="profile-secondary-btn">
                Update password
            </button>

            <x-action-message class="text-sm font-bold text-emerald-700" on="password-updated">
                Password tersimpan.
            </x-action-message>
        </div>
    </form>
</section>
