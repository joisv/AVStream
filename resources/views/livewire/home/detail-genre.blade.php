<div class="min-h-screen md:mb-[20vh] mb-[7vh] p-2 lg:p-0">
    <section class="w-full h-44 p-3 flex justify-center items-end">
        <header class="w-[40%] text-center ">
            <h1
                class="text-gray-300 hover:text-rose-500 ease-in duration-100 cursor-pointer font-extrabold md:text-4xl sm:text-2xl text-xl mb-3">
                Watch {{ $genre->name }}
            </h1>
        </header>
    </section>
    @if ($genres->currentPage() == 1)
        <div class="flex justify-end items-center sm:px-8 px-0 my-4">
            <x-dropdown-navigation align="right" width="48">
                <x-slot name="trigger">
                    <button
                        class="inline-flex items-center px-3 py-2 border border-transparent text-base leading-4 dark:text-gray-400 bg-transparent text-gray-200 font-bold focus:outline-none transition ease-in-out duration-150">
                        <div class="hover:text-rose-400 ease-in duration-150 sm:text-lg text-base">Sort by:
                            {{ $sort === 'created_at' ? 'Recent update' : 'Most views' }}</div>

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
                                class="absolute opacity-0" wire:model.lazy="sort">
                            Recent update
                        </label>
                        <label for="views"
                            class="relative block w-full px-4 py-2 text-left text-sm font-semibold leading-5 text-gray-700 dark:text-gray-300 hover:bg-slate-300 transition duration-150 ease-in-out">
                            <input type="radio" name="" id="views" value="views"
                                class="absolute opacity-0" wire:model.lazy="sort">
                            Most view
                        </label>
                    </div>
                </x-slot>
            </x-dropdown-navigation>
        </div>
    @endif
    <div class="mb-10 sm:mx-14 mx-2 space-y-10">
        <div class="grid sm:grid-cols-3 lg:grid-cols-4 grid-cols-2 text-gray-400 gap-2">
            @forelse ($genres as $post)
                <article wire:loading.remove>
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
                <div
                    class="text-xl font-semibold text-gray-300 p-16 sm:col-span-3 lg:col-span-4 col-span-2 text-center">
                    No Jav found</div>
            @endforelse
            <div class="lg:col-span-4 sm:col-span-3 col-span-2 mx-auto" wire:loading.delay>
                <div
                    class="flex items-center justify-center md:h-44 lg:h-32 xl:h-44 h-28 max-w-sm rounded-lg animate-pulse dark:bg-gray-700">
                    <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                        <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                        <path
                            d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM9 13a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2Zm4 .382a1 1 0 0 1-1.447.894L10 13v-2l1.553-1.276a1 1 0 0 1 1.447.894v2.764Z" />
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        <div class="w-full">
            {{ $genres->onEachSide(2)->links('components.paginations') }}
        </div>
    </div>
</div>
