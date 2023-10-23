<x-home-layout>
    <x-slot name="seo">
        {!! seo($SEOData) !!}
    </x-slot>
    <livewire:home.search :keyword="$keyword" />
</x-home-layout>