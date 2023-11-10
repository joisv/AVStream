<div wire:init="getPostCount">
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
        <div
            class="min-h-[20vh] w-full p-2 text-white max-w-3xl mx-auto sm:grid sm:grid-cols sm:gap-3 space-y-1 sm:space-y-0 justify-items-center">
            <div class="flex flex-col justify-center items-center bg-gray-900 w-full p-2">
                <h1 class="text-xl font-semibold">Total Embed</h1>
                <h4 wire:loaing.remove>{{ $embedCount }}</h4>
                <div wire:loading.flex wire:target="getPostCount" class="w-6 h-6 items-center">
                    <x-icons.loading-circle />
                </div>
            </div>
        </div>
        <div class="space-y-4">
            <x-tables.table>
                <x-slot name="head">
                    <x-tables.heading sortable wire:click="sortBy('name')" :direction="$sortField === 'name' ? $sortDirection : null">
                        Name
                    </x-tables.heading>
                    <x-tables.heading sortable wire:click="sortBy('isVip')" :direction="$sortField === 'isVip' ? $sortDirection : null">
                        VIP
                    </x-tables.heading>
                    <x-tables.heading>
                        User
                    </x-tables.heading>
                    <x-tables.heading sortable wire:click="sortBy('post_title')" :direction="$sortField === 'post_title' ? $sortDirection : null">
                        Post
                    </x-tables.heading>
                    <x-tables.heading sortable wire:click="sortBy('created_at')" :direction="$sortField === 'create_at' ? $sortDirection : null">
                        Date
                    </x-tables.heading>
                    <x-tables.heading>
                        Actions
                    </x-tables.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse ($movies as $movie)
                        <x-tables.row>
                            <x-tables.cell>
                                <span class="font-medium text-base text-gray-900">
                                    {{ $movie->name }}
                                </span>
                            </x-tables.cell>
                            <x-tables.cell>
                                <div
                                    class="{{ $movie->isVip ? 'bg-rose-500' : 'bg-gray-400' }} h-fit w-fit p-2 cursor-pointer rounded-sm">
                                    <x-icons.crown />
                                </div>
                            </x-tables.cell>
                            <x-tables.cell>
                                {{ $movie->user->name ?? '' }}
                            </x-tables.cell>
                            <x-tables.cell>
                                {{ Str::limit($movie->post?->title, 35, '...') }}
                            </x-tables.cell>
                            <x-tables.cell class="whitespace-nowrap">
                                {{ $movie->created_at->format('M, d Y') }}
                            </x-tables.cell>
                            <x-tables.cell>
                                <div class="flex space-x-1">
                                    <x-primary-button wire:click="editModal({{ $movie->id }})" type="button">
                                        <x-slot name="icon">
                                            <x-icons.edit />
                                        </x-slot>
                                    </x-primary-button>
                                    <x-primary-button custom="bg-red-600 hover:bg-red-800 focus:ring-red-300"
                                        wire:click="destroyAlert({{ $movie->id }})">
                                        <x-slot name="icon">
                                            <x-icons.delete />
                                        </x-slot>
                                    </x-primary-button>
                                </div>
                            </x-tables.cell>
                        </x-tables.row>
                    @empty
                        <x-tables.row>
                            <x-tables.cell colspan="6">
                                <div class="flex justify-center font-semibold text-2xl p-4">
                                    No post found...
                                </div>
                            </x-tables.cell>
                        </x-tables.row>
                    @endforelse
                </x-slot>
            </x-tables.table>
            <div class="w-full">
                {{ $movies->links() }}
            </div>
        </div>
        <livewire:movie.create />
        <livewire:movie.edit />
        <div class="absolute w-full left-0 top-0 h-full" wire:loading.flex wire:target="editModal">
            <div class="w-full flex justify-center h-full items-center">
                <x-icons.loading-circle />
            </div>
        </div>
    </div>
</div>
