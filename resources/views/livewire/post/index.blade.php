<div wire:init="getPostCount">
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
                <a href="{{ route('post.create') }}">
                    <x-primary-button type="button" custom="bg-rose-500 hover:bg-rose-600 focus:ring-rose-300">
                        <x-slot name="icon">
                            <x-icons.create />
                        </x-slot>
                        <x-slot name="child">
                            create
                        </x-slot>
                    </x-primary-button>
                </a>
            </div>
        </div>
        <div class="min-h-[20vh] w-full p-2 text-white max-w-3xl mx-auto sm:grid sm:grid-cols-3 sm:gap-3 space-y-1 sm:space-y-0 justify-items-center">
            <div class="flex flex-col justify-center items-center bg-gray-900 w-full p-2">
                <h1 class="text-xl font-semibold">Total Post</h1>
                <h4>{{ $postCount }}</h4>
                <div wire:loading.flex class="w-6 h-6 items-center">
                    <x-icons.loading-circle />
                </div>
            </div>
            <div class="flex flex-col justify-center items-center bg-gray-900 w-full p-2">
                <h1 class="text-xl font-semibold">Total Post View</h1>
                <h4>{{ $postViewCount }}</h4>
                <div wire:loading.flex class="w-6 h-6 items-center">
                    <x-icons.loading-circle />
                </div>
            </div>
            <div class="flex flex-col justify-center items-center bg-gray-900 w-full p-2 space-y-2">
                <h1 class="text-xl font-semibold">Latest post updated</h1>
                <h4 class="text-center text-sm font-light">{{ Str::limit($postLatestUpdated, 50, '...') }}</h4>
                <div wire:loading.flex class="w-6 h-6 items-center">
                    <x-icons.loading-circle />
                </div>
            </div>
        </div>
        <div>
            <x-tables.table wire:loading.class.delay="opacity-75">
                <x-slot name="head">
                    <x-tables.heading sortable wire:click="sortBy('title')" :direction="$sortField === 'title' ? $sortDirection : null">
                        Title
                    </x-tables.heading>
                    <x-tables.heading>
                        Create by
                    </x-tables.heading>
                    <x-tables.heading sortable wire:click="sortBy('created_at')" :direction="$sortField === 'created_at' ? $sortDirection : null">
                        Date
                    </x-tables.heading>
                    <x-tables.heading>
                        Actions
                    </x-tables.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse ($posts as $post)
                        <x-tables.row>
                            <x-tables.cell>
                                <span class="font-medium text-base text-gray-900 break-normal">
                                    {{Str::limit( $post->title, 45, '...') }}
                                </span>
                            </x-tables.cell>
                            <x-tables.cell>
                                <div class="flex items-center">
                                    {{ $post->user->name ?? '' }}
                                </div>
                            </x-tables.cell>
                            <x-tables.cell class="whitespace-nowrap">
                                {{ $post->created_at->format('M, d Y') }}
                            </x-tables.cell>
                            <x-tables.cell>
                                <div class="flex space-x-1">
                                    <a href="{{ route('post.edit', $post) }}">
                                        <x-primary-button>
                                            <x-slot name="icon">
                                                <x-icons.edit />
                                            </x-slot>
                                        </x-primary-button>
                                    </a>
                                    <x-primary-button custom="bg-red-600 hover:bg-red-800 focus:ring-red-300"
                                        wire:click="destroyAlert({{ $post->id }})">
                                        <x-slot name="icon">
                                            <x-icons.delete />
                                        </x-slot>
                                    </x-primary-button>
                                </div>
                            </x-tables.cell>
                        </x-tables.row>
                    @empty
                        <x-tables.row>
                            <x-tables.cell colspan="4">
                                <div class="flex justify-center font-semibold text-2xl p-4">
                                    No post found...
                                </div>
                            </x-tables.cell>
                        </x-tables.row>
                    @endforelse
                </x-slot>
            </x-tables.table>
        </div>
        <div class="w-full">
            {{ $posts->links() }}
        </div>
    </div>
</div>
