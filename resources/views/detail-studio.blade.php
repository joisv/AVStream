<x-home-layout>
    <x-slot name="seo">
        {!! seo($studio ?? null) !!}
    </x-slot>
    <livewire:home.detail-studio :studio="$studio" />
</x-home-layout>