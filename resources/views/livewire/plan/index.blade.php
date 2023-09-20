<div>
    <div class="space-y-4">
        <div class="sm:flex sm:justify-between sm:items-center space-y-2 sm:space-y-0">
            <div class="sm:w-[40%] w-full">
                <x-inputs.text wire:model.debounce.500ms="search" placeholder="search by name" />
            </div>
            <div class="flex space-x-2 w-full justify-end">
                <div class="sm:w-[10%] w-full">
                    <select id="countries"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        wire:model="isPaginate">
                        <option value="10">10</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                    </select>
                </div>
                <x-primary-button x-data wire:click="createModal" type="button"
                    custom="bg-rose-500 hover:bg-rose-600 focus:ring-rose-300">
                    <x-slot name="icon">
                        <x-icons.create />
                    </x-slot>
                    <x-slot name="child">
                        create
                    </x-slot>
                </x-primary-button>
            </div>
        </div>
        <div class="space-y-4">
            <x-tables.table>
                <x-slot name="head">
                    <x-tables.heading sortable wire:click="sortBy('name')" :direction="$sortField === 'name' ? $sortDirection : null">
                        Name
                    </x-tables.heading>
                    <x-tables.heading sortable wire:click="sortBy('created_at')" :direction="$sortField === 'created_at' ? $sortDirection : null">
                        Date
                    </x-tables.heading>
                    <x-tables.heading sortable wire:click="sortBy('duration')" :direction="$sortField === 'duration' ? $sortDirection : null">
                        Duration
                    </x-tables.heading>
                    <x-tables.heading>
                        Price
                    </x-tables.heading>
                    <x-tables.heading>
                        Actions
                    </x-tables.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse ($plans as $plan)
                        <x-tables.row>
                            <x-tables.cell>
                                <span class="font-medium text-base text-gray-900">
                                    {{ $plan->name }}
                                </span>
                            </x-tables.cell>
                            <x-tables.cell class="whitespace-nowrap">
                                {{ $plan->created_at->format('M, d Y') }}
                            </x-tables.cell>
                            <x-tables.cell class="whitespace-nowrap">
                                <div class="flex space-x-1">
                                    <h3>
                                        {{ $plan->duration }}
                                    </h3>
                                    <h3>
                                        {{ $plan->billing_cycle }}
                                    </h3>
                                </div>
                            </x-tables.cell>
                            <x-tables.cell class="whitespace-nowrap">
                                {{ $plan->price }}
                            </x-tables.cell>
                            <x-tables.cell>
                                <div class="flex space-x-1">
                                    <x-primary-button wire:click="editModal({{ $plan }})" type="button">
                                        <x-slot name="icon">
                                            <x-icons.edit />
                                        </x-slot>
                                    </x-primary-button>
                                    <x-primary-button custom="bg-red-600 hover:bg-red-800 focus:ring-red-300"
                                        wire:click="destroyAlert({{ $plan->id }})">
                                        <x-slot name="icon">
                                            <x-icons.delete />
                                        </x-slot>
                                    </x-primary-button>
                                </div>
                            </x-tables.cell>
                        </x-tables.row>
                    @empty
                        <x-tables.row>
                            <x-tables.cell colspan="3">
                                <div class="flex justify-center font-semibold text-2xl p-4">
                                    No plans found...
                                </div>
                            </x-tables.cell>
                        </x-tables.row>
                    @endforelse
                </x-slot>
            </x-tables.table>
            <div class="w-full">
                {{ $plans->links() }}
            </div>
        </div>
        <livewire:plan.create />
        <livewire:plan.edit />
    </div>
    @push('script')
        <script>
            Livewire.on('closeModal', (data) => {
                Alpine.store('modal').on = false;
            });
        </script>
    @endpush
</div>
