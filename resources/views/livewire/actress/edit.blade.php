<div class="p-3 bg-gray-100 relative">
    <header class="my-4">
        <h1 class="text-gray-800 font-semibold text-xl opa">Actress Profile</h1>
        <p class="text-gray-400 font-medium">create actress informations</p>
    </header>
    <form wire:submit.prevent="save">
        <div class="space-y-2">
            <div class="col-span-full">
                <div class="mt-2 flex items-center gap-x-3">
                    @if ($profile)

                        @if (is_object($profile))
                            <div class="w-10 h-10 rounded-full overflow-hidden">
                                <img src="{{ $profile->temporaryUrl() }}" alt=""
                                    class="object-cover object-center w-full h-full">
                            </div>
                        @elseif (Str::startsWith($profile, 'profile'))
                            <div class="w-10 h-10 rounded-full overflow-hidden">
                                <img src="{{ asset('storage/' . $profile) }}" alt=""
                                    class="object-cover object-center w-full h-full">
                            </div>
                        @endif
                    @else
                        <x-icons.user />
                    @endif
                    <div>
                        <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 p-2"
                        id="logoEdit" type="file" wire:model="profile">
                    </div>

                    <div wire:loading.flex wire:target="profile" class="w-fit h-fit items-center justify-center"
                        wire:ignore>
                        <x-icons.loading />
                    </div>
                </div>
                @error('profile')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <x-inputs.text-input type="text" wire:model.defer="name" placeholder="actress name: Emi Fukada" />
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
            <x-inputs.text-input type="text" wire:model.defer="age" placeholder="age: 25" />
            @error('age')
                <span class="error">{{ $message }}</span>
            @enderror
            <x-inputs.text-input type="text" wire:model.defer="cup_size" placeholder="cup size: A to Z" />
            @error('cup_size')
                <span class="error">{{ $message }}</span>
            @enderror
            <x-inputs.text-input type="text" wire:model.defer="height" placeholder="height: 165" />
            @error('height')
                <span class="error">{{ $message }}</span>
            @enderror
            <x-inputs.text-input type="text" wire:model.defer="debut" placeholder="debut: 2015" />
            @error('debut')
                <span class="error">{{ $message }}</span>
            @enderror

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
