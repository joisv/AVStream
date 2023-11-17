<x-modals>
    <div class="p-3 bg-gray-100 relative overflow-y-auto" x-data="{
        open: false,
        search: @entangle('search').defer,
        selected: @entangle('title').defer
    }" x-init="$watch('search', (value, oldValue) => {
        value ? open = true : open = false;
    });
    $watch('selected', (value, oldValue) => {
        value ? open = false : open = open
    });">
        <div class="flex justify-between">
            <div>
                <x-primary-button wire:click="addMovie" x-data type="button"
                    custom="bg-gray-700 hover:bg-gray-600 focus:ring-gray-300">
                    <x-slot name="icon">
                        <x-icons.movie />
                    </x-slot>
                    <x-slot name="child">
                        add
                    </x-slot>
                </x-primary-button>
            </div>
            @if ($title)
                <button type="button" wire:click="deleteSelected"
                    class="p-2 bg-rose-500 text-white font-medium text-sm text-center rounded-md h-fit">{{ Str::limit($title, 30, '...') }}</button>
            @endif
        </div>
        <form wire:submit.prevent="save">
            <div class=" p-2 rounded-md space-y-2">
                <x-inputs.label-input for="genres"></x-input.lable-input>
                    <div class="flex space-x-2">
                        <div class="w-11/12">
                            <x-inputs.text id="genres" wire:model="search" placeholder="search post title" />
                            @error('post_id')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
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
                    <div class="w-full max-h-[30vh] min-h-[25vh] overflow-y-auto " x-cloak x-show="open"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-10"
                        x-transition:enter-end="opacity-100 -translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 -translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-10">
                        @forelse ($posts as $post)
                            <div class="w-fit px-2 py-1 relative group">
                                <label for="{{ $post->title }}"
                                    class="select-none cursor-pointer group-hover:text-gray-400 {{ $post->id == $post_id ? 'text-gray-400' : '' }} ">{{ $post->title }}
                                    <input wire:model="post_id" type="radio" value="{{ $post->id }}"
                                        id="{{ $post->title }}" class="absolute opacity-0">
                                </label>
                            </div>
                        @empty
                            <div
                                class="col-span-3 font-semibold text-gray-500 h-[25vh] flex items-center justify-center">
                                <h3>No post found</h3>
                            </div>
                        @endforelse
                    </div>
            </div>
            @foreach ($movies as $index => $movie)
                <div>
                    <div class="sm:flex items-center sm:space-x-2 w-full" wire:key="movie-{{ $index }}">
                        <div class="flex items-end space-x-1 sm:space-x-2">
                            <label for="isVipEdit_{{ $index }}"
                                class="{{ $movies[$index]['isVip'] ? 'bg-rose-500' : 'bg-gray-400' }} h-fit p-2 relative cursor-pointer rounded-sm">
                                <input id="isVipEdit_{{ $index }}" wire:model="movies.{{ $index }}.isVip"
                                    type="checkbox" name="" class="absolute opacity-0">
                                <x-icons.crown />
                            </label>
                            <div class="space-y-2 w-full">
                                <x-inputs.label-input for="playerEdit_{{ $index }}"
                                    class="hidden sm:block">Player</x-input.lable-input>
                                    <select id="playerEdit_{{ $index }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        wire:model="movies.{{ $index }}.player">
                                        <option selected>Choose player</option>
                                        @foreach ($players as $player)
                                            <option value="{{ $player['player'] }}">{{ $player['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error("players.{$index}.player")
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="flex items-center w-full space-x-1 sm:space-x-2">
                            <div class="space-y-2 w-full">
                                <x-inputs.label-input for="nameEdit_{{ $index }}">name</x-input.lable-input>
                                    <x-inputs.text-input type="text" id="nameEdit_{{ $index }}"
                                        wire:model.defer="movies.{{ $index }}.name"
                                        placeholder="HD 720p (2gb)" />
                                    @error("movies.{$index}.name")
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                            </div>
                            <div class="space-y-2 w-full">
                                <x-inputs.label-input for="embedEdit_{{ $index }}">embed</x-input.lable-input>
                                    <x-inputs.text-input type="text" id="embedEdit_{{ $index }}"
                                        wire:model.defer="movies.{{ $index }}.url_movie"
                                        placeholder="url {{ $movies[$index]['player'] }}" />
                                    @error("movies.{$index}.url_movie")
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    @if ($movies[$index]['player'] == 'direct' || $movies[$index]['player'] == 'hls')
                        <div class="w-full space-y-1 mt-2" x-data="{ activeTab: 'upload' }">
                            <div class="flex gap-2">
                                <button type="button" @click.prevent="activeTab = 'upload'"
                                    :class="{ 'text-indigo-600': activeTab === 'upload' }" class="underline">
                                    upload
                                </button>
                                <button type="button" @click.prevent="activeTab = 'link'"
                                    :class="{ 'text-indigo-600': activeTab === 'link' }" class="underline">
                                    link
                                </button>

                            </div>
                            <div class="">
                                <div x-cloak x-show="activeTab === 'upload'">
                                    {{-- <x-inputs.label-input 
                               for="poster">Upload poster</x-inputs.label-input> --}}
                                    <input
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-sm cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none p-2"
                                        id="poster" type="file"
                                        wire:model="movies.{{ $index }}.poster">
                                    @error("movies.{$index}.poster")
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div x-cloak x-show="activeTab === 'link'">
                                    {{-- <x-inputs.label-input for="poster_link">links</x-input.lable-input> --}}
                                    <x-inputs.text-input type="text" id="poster_link_{{ $index }}"
                                        placeholder="url poster"
                                        wire:model.debounce.500ms="movies.{{ $index }}.poster" />
                                    @error("movies.{$index}.poster")
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="mt-2 pb-3 border border-b-rose-500 sm:pb-0 sm:border-0 ">
                        <x-primary-button :disabled="$index === 0" wire:click="deleteMovie({{ $index }})" x-data
                            type="button" custom="bg-yellow-500 hover:bg-yellow-600 focus:ring-yellow-300 h-fit">
                            <x-slot name="icon">
                                <x-icons.delete />
                            </x-slot>
                        </x-primary-button>
                    </div>
                </div>
            @endforeach
            <div class="mt-2 w-full flex justify-end">
                <x-primary-button type="submit" custom="bg-rose-500 hover:bg-rose-600 focus:ring-rose-300">
                    <x-slot name="icon">
                        <x-icons.create />
                    </x-slot>
                    <x-slot name="child">
                        save
                    </x-slot>
                </x-primary-button>
            </div>
        </form>
        <div class="absolute w-full left-0 top-0 h-full" wire:loading.flex wire:target="save">
            <div class="w-full flex justify-center h-full items-center">
                <x-icons.loading-circle />
            </div>
        </div>
        <div class="absolute w-full left-0 top-0 h-full" wire:loading.flex>
            <div class="w-full flex justify-center h-full items-center">
                <x-icons.loading-circle />
            </div>
        </div>
    </div>
</x-modals>
