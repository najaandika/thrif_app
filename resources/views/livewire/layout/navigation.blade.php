<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Str;
use App\Models\Setting;
use function Livewire\Volt\{computed};

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};

$isAdmin = computed(fn() => auth()->user()->isAdmin());
$homeUrl = computed(fn() => auth()->user()->isAdmin() ? route('dashboard') : url('/'));
$hideBrand = computed(fn() => Str::startsWith(request()->path(), 'profile'));
$shopLogo = computed(fn() => cache()->remember('shop_logo', 3600, fn() => Setting::get('shop_logo')));
$shopName = computed(fn() => cache()->remember('shop_name', 3600, fn() => Setting::get('shop_name', 'Thrif')));

?>

<nav wire:key="main-navigation" x-data="{ sidebarOpen: false }" @close-drawer.window="sidebarOpen = false" class="sticky top-0 z-30 border-b border-slate-200 bg-white/95 backdrop-blur-xl">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto max-w-[112rem] px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex min-w-0 items-center gap-3">
                <!-- Logo/Brand or Account name on profile pages -->
                @unless($this->hideBrand)
                <div class="flex min-w-0 shrink-0 items-center">
                    <a href="{{ $this->homeUrl }}" class="group flex min-w-0 items-center gap-3 rounded-2xl px-1.5 py-1 text-slate-950 transition-colors hover:text-slate-700 focus:outline-none focus:ring-4 focus:ring-slate-200">
                        @if($this->shopLogo)
                            <img src="{{ media_url($this->shopLogo) }}" alt="{{ $this->shopName }}" width="44" height="44" class="h-11 w-11 rounded-2xl object-cover ring-1 ring-slate-200 transition group-hover:ring-slate-300">
                        @else
                            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-950 text-sm font-extrabold text-white shadow-sm">
                                {{ strtoupper(substr($this->shopName, 0, 1)) }}
                            </div>
                        @endif
                        <span class="min-w-0">
                            <span class="block max-w-44 truncate text-base font-extrabold leading-5 tracking-[-0.02em] sm:max-w-none">{{ $this->shopName }}</span>
                            @if($this->isAdmin)
                                <span class="hidden text-[11px] font-bold leading-4 text-slate-400 sm:block">Admin workspace</span>
                            @endif
                        </span>
                    </a>
                </div>
                @else
                <div class="shrink-0 flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-950 text-xs font-extrabold text-white">
                        {{ strtoupper(Str::substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span class="text-base font-extrabold">{{ auth()->user()->name }}</span>
                </div>
                @endunless
            </div>

            <!-- User + Theme + Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">
                <!-- Theme Toggle -->

                <!-- Lihat Website (admin shortcut to public site) -->
                @if($this->isAdmin)
                <a href="{{ url('/') }}" target="_blank" rel="noopener" aria-label="Lihat website publik" class="inline-flex h-11 items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 text-sm font-extrabold text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 hover:text-slate-950 focus:outline-none focus:ring-4 focus:ring-slate-200">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 4h6v6M20 4l-9 9" />
                    </svg>
                    <span class="hidden sm:inline">Website</span>
                </a>
                @endif

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button aria-label="Account menu" class="inline-flex h-11 items-center gap-3 rounded-2xl border border-slate-200 bg-white px-2.5 py-2 text-sm font-bold leading-4 text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 hover:text-slate-950 focus:outline-none focus:ring-4 focus:ring-slate-200">
                            <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-slate-950 text-xs font-extrabold text-white">
                                {{ strtoupper(Str::substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="hidden text-left md:block">
                                <div class="max-w-28 truncate text-sm font-extrabold">Admin toko</div>
                                <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name" class="max-w-28 truncate text-[11px] font-bold text-slate-400"></div>
                            </div>
                            <svg class="h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.25 8.27a.75.75 0 01-.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-start">
                                <x-dropdown-link>
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </button>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger / Mobile header area -->
            <div class="-me-1 flex items-center sm:hidden">
                <button @click="sidebarOpen = !sidebarOpen" aria-label="Buka menu admin" class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-700 shadow-sm transition hover:text-slate-950 focus:outline-none focus:ring-4 focus:ring-slate-200">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': sidebarOpen, 'inline-flex': ! sidebarOpen }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 12h16M4 17h16" />
                        <path :class="{'hidden': ! sidebarOpen, 'inline-flex': sidebarOpen }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Sidebar Drawer -->
    <div x-show="sidebarOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="border-t border-slate-200 bg-white px-4 py-4 shadow-xl sm:hidden"
         style="display: none;"
         x-cloak>
        @livewire('sidebar.menu', ['mobile' => true])
    </div>

</nav>
