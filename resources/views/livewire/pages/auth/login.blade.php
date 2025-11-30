<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\form;
use function Livewire\Volt\layout;

layout('layouts.guest');

form(LoginForm::class);

$login = function () {
    $this->validate();

    $this->form->authenticate();

    Session::regenerate();

    $home = auth()->user()?->homePath() ?? '/';

    $this->redirectIntended(default: $home);
};

?>

<div>
    <!-- Page Header -->
    <div class="auth-header">
        <div class="auth-icon-wrapper">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </div>
        <h2 class="auth-title">Welcome Back!</h2>
        <p class="auth-subtitle">Masuk untuk melanjutkan belanja thrift pilihan</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-3" :status="session('status')" />

    <form wire:submit="login" class="auth-form">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Email" class="mb-1" />
            <x-text-input wire:model="form.email" id="email" class="block w-full" type="email" name="email" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('form.email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Password" class="mb-1" />
            <x-text-input wire:model="form.password" id="password" class="block w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-1" />
        </div>

        <!-- Remember Me -->
        <div>
            <label for="remember" class="remember-label">
                <input wire:model="form.remember" id="remember" type="checkbox" class="remember-checkbox" name="remember">
                <span class="remember-text">Remember me</span>
            </label>
        </div>

        <!-- Forgot Password & Login Button -->
        <div class="auth-actions">
            @if (Route::has('password.request'))
                <a class="forgot-password-link" href="{{ route('password.request') }}" wire:navigate>
                    Lupa password?
                </a>
            @endif

            <x-primary-button class="ml-auto">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                Log in
            </x-primary-button>
        </div>

        <!-- Divider -->
        <div class="auth-divider">
            <div class="auth-divider-line">
                <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
            </div>
            <div class="auth-divider-text">
                <span class="px-2 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">atau</span>
            </div>
        </div>

        <!-- Login with Google -->
        <div>
            <a href="{{ route('google.redirect') }}"
               class="google-login-btn">
                <svg class="w-5 h-5" viewBox="0 0 24 24"><g><path fill="#4285F4" d="M12 12v3.6h5.1c-.2 1.2-1.4 3.4-5.1 3.4-3.1 0-5.6-2.6-5.6-5.7s2.5-5.7 5.6-5.7c1.8 0 3 .7 3.7 1.3l2.5-2.4C16.6 5.6 14.6 4.6 12 4.6 6.9 4.6 2.8 8.7 2.8 13.8s4.1 9.2 9.2 9.2c5.3 0 8.8-3.7 8.8-8.9 0-.6-.1-1.1-.2-1.6H12z"/><path fill="#34A853" d="M12 21c2.4 0 4.4-.8 5.9-2.2l-2.8-2.2c-.8.6-1.9 1-3.1 1-2.4 0-4.4-1.6-5.1-3.7H2.8v2.3C4.3 19.7 7.9 21 12 21z"/><path fill="#FBBC05" d="M6.9 14.9c-.2-.6-.3-1.2-.3-1.9s.1-1.3.3-1.9V8.8H2.8C2.3 9.8 2 11.1 2 12.3c0 1.2.3 2.5.8 3.5l4.1-1z"/><path fill="#EA4335" d="M12 6.6c1.3 0 2.5.4 3.4 1.1l2.5-2.4C16.4 3.7 14.4 2.8 12 2.8c-4.1 0-7.7 2.3-9.2 5.7l4.1 3.2c.7-2.1 2.7-3.6 5.1-3.6z"/></g></svg>
                Login dengan Google
            </a>
        </div>
        
        <!-- Register Link -->
        <div class="auth-register-section">
            <p class="auth-register-text">
                Belum punya akun? 
                <a href="{{ route('register') }}" wire:navigate class="auth-register-link">
                    Daftar sekarang
                </a>
            </p>
        </div>
    </form>
    
    <!-- Benefits Section -->
    <div class="benefits-section">
        <p class="benefits-title">Keuntungan Login</p>
        <div class="benefits-list">
            <div class="benefit-item">
                <svg class="benefit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>Checkout lebih cepat dengan data tersimpan</span>
            </div>
            <div class="flex items-start gap-2 text-xs text-gray-600 dark:text-gray-300">
                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>Pantau riwayat pembelian real-time</span>
            </div>
            <div class="flex items-start gap-2 text-xs text-gray-600 dark:text-gray-300">
                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
