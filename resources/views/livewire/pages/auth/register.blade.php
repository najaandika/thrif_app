<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state([
    'name' => '',
    'email' => '',
    'password' => '',
    'password_confirmation' => ''
]);

rules([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
]);

$register = function () {
    // Normalize email to lowercase before validation
    $this->email = strtolower(trim($this->email));
    
    $validated = $this->validate();

    $validated['role'] = User::ROLE_CUSTOMER;

    $validated['password'] = Hash::make($validated['password']);

    event(new Registered($user = User::create($validated)));

    Auth::login($user);

    $this->redirect($user->homePath(), navigate: true);
};

?>

<div>
    <!-- Page Header -->
    <div class="auth-header">
        <div class="auth-icon-wrapper">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
        </div>
        <h2 class="auth-title">Create Account</h2>
        <p class="auth-subtitle">Bergabung untuk akses lengkap belanja thrift</p>
    </div>

    <form wire:submit="register" class="auth-form">
        <!-- Name -->
        <div>
            <x-input-label for="name" value="Name" class="mb-1" />
            <x-text-input wire:model="name" id="name" class="block w-full" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Email" class="mb-1" />
            <x-text-input wire:model="email" id="email" class="block w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Password" class="mb-1" />
            <x-text-input wire:model="password" id="password" class="block w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" value="Confirm Password" class="mb-1" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
            <p class="text-xs text-gray-600 dark:text-gray-400">
                Sudah punya akun?
                <a href="{{ route('login') }}" wire:navigate class="auth-register-link">
                    Login di sini
                </a>
            </p>

            <x-primary-button class="w-full sm:w-auto">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Register
            </x-primary-button>
        </div>
    </form>
    
    <!-- Benefits Section -->
    <div class="benefits-section">
        <p class="benefits-title">Keuntungan Bergabung</p>
        <div class="benefits-list">
            <div class="benefit-item">
                <svg class="benefit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>Checkout lebih cepat dengan data tersimpan</span>
            </div>
            <div class="benefit-item">
                <svg class="benefit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>Pantau riwayat pembelian real-time</span>
            </div>
            <div class="benefit-item">
                <svg class="benefit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>Update stok & promo eksklusif</span>
            </div>
        </div>
        
        <a href="/" wire:navigate class="back-home-btn">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke halaman utama
        </a>
    </div>
</div>
