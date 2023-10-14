<div class="min-h-screen mb-20 relative" wire:init="getNotifications">
    <div class="mt-20 text-white max-w-2xl mx-auto space-y-1 h-screen overflow-y-auto">
        @empty(!$notifications)
            @forelse ($notifications as $notifi)
            <button type="button" @click="$wire.destroyAlert({{ $notifi->id }})">
                <div class="hover:bg-rose-500 hover:bg-opacity-10 p-3 ease-in duration-100 cursor-pointer z-50 text-start">
                    <h1 class="text-lg font-semibold">
                        {{ $notifi->title }}
                    </h1>
                    <p class="text-base font-medium text-gray-400">{{ $notifi->message }}</p>
                </div>
            </button>
            @empty
            <div class="min-h-[50vh] flex justify-center items-center font-bold text-3xl text-gray-300">No notifications to display</div>
            @endforelse
        @endempty
        <div class="absolute w-full left-0 -top-2 opacity-70 h-full" wire:loading.flex>
            <div class="w-full flex justify-center h-full items-center">
                <x-icons.loading-circle />
            </div>
        </div>
    </div>
</div>
