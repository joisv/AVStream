<div class="min-h-screen sm:mb-[25vh] mb-[7vh] p-2 lg:p-0">
    <section class="w-full h-44 p-3 flex justify-center items-end mb-5">
        <header class="lg:w-[40%] w-[80%] text-center ">
            <h1
                class="text-gray-300 hover:text-rose-500 ease-in duration-100 cursor-pointer font-extrabold text-2xl mb-3">
                Actress Collection
            </h1>
            <x-inputs.text wire:model.debounce.500ms="search" placeholder="Search actress name..." />
        </header>
    </section>
    <div class="rounded-md bg-gray-800 p-10 mb-10 min-h-fit">
        <div class="grid lg:grid-cols-6 md:grid-cols-4 gap-8 justify-center" x-cloak
            :class="screenWidth <= 410 ? 'grid-cols-2' : 'grid-cols-3'">
            @empty(!$actresses)
                @forelse ($actresses as $actress)
                    <a href="{{ route('actress', $actress->slug) }}">
                        <div class="text-white flex flex-col items-center" wire:loading.remove>
                            <div class="md:w-24 md:h-24 w-20 h-20 rounded-full overflow-hidden">
                                <img src="{{ asset('images/nyan-cat.gif') }}" alt="" srcset=""
                                    class="w-full h-full object-cover object-center">
                            </div>
                            <div class="text-center">
                                <h1 class="w-40 mt-4 text-amber-300 opacity-75 font-semibold md:text-xl text-lg">
                                    {{ $actress->name }}
                                </h1>
                                <div class="text-gray-400 font-semibold md:text-lg text-base">
                                    <h3>{{ $actress->posts->count() }} videos</h3>
                                    <h3>Debut {{ $actress->debut }}</h3>
                                </div>
                            </div>

                        </div>
                    </a>
                @empty
                    <div class="col-span-6 mx-auto">
                        <h1
                            class="text-gray-300 hover:text-rose-500 ease-in duration-100 cursor-pointer font-extrabold text-2xl mb-3">
                            No actress found
                        </h1>
                    </div>
                @endforelse

            @endempty
            <div class="col-span-6 mx-auto" wire:loading.delay>
                <div
                    class="flex items-center justify-center md:h-44 lg:h-32 xl:h-44 h-28 max-w-sm bg-gray-800 rounded-lg animate-pulse dark:bg-gray-700">
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
    </div>
    <div class="w-full">
        {{ $actresses->onEachSide(2)->links('components.paginations') }}
    </div>
</div>
