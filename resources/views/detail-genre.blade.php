<x-home-layout>
    <x-slot name="seo">
        {!! seo($genre ?? null) !!}
    </x-slot>
    <livewire:home.detail-genre :genre="$genre"/>
</x-home-layout>