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
        <h2 class="auth-title">Masuk ke akun</h2>
        <p class="auth-subtitle">Pantau order, simpan alamat, dan checkout item pilihan lebih cepat.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-3" :status="session('status')" />

    <form wire:submit="login" class="auth-form">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Email" class="mb-1" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <x-text-input wire:model="form.email" id="email" class="block w-full pl-10" type="email" name="email" required autofocus autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('form.email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Password" class="mb-1" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <x-text-input wire:model="form.password" id="password" class="block w-full pl-10" type="password" name="password" required autocomplete="current-password" />
            </div>
            <x-input-error :messages="$errors->get('form.password')" class="mt-1" />
        </div>

        <!-- Remember Me -->
        <div>
            <label for="remember" class="remember-label">
                <input wire:model="form.remember" id="remember" type="checkbox" class="remember-checkbox" name="remember">
                <span class="remember-text">Ingat saya</span>
            </label>
        </div>

        <!-- Forgot Password & Login Button -->
        <div class="auth-actions">
            @if (Route::has('password.request'))
                <a class="forgot-password-link" href="{{ route('password.request') }}" wire:navigate>
                    Lupa password?
                </a>
            @endif

            <button type="submit" class="login-btn-compact ml-auto">
                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                Masuk
            </button>
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
                Masuk dengan Google
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

</div>

