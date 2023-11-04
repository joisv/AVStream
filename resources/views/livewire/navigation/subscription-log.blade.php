<div wire:init="getSubscriptions" class="relative">
    <x-dropdown-link :href="route('usersubscription.log')">
        @if ($isSubscriptionExist > 0)
            <div class="w-3 h-3 text-sm bg-yellow-500 absolute rounded-full text-center font-medium text-white -top-1 right-2"></div>
        @endif
        <p class="font-semibold text-gray-200 md:text-gray-800">Subscriptions</p>
    </x-dropdown-link>
</div>
