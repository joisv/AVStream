<x-modals maxWidth="sm">
    <div class="p-4">
        <header>
            <h1 class="mb-2 font-medium text-gray-500 text-lg">Create new user</h1>
        </header>
        <form wire:submit.prevent="save">
            <div class="space-y-5">
                <div class="flex space-x-2">
                    <div>
                        <x-inputs.input-icon wire:model.defer="name" id="name" type="text" name="name"
                            :value="old('name')" required autofocus autocomplete="name" placeholder="name">
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
                            <option selected >Choose Role</option>
                            @forelse ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @empty
                                <option disabled value="no roles">no roles</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div>
                    <x-inputs.input-icon wire:model.defer="email" id="email" type="email" name="email" required autocomplete="off" placeholder="jhondoe@mail.com">
                        <x-icons.email />
                    </x-inputs.input-icon>
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-inputs.input-icon wire:model.defer="password" id="password" type="password" name="password"
                        :value="old('password')" required autocomplete="password" placeholder="password">
                        <x-icons.password />
                    </x-inputs.input-icon>
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-inputs.input-icon wire:model.defer="confirm_password" id="confirm_password" type="password"
                        name="confirm_password" :value="old('confirm_password')" required autofocus autocomplete="confirm_password"
                        placeholder="confirm_password">
                        <x-icons.password />
                    </x-inputs.input-icon>
                    @error('confirm_password')
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
                        Create
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
