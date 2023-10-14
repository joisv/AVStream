<x-home-layout>
    <x-slot name="seo">
        {!! seo($category ?? null) !!}
    </x-slot>
    <livewire:home.category :category="$category" />
</x-home-layout>