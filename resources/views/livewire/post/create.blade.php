<div class="space-y-3 " x-data="{
    open: false,
    openGenre: false,
    openStudio: false,
    search: @entangle('search').defer,
    searchGenre: @entangle('searchGenre').defer,
    searchStudio: @entangle('searchStudio').defer,
}" x-init="$watch('search', (value, oldValue) => {
    value ? open = true : open = false;
});
$watch('searchGenre', (value, oldValue) => {
    value ? openGenre = true : openGenre = false;
});
$watch('searchStudio', (value, oldValue) => {
    value ? openStudio = true : openStudio = false;
});">
    <div class="space-y-2">
        <h1 class="font-medium text-2xl">Make the changes below</h1>
        <p class="text-gray-400 w-[65%] font-light">We’re constantly trying to express ourselves and actualize
            our
            dreams. If you have the opportunity to play.</p>
    </div>
    <form wire:submit.prevent="save">
        <div class="w-full h-fit flex justify-end md:px-10 mb-4 space-x-2">
            <label for="isVip"
                class="h-fit p-2 relative cursor-pointer rounded-sm {{ $isVip ? 'bg-rose-500' : 'bg-gray-400 ' }}">
                <input id="isVip" wire:model="isVip" type="checkbox" name="" class="absolute opacity-0">
                <x-icons.crown />
            </label>
            <x-primary-button wire:loading.attr="disabled" type="submit"
                custom="disabled:opacity-50 bg-gray-800 hover:bg-gray-600 focus:ring-gray-300">
                <x-slot name="child">
                    create
                </x-slot>
            </x-primary-button>
        </div>
        <div class="lg:flex flex flex-col-reverse justify-between gap-4 w-full relative">
            <div class="space-y-1 lg:w-[35%] w-full bg-white">
                {{-- code --}}
                <div class="p-2 space-y-1">
                    <x-inputs.label-input for="code">Code</x-inputs.label-input>
                    <x-inputs.text-input type="text" id="code" placeholder="nuclear code here..."
                        wire:model.defer="code" />
                </div>
                <div class="p-2 space-y-1">
                    <div class="flex justify-between py-1 items-center">
                        <div>
                            <x-inputs.label-input for="actress">Actress</x-input.lable-input>
                        </div>
                        <div class="flex space-x-1">
                            @if ($actresses->isEmpty())
                                <div>

                                </div>
                            @else
                                <x-primary-button wire:click="createActress" type="button"
                                    custom="disabled:opacity-50 bg-gray-700 hover:bg-gray-600 focus:ring-gray-300">
                                    <x-slot name="child">
                                        create actress
                                    </x-slot>
                                </x-primary-button>
                            @endif
                            <button type="button"
                                class="focus:outline-none font-medium items-center text-sm flex w-fit h-fit p-1"
                                x-on:click="open = ! open">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                    class="ease-in duration-200" :class="open ? 'rotate-180' : ''"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M15 11L12.2121 13.7879C12.095 13.905 11.905 13.905 11.7879 13.7879L9 11M7 21H17C19.2091 21 21 19.2091 21 17V7C21 4.79086 19.2091 3 17 3H7C4.79086 3 3 4.79086 3 7V17C3 19.2091 4.79086 21 7 21Z"
                                            stroke="rgb(17 24 39)" stroke-width="2" stroke-linecap="round"></path>
                                    </g>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-10"
                        x-transition:enter-end="opacity-100 -translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 -translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-10">
                        <div>
                            <x-inputs.text wire:model="search" placeholder="search actress" />
                        </div>
                        <div class="w-full max-h-[30vh] min-h-[25vh] grid mx-auto grid-cols-3 gap-1 overflow-y-auto ">

                            @forelse ($actresses as $actress)
                                <div class="w-fit px-2 py-1 relative group">
                                    <label for="{{ $actress->name }}"
                                        class="select-none cursor-pointer group-hover:text-gray-400  {{ in_array($actress->id, $selectedActresses) ? 'text-gray-400' : '' }} ">{{ $actress->name }}
                                        <input wire:model="selectedActresses" type="checkbox"
                                            value="{{ $actress->id }}" id="{{ $actress->name }}"
                                            class="absolute opacity-0">
                                    </label>
                                </div>
                            @empty
                                <div
                                    class="col-span-3 font-semibold text-gray-500 h-full flex items-center justify-center">
                                    <div class="flex space-x-2 items-center">
                                        <h3>No actress found</h3>
                                        <x-primary-button wire:click="createActress" type="button"
                                            custom="disabled:opacity-50 bg-gray-700 hover:bg-gray-600 focus:ring-gray-300">
                                            <x-slot name="child">
                                                create actresses
                                            </x-slot>
                                        </x-primary-button>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                {{-- genres --}}
                <div class="p-2 space-y-2">
                    <div class="flex justify-between items-center">
                        <div>
                            <x-inputs.label-input for="genres">Genres</x-input.lable-input>
                        </div>
                        <div class="flex space-x-1">
                            @if ($genres->isEmpty())
                                <div></div>
                            @else
                                <x-primary-button wire:click="createGenre" type="button"
                                    custom="disabled:opacity-50 bg-gray-700 hover:bg-gray-600 focus:ring-gray-300">
                                    <x-slot name="child">
                                        create genre
                                    </x-slot>
                                </x-primary-button>
                            @endif
                            <button type="button"
                                class="focus:outline-none font-medium items-center text-sm flex w-fit h-fit p-1"
                                x-on:click="openGenre = ! openGenre">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                    class="ease-in duration-200" :class="openGenre ? 'rotate-180' : ''"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                    </g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M15 11L12.2121 13.7879C12.095 13.905 11.905 13.905 11.7879 13.7879L9 11M7 21H17C19.2091 21 21 19.2091 21 17V7C21 4.79086 19.2091 3 17 3H7C4.79086 3 3 4.79086 3 7V17C3 19.2091 4.79086 21 7 21Z"
                                            stroke="rgb(17 24 39)" stroke-width="2" stroke-linecap="round">
                                        </path>
                                    </g>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div x-cloak x-show="openGenre" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-10"
                        x-transition:enter-end="opacity-100 -translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 -translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-10">
                        <div>
                            <x-inputs.text id="genres" wire:model="searchGenre" placeholder="search genre" />
                        </div>
                        <div class="w-full max-h-[30vh] min-h-[25vh] grid mx-auto grid-cols-3 gap-1 overflow-y-auto ">
                            @forelse ($genres as $genre)
                                <div class="w-fit px-2 py-1 relative group">
                                    <label for="{{ $genre->name }}"
                                        class="select-none cursor-pointer group-hover:text-gray-400  {{ in_array($genre->id, $selectedGenres) ? 'text-gray-400' : '' }} ">{{ $genre->name }}
                                        <input wire:model="selectedGenres" type="checkbox"
                                            value="{{ $genre->id }}" id="{{ $genre->name }}"
                                            class="absolute opacity-0">
                                    </label>
                                </div>
                            @empty
                                <div
                                    class="col-span-3 font-semibold text-gray-500 h-full flex items-center justify-center">
                                    <div class="flex space-x-2 items-center">
                                        <h3>No genres found</h3>
                                        <x-primary-button wire:click="createGenre" type="button"
                                            custom="disabled:opacity-50 bg-gray-700 hover:bg-gray-600 focus:ring-gray-300">
                                            <x-slot name="child">
                                                create genre
                                            </x-slot>
                                        </x-primary-button>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                {{-- studio --}}
                <div class="p-2 space-y-2">
                    <div class="flex justify-between items-center">
                        <x-inputs.label-input for="genres">Studio</x-input.lable-input>
                            <div class="flex space-x-1">
                                @if ($studios->isEmpty())
                                    <div></div>
                                @else
                                    <x-primary-button wire:click="createStudio" type="button"
                                        custom="disabled:opacity-50 bg-gray-700 hover:bg-gray-600 focus:ring-gray-300">
                                        <x-slot name="child">
                                            create studio
                                        </x-slot>
                                    </x-primary-button>
                                @endif
                                <button type="button"
                                    class="focus:outline-none font-medium items-center text-sm flex w-fit h-fit p-1"
                                    x-on:click="openStudio = ! openStudio">
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                        class="ease-in duration-200" :class="openStudio ? 'rotate-180' : ''"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M15 11L12.2121 13.7879C12.095 13.905 11.905 13.905 11.7879 13.7879L9 11M7 21H17C19.2091 21 21 19.2091 21 17V7C21 4.79086 19.2091 3 17 3H7C4.79086 3 3 4.79086 3 7V17C3 19.2091 4.79086 21 7 21Z"
                                                stroke="rgb(17 24 39)" stroke-width="2" stroke-linecap="round">
                                            </path>
                                        </g>
                                    </svg>
                                </button>
                            </div>
                    </div>
                    <div x-cloak x-show="openStudio" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-10"
                        x-transition:enter-end="opacity-100 -translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 -translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-10">
                        <div>
                            <x-inputs.text id="genres" wire:model="searchStudio" placeholder="search studio" />
                        </div>

                        <div class="w-full max-h-[30vh] min-h-[25vh] grid mx-auto grid-cols-3 gap-1 overflow-y-auto "\>
                            @forelse ($studios as $studio)
                                <div class="w-fit px-2 py-1 relative group">
                                    <label for="{{ $studio->name }}"
                                        class="select-none cursor-pointer group-hover:text-gray-400  {{ in_array($studio->id, $selectedStudio) ? 'text-gray-400' : '' }} ">{{ $studio->name }}
                                        <input wire:model="selectedStudio" type="checkbox" value="{{ $studio->id }}"
                                            id="{{ $studio->name }}" class="absolute opacity-0">
                                    </label>
                                </div>
                            @empty
                                <div
                                    class="col-span-3 font-semibold text-gray-500 h-full flex items-center justify-center">
                                    <div class="flex space-x-2 items-center">
                                        <h3>No studio found</h3>
                                        <x-primary-button wire:click="createGenre" type="button"
                                            custom="disabled:opacity-50 bg-gray-700 hover:bg-gray-600 focus:ring-gray-300">
                                            <x-slot name="child">
                                                create studio
                                            </x-slot>
                                        </x-primary-button>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="flex rounded-md flex-col items-center group cursor-pointer p-2">
                    <div class="flex flex-col items-center relative">
                        @error('poster_path')
                            <span class="error">{{ $message }}</span>
                        @enderror
                        @if ($poster_path)
                            <img src="{{ $poster_path->temporaryUrl() }}" alt=""
                                class="w-[95%] h-48 object-scale-down rounded-md group-hover:-translate-y-20 ease-in duration-200 z-30">
                        @else
                            <img src="https://images.unsplash.com/photo-1502759683299-cdcd6974244f?auto=format&fit=crop&w=440&h=220&q=60"
                                alt=""
                                class="w-[95%] h-48 object-scale-down rounded-md group-hover:-translate-y-20 ease-in duration-200 z-30 ">
                        @endif

                        <div class="flex space-x-2 absolute top-2/3">
                            <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 p-2"
                            id="logo" type="file" wire:model="poster_path">
                        </div>
                    </div>
                    <div class="text-center flex flex-col items-center">
                        <div class="flex items-center space-x-3">
                            <h3 class="text-xl font-medium text-gray-600">Poster Image</h3>
                            <div wire:loading.flex wire:target="poster_path"
                                class="w-fit h-fit items-center justify-center" wire:ignore>
                                <x-icons.loading />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class=" bg-white h-fit lg:absolute lg:w-[55%] w-full lg:right-14 lg:top-0 p-2 space-y-4">
                <div class="sm:flex sm:space-x-2 space-y-2 sm:space-y-0">
                    <div class="sm:w-[70%] w-full space-y-2">
                        <x-inputs.label-input for="title">Title</x-input.lable-input>
                            <x-inputs.text-input type="text" id="title" placeholder="title here"
                                wire:model.defer="title" />
                            @error('title')
                                <span class="error">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="sm:w-[30%] w-full sm:space-y-2 space-y-1">
                        <x-inputs.label-input for="category_id">Category</x-input.lable-input>
                            <select id="category"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                wire:model="category_id">
                                <option>Choose a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="error">{{ $message }}</span>
                            @enderror
                    </div>
                </div>
                <div>
                    <x-inputs.label-input for="overview">Overview</x-text.label-input>
                        <x-inputs.textarea id="overview" wire:model.defer="overview" />
                </div>
                @error('overview')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </form>
    <x-modals maxWidth="sm">
        <livewire:actress.create />
    </x-modals>
    <livewire:genre.create />
    <livewire:studio.create />
</div>
