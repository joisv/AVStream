<x-home-layout>
    <x-slot name="seo">
        {!! seo($SEOData) !!}
    </x-slot>
    <livewire:home.watch-by :keyword="$keyword"/>
</x-home-layout>