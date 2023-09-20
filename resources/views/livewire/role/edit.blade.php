<x-modals maxWidth="sm">
    <div class="p-4">
        <header>
            <h1 class="mb-2 font-medium text-gray-500 text-lg">Create new user</h1>
        </header>
        <form wire:submit.prevent="save">
            <div class="space-x-3 flex ">
                <div>
                    <x-inputs.input-icon wire:model.defer="name" id="name" type="text" name="name"
                        :value="old('name')" required autofocus autocomplete="name" placeholder="name: superadmin">
                        <x-icons.employee class="w-7 h-7 fill-gray-700" />
                    </x-inputs.input-icon>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-1/4">
                    <select id="permission"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        wire:model="permission">
                        <option disabled>Choose permission</option>
                        <option value="10">10</option>
                    </select>
                </div>
            </div>

            <div class="flex w-full justify-end">
                <x-primary-button type="submit"
                    custom="disabled:opacity-50 bg-rose-500 hover:bg-rose-600 focus:ring-rose-300">
                    <x-slot name="icon">
                        <x-icons.create />
                    </x-slot>
                    <x-slot name="child">
                        Create
                    </x-slot>
                </x-primary-button>
            </div>
        </form>
    </div>
    <div class="absolute w-full left-0 top-0 bg-gray-400 opacity-70 h-full" wire:loading.flex wire:target="save">
        <div class="w-full flex justify-center h-full items-center">
            <x-icons.loading-circle />
        </div>
    </div>
</x-modals>
