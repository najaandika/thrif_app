<aside
    class="hidden w-72 shrink-0 border-r border-slate-200 bg-slate-50/80 px-5 py-6 transition-[width,padding] duration-300 lg:block"
    x-bind:class="collapsed ? 'w-[4.75rem] px-2.5' : 'w-72'"
>
    <div class="sticky top-6">
        <div class="mb-5 flex" x-bind:class="collapsed ? 'justify-center' : 'justify-end'">
            <button
                type="button"
                x-on:click="toggleSidebar()"
                class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 hover:text-slate-950 focus:outline-none focus:ring-4 focus:ring-slate-200"
                x-bind:aria-label="collapsed ? 'Perbesar sidebar' : 'Perkecil sidebar'"
                title="Perkecil sidebar"
            >
                <svg
                    class="h-4 w-4 transition-transform duration-300"
                    x-bind:class="collapsed ? 'rotate-180' : ''"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 6-6 6 6 6" />
                </svg>
            </button>
        </div>

        @livewire('sidebar.menu')
    </div>
</aside>
