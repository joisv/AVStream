<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg relative">
    <header class="flex space-x-4 items-center">
        <div>
            <h1 class="text-2xl font-semibold">Payment method</h1>
        </div>
        <div>
            <x-primary-button wire:click="addPayment" type="button"
                custom="bg-gray-700 hover:bg-gray-600 focus:ring-gray-300 ">
                <x-slot name="child">
                    add
                </x-slot>
            </x-primary-button>
        </div>
    </header>
    <form wire:submit.prevent="save">
        @foreach ($payments as $index => $payment)
            <div class="flex items-end space-x-2 w-[65%] mt-3" wire:key="payment-{{ $index }}">
                <div class=" w-full">
                    <x-inputs.label-input for="name_{{ $index }}" class="text-gray-500">Name</x-input.lable-input>
                        <x-inputs.text-input type="text" id="name_{{ $index }}"
                            wire:model.defer="payments.{{ $index }}.name" placeholder="Direct transfer" />
                        @error("payments.{$index}.name")
                            <span class="error">{{ $message }}</span>
                        @enderror
                </div>
                <div class=" w-full">
                    <x-inputs.label-input for="link_{{ $index }}" class="text-gray-500">Description</x-input.lable-input>
                        <x-inputs.text-input type="text" id="link_{{ $index }}"
                            wire:model.defer="payments.{{ $index }}.description" placeholder="Description" />
                        @error("payments.{$index}.description")
                            <span class="error">{{ $message }}</span>
                        @enderror
                </div>
                <div>
                    <x-primary-button :disabled="$index === 0" wire:click="deletePayment({{ $index }})" x-data
                        type="button" custom="bg-yellow-500 hover:bg-yellow-600 focus:ring-yellow-300 h-fit">
                        <x-slot name="icon">
                            <x-icons.delete />
                        </x-slot>
                    </x-primary-button>
                </div>
            </div>
        @endforeach
        <div class="w-full flex justify-end mt-4">
            <x-primary-button wire:loading.attr="disabled" type="submit"
                custom="disabled:opacity-50 bg-rose-500 hover:bg-rose-600 focus:ring-rose-300">
                <x-slot name="icon">
                    <x-icons.edit />
                </x-slot>
                <x-slot name="child">
                    save
                </x-slot>
            </x-primary-button>
        </div>
    </form>
    <div class="absolute w-full left-0 top-0 bg-gray-400 opacity-70 h-full" wire:loading.flex>
        <div class="w-full flex justify-center h-full items-center">
            <x-icons.loading-circle />
        </div>
    </div>
</div>
