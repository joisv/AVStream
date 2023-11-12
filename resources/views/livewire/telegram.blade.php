<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg space-y-4 relative">
    <h1 class="text-xl font-semibold">Telegram bot</h1>
    <form wire:submit.prevent="save">
        <div class="space-y-3 md:w-[65%] w-full">
            <div class="space-y-2">
                <x-inputs.label-input for="chat_id" class="text-gray-500">Chat id</x-inputs.label-input>
                <x-inputs.text-input id="chat_id" wire:model.defer="chat_id" placeholder="youre chat id" />
            </div>
            <div class="space-y-2">
                <x-inputs.label-input for="token" class="text-gray-500">Bot token</x-inputs.label-input>
                <x-inputs.text-input id="token" wire:model.defer="token" placeholder="your bot token" />
            </div>

        </div>
        <div class="w-full flex justify-end mt-4 md:mt-0">
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
    <div class="absolute w-full left-0 -top-4 bg-gray-400 opacity-70 h-full"  wire:loading.flex wire:target="save">
        <div class="w-full flex justify-center h-full items-center">
            <x-icons.loading-circle />
        </div>
    </div>
</div>
