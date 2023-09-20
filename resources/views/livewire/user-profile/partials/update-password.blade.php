<div class="border-2 border-gray-500 sm:p-8 p-2 rounded-md">
    <h1 class="text-rose-500 font-semibold text-xl"> Update Password</h1>
    <p class="text-base text-gray-400"> Ensure your account is using a long, random password to stay secure. </p>
    <form wire:submit.prevent="save">
        <div class="mt-6 sm:w-[70%] w-full space-y-3">
            <div>
                <x-inputs.input-icon placeholder="current password" wire:model.defer="current_password" type="password">
                    <x-icons.password />
                    </x-icons.input-icon>
                    @error('current_password')
                        <div class="error mt-1">{{ $message }}</div>
                    @enderror
            </div>
            <div>
                <x-inputs.input-icon placeholder="new password" wire:model.defer="password" type="password">
                    <x-icons.password />
                    </x-icons.input-icon>
                    @error('password')
                        <div class="error mt-1">{{ $message }}</div>
                    @enderror
            </div>
            <div>
                <x-inputs.input-icon placeholder="confirm password" wire:model.defer="password_confirmation" type="password">
                    <x-icons.password />
                    </x-icons.input-icon>
                    @error('password_confirmation')
                        <div class="error mt-1">{{ $message }}</div>
                    @enderror
            </div>
        </div>
        <div class="mt-2 w-full flex justify-end">
            <x-primary-button wire:loading.attr="disabled" type="submit"
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
    <div class="fixed w-full left-0 -top-2 bg-gray-600 opacity-70 h-full" wire:loading.flex>
        <div class="w-full flex justify-center h-full items-center">
            <x-icons.loading-circle />
        </div>
    </div>
</div>
