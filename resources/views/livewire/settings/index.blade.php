<div class="settings-wrapper">
    @if (session()->has('message'))
        <div class="alert-container">
            <div class="alert-message">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-semibold">{{ session('message') }}</span>
                </div>
            </div>
        </div>
    @endif
    <div class="settings-layout">
        <x-sidebar />
        <div class="settings-content">
            <div class="settings-card">
                <div class="settings-card-body">
                    <div class="settings-header">
                        <h2 class="settings-title">Settings</h2>
                        <p class="settings-subtitle">Kelola informasi toko dan branding.</p>
                    </div>
                    <div class="tab-navigation">
                            <div class="flex space-x-2 mb-6">
                                    <button type="button" wire:click="$set('activeTab', 'shop')" class="px-4 py-2 rounded-xl font-semibold text-sm text-gray-700 dark:text-white focus:outline-none transition-all duration-200 shadow-sm hover:shadow-md"
                                        :class="$activeTab === 'shop' ? 'bg-slate-700' : 'bg-transparent hover:bg-slate-800'">
                                        Informasi Toko
                                    </button>
                                    <button type="button" wire:click="$set('activeTab', 'social')" class="px-4 py-2 rounded-xl font-semibold text-sm text-gray-700 dark:text-white focus:outline-none transition-all duration-200 shadow-sm hover:shadow-md"
                                        :class="$activeTab === 'social' ? 'bg-slate-700' : 'bg-transparent hover:bg-slate-800'">
                                        Social Media
                                    </button>
                                    <button type="button" wire:click="$set('activeTab', 'operational')" class="px-4 py-2 rounded-xl font-semibold text-sm text-gray-700 dark:text-white focus:outline-none transition-all duration-200 shadow-sm hover:shadow-md"
                                        :class="$activeTab === 'operational' ? 'bg-slate-700' : 'bg-transparent hover:bg-slate-800'">
                                        Operasional
                                    </button>
                                    <button type="button" wire:click="$set('activeTab', 'about')" class="px-4 py-2 rounded-xl font-semibold text-sm text-gray-700 dark:text-white focus:outline-none transition-all duration-200 shadow-sm hover:shadow-md"
                                        :class="$activeTab === 'about' ? 'bg-slate-700' : 'bg-transparent hover:bg-slate-800'">
                                        Tentang Kami
                                    </button>
                            </div>
                    </div>
                    <form wire:submit="save" class="settings-form">
                        @if($activeTab === 'shop')
                            @include('livewire.settings.shop')
                        @elseif($activeTab === 'social')
                            @include('livewire.settings.social')
                        @elseif($activeTab === 'operational')
                            @include('livewire.settings.operational')
                        @elseif($activeTab === 'about')
                            @include('livewire.settings.about')
                        @endif
                        <div class="submit-section">
                                <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-slate-700 hover:bg-slate-800 border border-transparent rounded-xl font-semibold text-sm text-white uppercase tracking-wider transition-all shadow-lg hover:shadow-xl">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    SIMPAN PERUBAHAN
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>