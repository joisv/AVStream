@php
    switch ($hasActress) {
        case '1':
            $bgActress = 'bg-rose-500';
            break;

        default:
            $bgActress = 'bg-gray-800';
            break;
    }
@endphp

<div x-data="{
    sortBy: false
}" class="min-h-screen space-y-5" wire:init="isActressExist">
    <section class="w-full md:mt-[17vh] mt-[10vh] p-3 md:flex justify-center items-center sm:px-10 px-2">
        <h1
            class="text-gray-300 hover:text-rose-500 ease-in duration-100 cursor-pointer font-extrabold md:text-4xl sm:text-2xl text-xl mb-3">
            Actress {{ $actress->name }}
        </h1>
        <header class="w-full flex flex-col items-center  bg-gray-700 bg-opacity-70 p-5 rounded-md">
            <div class="flex space-x-2">
                <div class="w-20 h-20 overflow-hidden rounded-full">
                    <img src="{{ asset('storage/' . $actress->profile) }}" alt="" srcset=""
                        class="w-full h-full object-cover object-center">
                </div>
                <div class="flex flex-col items-start">
                    <h1 class="text-white font-semibold text-xl">{{ $actress->name }}</h1>
                    <div class="text-base text-gray-500 font-semibold">
                        <div class="flex space-x-2">
                            <h1>{{ $actress->height }}</h1>
                            <p>/</p>
                            <h1>{{ $actress->cup_size }} Cup</h1>
                        </div>
                        <div class="flex space-x-2">
                            <h1>{{ $actress->debut }}</h1>
                            <h1>{{ $actress->age }} years old</h1>
                        </div>
                    </div>
                </div>
            </div>
            <button wire:click="saveActress" type="button"
                class="py-2 px-3 rounded-md flex space-x-2 items-center mt-2 disabled:bg-gray-600 {{ $bgActress }}"
                wire:loading.attr="disabled" >
                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg" wire:loading.remove wire:target="saveActress">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                    </g>
                    <g id="SVGRepo_iconCarrier">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.62436 4.4241C3.96537 5.18243 2.75 6.98614 2.75 9.13701C2.75 11.3344 3.64922 13.0281 4.93829 14.4797C6.00072 15.676 7.28684 16.6675 8.54113 17.6345C8.83904 17.8642 9.13515 18.0925 9.42605 18.3218C9.95208 18.7365 10.4213 19.1004 10.8736 19.3647C11.3261 19.6292 11.6904 19.7499 12 19.7499C12.3096 19.7499 12.6739 19.6292 13.1264 19.3647C13.5787 19.1004 14.0479 18.7365 14.574 18.3218C14.8649 18.0925 15.161 17.8642 15.4589 17.6345C16.7132 16.6675 17.9993 15.676 19.0617 14.4797C20.3508 13.0281 21.25 11.3344 21.25 9.13701C21.25 6.98614 20.0346 5.18243 18.3756 4.4241C16.7639 3.68739 14.5983 3.88249 12.5404 6.02065C12.399 6.16754 12.2039 6.25054 12 6.25054C11.7961 6.25054 11.601 6.16754 11.4596 6.02065C9.40166 3.88249 7.23607 3.68739 5.62436 4.4241ZM12 4.45873C9.68795 2.39015 7.09896 2.10078 5.00076 3.05987C2.78471 4.07283 1.25 6.42494 1.25 9.13701C1.25 11.8025 2.3605 13.836 3.81672 15.4757C4.98287 16.7888 6.41022 17.8879 7.67083 18.8585C7.95659 19.0785 8.23378 19.292 8.49742 19.4998C9.00965 19.9036 9.55954 20.3342 10.1168 20.6598C10.6739 20.9853 11.3096 21.2499 12 21.2499C12.6904 21.2499 13.3261 20.9853 13.8832 20.6598C14.4405 20.3342 14.9903 19.9036 15.5026 19.4998C15.7662 19.292 16.0434 19.0785 16.3292 18.8585C17.5898 17.8879 19.0171 16.7888 20.1833 15.4757C21.6395 13.836 22.75 11.8025 22.75 9.13701C22.75 6.42494 21.2153 4.07283 18.9992 3.05987C16.901 2.10078 14.3121 2.39015 12 4.45873Z"
                            fill="#9ca3af"></path>
                    </g>
                </svg>
                <svg aria-hidden="true" class="w-4 h-4 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-rose-500"
                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg" wire:loading.flex
                    wire:target="saveActress">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor" />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentFill" />
                </svg>
                <span class="sr-only">Loading...</span>
                <h1 class="text-gray-200 font-medium">save</h1>
            </button>
        </header>
    </section>
    <div class="flex justify-end items-center sm:px-8 px-2">
        <x-dropdown-navigation align="right" width="48">
            <x-slot name="trigger">
                <button
                    class="inline-flex items-center px-3 py-2 border border-transparent text-base leading-4 dark:text-gray-400 bg-transparent text-gray-200 font-bold focus:outline-none transition ease-in-out duration-150">
                    <div class="hover:text-rose-400 ease-in duration-150 text-base sm:text-lg">Sort by:
                        {{ $sortBy === 'created_at' ? 'Recent update' : 'Most views' }}</div>

                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <div class="space-y-1">
                    <label for="created_at"
                        class="relative block w-full px-4 py-2 text-left text-sm font-semibold leading-5 text-gray-700 dark:text-gray-300 hover:bg-slate-300 transition duration-150 ease-in-out">
                        <input type="radio" name="" id="created_at" value="created_at"
                            class="absolute opacity-0" wire:model.lazy="sortBy">
                        Recent update
                    </label>
                    <label for="views"
                        class="relative block w-full px-4 py-2 text-left text-sm font-semibold leading-5 text-gray-700 dark:text-gray-300 hover:bg-slate-300 transition duration-150 ease-in-out">
                        <input type="radio" name="" id="views" value="views" class="absolute opacity-0"
                            wire:model.lazy="sortBy">
                        Most view
                    </label>
                </div>
            </x-slot>
        </x-dropdown-navigation>
    </div>
    <div class="mb-10 sm:mx-14 mx-2 space-y-10">
        <div class="grid sm:grid-cols-3 lg:grid-cols-4 grid-cols-2 text-gray-400 gap-2">
            @forelse ($actresses as $post)
                <article>
                    <a href="{{ route('watch', ['slug' => $post->slug]) }}">
                        <div
                            class="w-full md:h-44 lg:h-32 xl:h-44 h-28 rounded-sm overflow-hidden cursor-pointer hover:opacity-90 ease-in duration-300 relative">
                            <img src="{{ asset('storage/' . $post->poster_path) }}" alt="" srcset=""
                                class="w-full h-full object-cover object-center" loading="lazy">
                            @if ($post->isVip)
                                <div
                                    class="p-1 rounded-sm bg-rose-500 absolute bottom-2 left-2 flex space-x-1 items-center">
                                    <x-icons.crown default="18px" />
                                    <p class="text-white text-xs font-semibold">VIP</p>
                                </div>
                            @endif
                        </div>
                        <h2 class="font-semibold pt-2">{{ Str::substr($post->title, 0, 35) . '...' }}</h2>
                    </a>
                </article>
            @empty
                <div wire:loading.remove
                    class="text-xl font-semibold text-gray-300 p-16 sm:col-span-3 lg:col-span-4 col-span-2 text-center">
                    No Jav found</div>
            @endforelse
            <div class="lg:col-span-4 sm:col-span-3 col-span-2 mx-auto min-h-[50vh] items-center justify-center"
                wire:loading.flex wire:target="getActresses">
                <div class="flex items-center justify-center md:h-44 lg:h-32 xl:h-44 h-28 max-w-sm">
                    <x-icons.loading-circle />
                </div>
            </div>
        </div>
        <div class="w-full">
            {{ $actresses->onEachSide(2)->links('components.paginations') }}
        </div>
    </div>
</div>
