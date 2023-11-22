<div x-data="{
    sortBy: false
}" class="min-h-screen space-y-5">
    <section class="w-full md:mt-[17vh] mt-[10vh] p-3 md:flex justify-center items-center sm:px-10 px-2">
        <h1
            class="text-gray-300 hover:text-rose-500 ease-in duration-100 cursor-pointer font-extrabold md:text-4xl sm:text-2xl text-xl mb-3">
            Actress {{ $actress->name }}
        </h1>
        <header class="w-full flex flex-col items-center  bg-gray-700 bg-opacity-70 p-5 rounded-md">
            <div class="flex space-x-2">
                <div class="w-20 h-20 overflow-hidden rounded-full">
                    <img data-src="{{ asset('storage/' . $actress->profile) }}" alt="" srcset=""
                        class="lazy w-full h-full object-cover object-center">
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
            <livewire:home.save-actress-btn :actressId="$actress->id"/>
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
                    <a href="{{ route('watch', ['c' => $post->code]) }}">
                        <div
                            class="w-full md:h-44 lg:h-32 xl:h-44 h-28 rounded-sm overflow-hidden cursor-pointer hover:opacity-90 ease-in duration-300 relative">
                            <img data-src="{{ asset('storage/' . $post->poster_path) }}" alt="" srcset=""
                                class="lazy w-full h-full object-cover object-center" loading="lazy">
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
