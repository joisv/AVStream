<x-modals maxWidth="sm">
    <div class="p-3 bg-gray-100 relative">
        <form wire:submit.prevent="save">
            <div class="space-y-2">
                <div>
                    <x-inputs.label-input for="name">Name</x-input.lable-input>
                        <x-inputs.text-input type="text" id="name" wire:model.defer="name" placeholder="name" />
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                </div>
                <div>
                    <x-inputs.label-input for="price">Price</x-input.lable-input>
                        <x-inputs.text-input type="text" id="price" wire:model.defer="price"
                            placeholder="Price" />
                        @error('price')
                            <span class="error">{{ $message }}</span>
                        @enderror
                </div>
                <div class="flex justify-between items-center">
                    <div>
                        <x-inputs.label-input for="duration">Duration</x-input.lable-input>
                            <x-inputs.text-input type="text" id="duration" wire:model.defer="duration"
                                placeholder="duration" />
                            @error('duration')
                                <span class="error">{{ $message }}</span>
                            @enderror
                    </div>
                    <div>

                        <label for="countries"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Duration cycle</label>
                        <select id="countries"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" wire:model.defer="billing_cycle">
                            <option selected>duration</option>
                            @foreach (['month', 'year'] as $index => $billing)
                                <option value="{{ $billing }}">{{ $billing }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div>
                    <x-inputs.label-input for="description">Description</x-input.lable-input>
                        <x-inputs.text-input type="text" id="description" wire:model.defer="description"
                            placeholder="description" />
                        @error('description')
                            <span class="error">{{ $message }}</span>
                        @enderror
                </div>
            </div>
            <div class="mt-2 w-full flex justify-end">
                <x-primary-button type="submit" custom="bg-rose-500 hover:bg-rose-600 focus:ring-rose-300">
                    <x-slot name="icon">
                        <x-icons.create />
                    </x-slot>
                    <x-slot name="child">
                        Save
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

