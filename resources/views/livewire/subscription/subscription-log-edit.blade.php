<x-modals maxWidth="xl">
    <div class="bg-gray-900 border-2 border-rose-500 rounded-md p-3 text-white space-y-3 relative">
        <div class="flex space-x-2">
            <h1 class=" text-xl font-semibold">
                {{ $subscription->user->name ?? '' }}
            </h1>
            <p class="text-sm bg-rose-500 px-2 h-fit">8374kdh-23sldaq291-5280juwn6sa</p>
        </div>
        <div class="grid grid-cols-2 gap-3">
            <div
                class="border-2 border-gray-500 p-3 border-opacity-70 w-full text-center group flex flex-col justify-between">
                <div class="space-y-4">
                    <header class="flex flex-col items-center">
                        <h1 class="text-gray-400 font-semibold text-xl min-h-10">{{ $plan_duration }} {{ $plan_billing_cycle }}</h1>
                        <div class="h-1 rounded-sm mt-3 w-full bg-gradient-to-tr from-violet-800 to-rose-500"></div>
                    </header>
                    <div class=" px-3 cursor-pointer ">
                        <h1 class="md:text-5xl text-xl font-bold text-gray-200">{{ $billing_amount }}$</h1>
                        <p class="text-gray-400 text-base font-medium ">{{ $plan_description }}</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="flex space-x-2 justify-center w-full">
                    <h1 class="text-2xl font-semibold text-gray-200">{{ $payment_code }}</h1>
                    <h3 class=' bg-yellow-500 text-white px-1 text-sm text-center h-fit '>
                        {{ $status }}</h3>
                </div>

                <div class="mt-3">
                    <form wire:submit.prevent>
                        <label for="status" class="block mb-2 text-sm font-medium text-white">Select status
                            option</label>
                        <select id="status"
                            class="bg-gray-600 border border-rose-500 text-gray-200 text-sm rounded-sm focus:ring-blue-500 focus:border-rose-500 block w-full p-2"
                            wire:model.defer="status">
                            <option selected>Choose a status</option>
                            @foreach (['active', 'pending', 'cancelled', 'expired'] as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endforeach
                            @error('status')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </select>
                        <h1 class="font-medium text-yellow-500 text-sm mt-2">Warning: Changing user status to 'Active'
                            will grant user to access to premium/VIP content</h1>
                    </form>
                    <div class="absolute bottom-2 right-2">
                        <x-primary-button wire:click="save" type="button"
                            custom="disabled:opacity-50 bg-rose-500 hover:bg-rose-600 focus:ring-rose-300 ">
                            <x-slot name="icon">
                                <x-icons.create />
                            </x-slot>
                            <x-slot name="child">
                                Save
                            </x-slot>
                        </x-primary-button>
                    </div>
                </div>

            </div>
        </div>
        <div class="absolute w-full left-0 -top-2 bg-gray-400 opacity-70 h-full" wire:loading.flex>
            <div class="w-full flex justify-center h-full items-center">
                <x-icons.loading-circle />
            </div>
        </div>
    </div>
</x-modals>
