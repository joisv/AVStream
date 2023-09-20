<div wire:init="getSubscriptionCount" class="relative">
    <x-dropdown-link :href="route('usersubscription.log')">
        @if ($subscriptionCount > 0)
            <div class="w-5 h-5 text-sm bg-rose-500 absolute rounded-full text-center font-medium text-white -top-1 right-2">
                {{ $subscriptionCount }}</div>
        @endif
        <p class="font-semibold text-gray-200 sm:text-gray-800">Subscription Log</p>
    </x-dropdown-link>
</div>
