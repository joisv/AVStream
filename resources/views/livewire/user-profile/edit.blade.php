<x-home-layout>
    <x-slot name="seo">
        {!! seo($SEOData) !!}
    </x-slot>
    <div class="min-h-screen mb-20">
        <div class="mt-20 max-w-3xl h-32 mx-auto text-white space-y-4 p-2 sm:p-0">
            @can('can premium content')
                <div class="flex items-center space-x-2 h-fit p-2 rounded-md bg-rose-500 w-fit">
                    <h1 class="md:text-xl sm:text-lg text-base font-semibold text-white">VIP</h1>
                    <x-icons.crown />
                </div>
            @endcan
            <livewire:user-profile.partials.update-profile />
            <livewire:user-profile.partials.update-password />
        </div>
    </div>
</x-home-layout>
