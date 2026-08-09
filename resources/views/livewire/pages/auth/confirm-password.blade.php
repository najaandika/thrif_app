<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state(['password' => '']);

rules(['password' => ['required', 'string']]);

$confirmPassword = function () {
    $this->validate();

    if (! Auth::guard('web')->validate([
        'email' => Auth::user()->email,
        'password' => $this->password,
    ])) {
        throw ValidationException::withMessages([
            'password' => __('auth.password'),
        ]);
    }

    session(['auth.password_confirmed_at' => time()]);

    $this->redirectIntended(default: Auth::user()->homePath(), navigate: true);
};

?>

<div>
    <div class="auth-header">
        <div class="auth-icon-wrapper">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0-1.105.895-2 2-2h1a2 2 0 012 2v2m-6-2V9a4 4 0 118 0v2m-8 0h8m-10 0h12v9H5v-9z" />
            </svg>
        </div>
        <h2 class="auth-title">Konfirmasi password.</h2>
        <p class="auth-subtitle">Masukkan password akun untuk melanjutkan ke area yang lebih sensitif.</p>
    </div>

    <form wire:submit="confirmPassword" class="auth-form">
        <div>
            <x-input-label for="password" value="Password" />

            <x-text-input wire:model="password"
                          id="password"
                          class="auth-input !pl-4"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <button type="submit" class="auth-primary-btn w-full">Konfirmasi</button>
    </form>
</div>

