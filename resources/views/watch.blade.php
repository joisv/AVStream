<x-home-layout>
    <x-slot name="seo">
        {!! seo($post ?? null) !!}
    </x-slot>
    <livewire:watch.watch :post="$post"/>
</x-home-layout>
