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
    <div class="mb-6 text-center">
        <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-600 to-purple-600 text-white mb-3 shadow-lg shadow-indigo-500/40">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </div>
        <h2 class="text-xl font-bold text-gray-900 dark:text-white">Welcome Back!</h2>
        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Masuk untuk melanjutkan belanja thrift pilihan</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-3" :status="session('status')" />

    <form wire:submit="login" class="space-y-3.5">
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
            <label for="remember" class="inline-flex items-center cursor-pointer">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-xs text-gray-600 dark:text-gray-400">Remember me</span>
            </label>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center gap-3">
                @if (Route::has('password.request'))
                    <a class="text-xs text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 font-medium transition-colors" href="{{ route('password.request') }}" wire:navigate>
                        Lupa password?
                    </a>
                @endif
            </div>

            <x-primary-button class="w-full sm:w-auto">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                Log in
            </x-primary-button>
        </div>
        
        <div class="text-center pt-2">
            <p class="text-xs text-gray-600 dark:text-gray-400">
                Belum punya akun? 
                <a href="{{ route('register') }}" wire:navigate class="font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 transition-colors">
                    Daftar sekarang
                </a>
            </p>
        </div>
    </form>
    
    <!-- Benefits Section -->
    <div class="mt-6 pt-5 border-t border-gray-200 dark:border-gray-700">
        <p class="text-[10px] font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2.5">Keuntungan Login</p>
        <div class="space-y-1.5">
            <div class="flex items-start gap-2 text-xs text-gray-600 dark:text-gray-300">
                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        
        <a href="/" wire:navigate class="mt-3.5 w-full inline-flex items-center justify-center gap-2 px-3.5 py-2 rounded-lg text-xs font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700/50 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke halaman utama
        </a>
    </div>
</div>
