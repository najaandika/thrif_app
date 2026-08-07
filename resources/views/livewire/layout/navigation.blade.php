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

<nav wire:key="main-navigation" x-data="{ open: false, sidebarOpen: false }" class="bg-white dark:bg-gray-800 sticky top-0 z-30">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-2">
                <!-- Hamburger Button (Mobile) - di header samping logo -->
                <button @click="sidebarOpen = !sidebarOpen" aria-label="Toggle sidebar menu" class="lg:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': sidebarOpen, 'inline-flex': ! sidebarOpen }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! sidebarOpen, 'inline-flex': sidebarOpen }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                
                <!-- Logo/Brand or Account name on profile pages -->
                @unless($this->hideBrand)
                <div class="shrink-0 hidden sm:flex items-center">
                    <a href="{{ $this->homeUrl }}" class="flex items-center gap-2 text-gray-900 dark:text-gray-100 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                        @if($this->shopLogo)
                            <img src="{{ media_url($this->shopLogo) }}" alt="{{ $this->shopName }}" width="32" height="32" class="w-8 h-8 rounded-lg object-cover shadow-lg">
                        @else
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm shadow-lg">
                                {{ strtoupper(substr($this->shopName, 0, 1)) }}
                            </div>
                        @endif
                        <span class="text-lg font-semibold hidden sm:block">{{ $this->shopName }}</span>
                    </a>
                </div>
                @else
                <div class="shrink-0 flex items-center gap-3">
                    <div class="h-8 w-8 rounded-full bg-indigo-500 text-white flex items-center justify-center text-xs font-semibold">
                        {{ strtoupper(Str::substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span class="text-lg font-semibold">{{ auth()->user()->name }}</span>
                </div>
                @endunless
            </div>

            <!-- User + Theme + Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">
                <!-- Theme Toggle -->

                <!-- Lihat Website (admin shortcut to public site) -->
                @if($this->isAdmin)
                <a href="{{ url('/') }}" target="_blank" rel="noopener" aria-label="Lihat Website (buka di tab baru)" class="inline-flex items-center gap-2 h-9 sm:h-10 px-3 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 text-sm font-medium transition">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2z" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M3 12h18" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span class="hidden sm:inline">Lihat Website</span>
                </a>
                @endif

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button aria-label="Account menu" class="inline-flex items-center gap-2 h-9 sm:h-10 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-600 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="h-8 w-8 rounded-full bg-indigo-500 text-white flex items-center justify-center text-xs font-semibold">
                                {{ strtoupper(Str::substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                            <svg class="ms-1 h-4 w-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
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
            <div class="-me-2 flex items-center sm:hidden gap-2">
                <!-- Theme Toggle (Mobile) -->

                <!-- Mobile header: nama akun -->
                <a href="{{ route('profile') }}" class="flex items-center gap-2 px-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                    <div class="h-8 w-8 rounded-full bg-indigo-500 text-white flex items-center justify-center text-xs font-semibold">
                        {{ strtoupper(Str::substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="font-medium text-sm text-gray-800 dark:text-gray-200">{{ auth()->user()->name }}</div>
                </a>
            </div>
        </div>
    </div>

    <!-- Mobile Sidebar Drawer -->
    <div x-show="sidebarOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-gray-900/50 z-40 lg:hidden"
         style="display: none;"
         x-cloak>
    </div>
    
    <div x-show="sidebarOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full"
         @click.away="sidebarOpen = false"
         class="fixed inset-y-0 left-0 w-64 bg-white dark:bg-gray-800 shadow-xl z-50 lg:hidden transform"
         style="display: none;"
         x-cloak>
        <div class="h-full overflow-y-auto pt-20">
            <x-sidebar.menu />
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-100 dark:border-gray-700">
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="mt-3 space-y-1 px-4">
                {{-- Top: Profile (compact: avatar + label) --}}
                <x-responsive-nav-link :href="route('profile')">
                    <div class="flex items-center gap-3">
                        <div class="h-8 w-8 rounded-full bg-indigo-500 text-white flex items-center justify-center text-xs font-semibold">
                            {{ strtoupper(\Illuminate\Support\Str::substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ auth()->user()->name }}</div>
                    </div>
                </x-responsive-nav-link>

                {{-- Top: Lihat Website shortcut --}}
                @if($this->isAdmin)
                <x-responsive-nav-link :href="url('/')" target="_blank" rel="noopener" aria-label="Lihat Website (buka di tab baru)">
                    {{ __('Lihat Website') }}
                </x-responsive-nav-link>
                @endif

                {{-- End of responsive items: only Profile + Lihat Website on mobile --}}
            </div>
        </div>
    </div>
</nav>

