<x-home-layout>
    <x-slot name="seo">
        {!! seo($SEOData) !!}
    </x-slot>
    <livewire:user-subscription-log :whatsapp="$setting->whatsapp_number ?? ''"/>
</x-home-layout>