<x-home-layout>
    <x-slot name="seo">
        {!! seo($actress ?? null) !!}
    </x-slot>
    <livewire:home.detail-actress :actress="$actress"/>
</x-home-layout>
