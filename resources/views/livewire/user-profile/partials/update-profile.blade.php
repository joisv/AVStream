<div class="border-2 border-gray-500 sm:p-8 p-2 rounded-md" wire:init="getUser">
    <h1 class="text-rose-500 font-semibold text-xl">Profile Information </h1>
    <p class="text-base text-gray-400">Update your account's profile information and email address. </p>
    <form wire:submit.prevent="save">
        <div class="mt-6 sm:w-[70%] w-full space-y-3">
            <div>
                <x-inputs.input-icon placeholder="name" wire:model.defer="name">
                    <x-icons.user default="h-8 w-8" />
                    </x-icons.input-icon>
                    @error('name')
                        <div class="error mt-1">{{ $message }}</div>
                    @enderror
            </div>
            <div>
                <x-inputs.input-icon placeholder="email" wire:model.defer="email">
                    <x-icons.email />
                    </x-icons.input-icon>
                    @error('email')
                        <div class="error mt-1">{{ $message }}</div>
                    @enderror
            </div>
        </div>

        <div class="mt-2 w-full flex justify-end">
            <x-primary-button type="submit" wire:loading.attr="disabled"
                custom="bg-rose-500 hover:bg-rose-600 focus:ring-rose-300">
                <x-slot name="icon">
                    <x-icons.create />
                </x-slot>
                <x-slot name="child">
                    save
                </x-slot>
            </x-primary-button>
        </div>
    </form>
    <div class="fixed w-full left-0 -top-2 opacity-70 h-full" wire:loading.flex>
        <div class="w-full flex justify-center h-full items-center">
            <x-icons.loading-circle />
        </div>
    </div>
</div>
