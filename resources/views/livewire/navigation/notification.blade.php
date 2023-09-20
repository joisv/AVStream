<div wire:init="getNotificationCount" class="relative">
    <x-dropdown-link :href="route('notifications')">
        @if ($notification > 0)
            <div class="w-5 h-5 text-sm bg-rose-500 absolute rounded-full text-center font-medium text-white -top-1 right-2">
                {{ $notification }}</div>
        @endif
        <p class="font-semibold text-gray-200 sm:text-gray-800">Notifications</p>
    </x-dropdown-link>
</div>
