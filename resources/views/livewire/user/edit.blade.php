<x-modals maxWidth="sm">
    <div class="p-4">
        <header>
            <h1 class="mb-2 font-medium text-gray-500 text-lg">Create new user</h1>
        </header>
        <form wire:submit.prevent="save">
            <div class="space-y-3 mb-2">
                <div class="flex space-x-2">
                    <div>
                        <x-inputs.input-icon wire:model.defer="name" id="name" type="text" name="name"
                            value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="name">
                            <x-icons.name />
                        </x-inputs.input-icon>
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-[40%]">
                        <select id="roles"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            wire:model="role">
                            <option selected>Choose Role</option>
                            @forelse ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @empty
                                <option disabled value="no roles">no roles</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                {{-- @js($user_roles) --}}
                <div class="flex space-x-2 text-sm items-center text-white w-full">
                    @empty(!$user_roles)
                        @forelse ($user_roles as $role)
                            <button type="button"
                                class="bg-gray-800 p-1 focus:ring-4 rounded-sm ring-gray-500" wire:click="deleteUserRole( '{{ $role->name }}' )">{{ $role->name }}</button>
                        @empty
                            <div class="w-full flex justify-center font-medium text-black">
                                <h1>no roles</h1>
                            </div>
                        @endforelse
                    @endempty
                </div>
            <div>
                <x-inputs.input-icon wire:model.defer="email" id="email" type="email" name="email" required
                    autocomplete="off" placeholder="jhondoe@mail.com">
                    <x-icons.email />
                </x-inputs.input-icon>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

        </div>

        <div class="flex w-full justify-end">
            <x-primary-button type="submit"
                custom="disabled:opacity-50 bg-rose-500 hover:bg-rose-600 focus:ring-rose-300">
                <x-slot name="icon">
                    <x-icons.create />
                </x-slot>
                <x-slot name="child">
                    Save
                </x-slot>
            </x-primary-button>
        </div>
    </form>
</div>
<div class="absolute w-full left-0 top-0 opacity-70 h-full" wire:loading.flex wire:target="save">
    <div class="w-full flex justify-center h-full items-center">
        <x-icons.loading-circle />
    </div>
</div>
</x-modals>
