<x-layouts.landing>
    <div class="w-full max-w-6xl mx-auto px-4 pt-12 pb-3 sm:px-6 lg:px-8">
        @if (session('status'))
            <x-alert :message="session('status')" type="success" />
        @endif

        @if (session('error'))
            <x-alert :message="session('error')" type="error" />
        @endif

        @include('landing.sections.hero', [
            'featuredProducts' => $featuredProducts,
            'hasMoreProducts' => $hasMoreProducts,
        ])

        <section class="mt-14 md:mt-20 grid gap-6 lg:gap-8 lg:grid-cols-2 items-stretch">
            @include('landing.sections.about')
            @include('landing.sections.contact')
        </section>
    </div>
</x-layouts.landing>

