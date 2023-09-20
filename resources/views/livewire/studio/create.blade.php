<x-modals maxWidth="sm">
    <div class="p-3 bg-gray-100 relative">
        <form wire:submit.prevent="save">
            <div class="space-y-2">
                <x-inputs.label-input for="name">Name</x-input.lable-input>
                    <x-inputs.text-input type="text" id="name" wire:model.defer="name" placeholder="Madonna" />
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
            </div>
            <div class="mt-2 w-full flex justify-end">
                <x-primary-button type="submit" custom="bg-rose-500 hover:bg-rose-600 focus:ring-rose-300">
                    <x-slot name="icon">
                        <x-icons.create />
                    </x-slot>
                    <x-slot name="child">
                        create
                    </x-slot>
                </x-primary-button>
            </div>
        </form>
        <div class="absolute w-full left-0 top-0 bg-gray-400 opacity-70 h-full" wire:loading.flex wire:target="save">
            <div class="w-full flex justify-center h-full items-center">
                <x-icons.loading-circle />
            </div>
        </div>
        <div class="absolute w-full left-0 top-0 bg-gray-400 opacity-70 h-full" wire:loading.flex>
            <div class="w-full flex justify-center h-full items-center">
                <x-icons.loading-circle />
            </div>
        </div>
    </div>
    
</x-modals>
