<div>
    <div class="space-y-4">
        <div class="sm:flex sm:justify-between sm:items-center space-y-2 sm:space-y-0">
            <div class="sm:w-[40%] w-full">
                <x-inputs.text wire:model.debounce.500ms="search" placeholder="search by title" />
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
            </div>
        </div>
        <div>
            <x-tables.table wire:loading.class.delay="opacity-75">
                <x-slot name="head">
                    <x-tables.heading sortable wire:click="sortBy('title')" :direction="$sortField === 'title' ? $sortDirection : null">
                        Reported post
                    </x-tables.heading>
                    <x-tables.heading sortable wire:click="sortBy('content')" :direction="$sortField === 'content' ? $sortDirection : null">
                        Content
                    </x-tables.heading>
                    <x-tables.heading>
                        Reported by
                    </x-tables.heading>
                    <x-tables.heading sortable wire:click="sortBy('created_at')" :direction="$sortField === 'created_at' ? $sortDirection : null">
                        Date
                    </x-tables.heading>
                    <x-tables.heading>
                        Actions
                    </x-tables.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse ($reports as $report)
                        <x-tables.row>
                            <x-tables.cell>
                                <span class="font-medium text-base text-gray-900 break-normal">
                                    {{Str::limit( $report->post->title, 45, '...') }}
                                </span>
                            </x-tables.cell>
                            <x-tables.cell>
                                <div class="flex items-center">
                                    {{ $report->content ?? '' }}
                                </div>
                            </x-tables.cell>
                            <x-tables.cell>
                                <div class="flex items-center">
                                    {{ Str::limit($report->user->name, 8, '...') }}
                                </div>
                            </x-tables.cell>
                            <x-tables.cell class="whitespace-nowrap">
                                {{ $report->created_at->format('M, d Y') }}
                            </x-tables.cell>
                            <x-tables.cell>
                                <div class="flex space-x-1">
                                    <x-primary-button custom="bg-red-600 hover:bg-red-800 focus:ring-red-300"
                                        wire:click="destroyAlert({{ $report->id }})">
                                        <x-slot name="icon">
                                            <x-icons.delete />
                                        </x-slot>
                                    </x-primary-button>
                                </div>
                            </x-tables.cell>
                        </x-tables.row>
                    @empty
                        <x-tables.row>
                            <x-tables.cell colspan="5">
                                <div class="flex justify-center font-semibold text-2xl p-4">
                                    No post reported...
                                </div>
                            </x-tables.cell>
                        </x-tables.row>
                    @endforelse
                </x-slot>
            </x-tables.table>
        </div>
        <div class="w-full">
            {{ $reports->links() }}
        </div>
    </div>
</div>

