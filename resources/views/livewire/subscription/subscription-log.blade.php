<div class=" h-32 mx-auto p-3 space-y-2">
    <div class="sm:flex sm:justify-between sm:items-center space-y-2 sm:space-y-0">
        <div class="sm:w-[40%] w-full">
            <x-inputs.text wire:model.debounce.500ms="search" placeholder="search by name" />
        </div>
        <div class="flex space-x-2 w-full justify-end">
            @if ($subscriptions->currentPage() == 1)
                <div class="min-w-[20%] w-fit">
                    <select id="countries"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        wire:model="isPaginate">
                        <option value="10">10</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                    </select>
                </div>
                <div class="sm:w-[10%] w-full ">
                    <select id="countries"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        wire:model="sortField">
                        <option value="created_at">Newes</option>
                        <option value="updated_at">Recent update</option>
                        <option value="active">active</option>
                        <option value="pending">pending</option>
                        <option value="expired">expired</option>
                    </select>
                </div>
            @endif
        </div>
    </div>
    {{-- @empty(!$subscriptions)
        @forelse ($subscriptions as $subscribe)
            <div class="bg-gray-800 w-full py-2 px-4" >
                <button wire:click="editSubscription('{{ $subscribe->id }}')" class="w-full">
                    <div class="flex justify-between items-center">
                        <div class="flex space-x-2">
                            <h1 class="sm:text-2xl text-xl font-semibold text-gray-200">{{ $subscribe->payment_code }}</h1>
                            <h3
                                class='{{ $subscribe->status === 'active' ? 'bg-rose-500 text-white' : ($subscribe->status === 'pending' ? 'bg-yellow-500 text-white' : ($subscribe->status === 'expired' ? 'bg-white text-black' : '')) }} px-1 text-sm text-center h-fit '>
                                {{ $subscribe->status }}</h3>
                        </div>
                        <div>
                            <h2 class="text-gray-300 font-medium text-lg">{{ $subscribe->user->name ?? '' }}</h2>
                        </div>
                    </div>
                    <div class="space-y-1 mt-3 sm:grid sm:grid-cols-2">
                        <div class="flex space-x-1 h-fit col-span-2 text-start sm:text-center">
                            <h1 class="font-medium text-gray-200">User Id:</h1>
                            <h2 class="text-rose-400 font-medium">{{ $subscribe->user_id }}</h2>
                        </div>
                        <div class="flex space-x-1 h-fit">
                            <h1 class="font-medium text-gray-200">Start Date:</h1>
                            <h2 class="text-rose-400 font-medium">{{ $subscribe->start_date }}</h2>
                        </div>
                        <div class="flex space-x-1 h-fit">
                            <h1 class="font-medium text-gray-200">End Date:</h1>
                            <h2 class="text-rose-400 font-medium">{{ $subscribe->end_date }}</h2>
                        </div>
                        <div class="flex space-x-1 h-fit">
                            <h1 class="font-medium text-gray-200">Blling Amount:</h1>
                            <h2 class="text-rose-400 font-medium">{{ $subscribe->billing_amount }} $</h2>
                        </div>
                        <div class="flex space-x-1 h-fit">
                            <h1 class="font-medium text-gray-200">Payment Method:</h1>
                            <h2 class="text-rose-400 font-medium">{{ $subscribe->payment_method }}</h2>
                        </div>
                    </div>
                </button>
            </div>
        @empty
            <div class="min-h-[50vh] flex justify-center items-center font-bold text-3xl">No Log to display</div>
        @endforelse
    @endempty --}}
    <div>
        <x-tables.table wire:loading.class.delay="opacity-75">
            <x-slot name="head">
                <x-tables.heading>
                    Name
                </x-tables.heading>
                <x-tables.heading>
                    status
                </x-tables.heading>
                <x-tables.heading>
                    Billing amount
                </x-tables.heading>
                <x-tables.heading>
                    Payment method
                </x-tables.heading>
                <x-tables.heading>
                    Date
                </x-tables.heading>
                <x-tables.heading>
                    Actions
                </x-tables.heading>
            </x-slot>
            <x-slot name="body">
                @empty(!$subscriptions)
                    @forelse ($subscriptions as $subscription)
                        <x-tables.row>
                            <x-tables.cell>
                                <div class="font-medium text-base text-gray-900">
                                    {{ $subscription->user->name ?? '' }}
                                </div>
                                <div class="font-light text-gray-500 text-sm">
                                    {{ $subscription->payment_code }}
                                </div>
                            </x-tables.cell>
                            <x-tables.cell>
                                <div class="flex items-center">
                                    <div
                                        class="h-2.5 w-2.5 rounded-full mr-2 {{ $subscription->status === 'active' ? 'bg-rose-500 text-white' : ($subscription->status === 'pending' ? 'bg-yellow-500 text-white' : ($subscription->status === 'expired' ? 'bg-white text-black' : '')) }}">
                                    </div>
                                    {{ $subscription->status }}
                                </div>
                            </x-tables.cell>
                            <x-tables.cell>
                                {{ $subscription->billing_amount }}
                            </x-tables.cell>
                            <x-tables.cell>
                                {{ $subscription->payment_method }}
                            </x-tables.cell>
                            <x-tables.cell>
                                <div>
                                    <div class="flex space-x-2">
                                        <div>
                                            <h1>Start date</h1>
                                        </div>
                                        <div>
                                            {{ $subscription->start_date }}
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <div>
                                            <h1>End date</h1>
                                        </div>
                                        <div>
                                            {{ $subscription->end_date }}
                                        </div>
                                    </div>
                                </div>
                            </x-tables.cell>
                            <x-tables.cell>
                                <div class="flex space-x-1">
                                    <x-primary-button wire:click="editSubscription('{{ $subscription->id }}')">
                                        <x-slot name="icon">
                                            <x-icons.edit />
                                        </x-slot>
                                    </x-primary-button>
                                </div>
                            </x-tables.cell>
                        </x-tables.row>
                    @empty
                        <x-tables.row>
                            <x-tables.cell colspan="5">
                                <div class="flex justify-center font-semibold text-2xl p-4">
                                    No user found...
                                </div>
                            </x-tables.cell>
                        </x-tables.row>
                    @endforelse
                @endempty
            </x-slot>
        </x-tables.table>
    </div>
    <div class="w-full">
        {{ $subscriptions->links() }}
    </div>
    @if ($modal)
        <livewire:subscription.subscription-log-edit />
    @endif
    <div class="absolute w-full left-0 -top-2 bg-transparent opacity-70 h-full" wire:loading.flex>
        <div class="w-full flex justify-center h-full items-center">
            <x-icons.loading-circle />
        </div>
    </div>
</div>
