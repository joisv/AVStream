<x-home-layout>
    <x-slot name="seo">
        {!! seo($SEOData) !!}
    </x-slot>
    <div class="min-h-screen mb-[35vh]">
        <main class="space-y-8 p-2 sm:p-0 mt-3">
            <livewire:home.popular-genres />
            <livewire:home.recomended />
            <livewire:home.new-release />
            <livewire:home.recent-update />
        </main>
    </div>
</x-home-layout>
