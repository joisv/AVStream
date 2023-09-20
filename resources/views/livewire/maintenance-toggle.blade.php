@php
    $admin = auth()
        ->user()
        ->hasRole('admin');
@endphp
<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg space-y-4">
    <h1 class="text-xl font-semibold">Switch maintenance mode</h1>
    <div class="space-y-3">
        @if ($admin)
            <button wire:click="toggleMaintenance()" wire:loading.attr="disabled"
                class="p-1 rounded-sm text-white focus:ring-4 focus:ring-rose-500 flex items-center hover:ring-4 hover:ring-rose-500 ease-in duration-150 {{ $maintenanceMode ? 'bg-gray-500' : 'bg-rose-500' }}">
                <div wire:loading>
                    <x-icons.loading-circle default="18px" />
                </div>
                {{ $maintenanceMode ? 'Disable Maintenance Mode' : 'Enable Maintenance Mode' }}
            </button>
        @endif
        <div class="font-semibold">
            <h1 class="text-gray-500 font-medium">Status: <span
                    class=" {{ $maintenanceMode ? 'text-green-600' : 'text-rose-500' }}">{{ $maintenanceMode ? 'Enable' : 'Disable' }}</span>
            </h1>
            @if ($admin)
                <p class="text-gray-500 font-medium">secret: <span class="text-black">{{ $secret }}</span></p>
            @endif
        </div>
    </div>
    <h1 class="font-semibold text-yellow-600 text-base rounded-sm p-2 bg-rose-300 bg-opacity-75mt-2 ">Alert⚠ : <span class="text-gray-800 font-medium">To allow maintenance mode to be bypassed using a secret token, you may use the secret option to specify a maintenance mode bypass token: <span class="text-black underline">https://example.com/your-secret-maintenance-code</span></span></h1>
</div>
