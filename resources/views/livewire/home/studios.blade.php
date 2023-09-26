<div class="min-h-screen md:mb-[25vh] mb-[7vh] p-2 lg:p-0">
    <section class="w-full h-44 p-3 flex justify-center items-end">
        <header class="lg:w-[40%] w-[80%] text-center ">
            <h1
                class="text-gray-300 hover:text-rose-500 ease-in duration-100 cursor-pointer font-extrabold text-2xl mb-3">
                Studios List
            </h1>
            <x-inputs.text wire:model.debounce.500ms="search" placeholder="Search studio name..." />
        </header>
    </section>
    <div class="rounded-md bg-gray-800 p-10 mt-14 mb-10">
        <div class="grid md:grid-cols-4 gap-8 justify-center" :class="screenWidth <= 410 ? 'grid-cols-2' : 'grid-cols-3'">
            @empty(!$studios)
                @forelse ($studios as $studio)
                    <div class="text-white flex justify-center" wire:loading.remove>
                        <div class="text-center">
                            <a href="{{ route('studio.show', $studio->slug) }}">
                                <h1 class="w-40 mt-4 text-amber-300 opacity-75 font-semibold text-xl">{{ $studio->name }}</h1>
                                <div class="text-gray-400 font-semibold text-lg">
                                    <h3>{{ $studio->posts->count() }} videos</h3>
                                </div>
                            </a>
                        </div>

                    </div>

                @empty
                    <div class="col-span-4 mx-auto">
                        <h1
                            class="text-gray-300 hover:text-rose-500 ease-in duration-100 cursor-pointer font-extrabold text-2xl mb-3">
                            No Studios found
                        </h1>
                    </div>
                @endforelse
            @endempty
            <div class="col-span-6 mx-auto" wire:loading.flex>
                <div class="flex items-center justify-center md:h-44 lg:h-32 xl:h-44 h-28 max-w-sm bg-gray-800 rounded-lg animate-pulse dark:bg-gray-700">
                    <x-icons.loading-circle />
                </div>
            </div>
        </div>
    </div>
    <div class="w-full">
        {{ $studios->onEachSide(2)->links('components.paginations') }}
    </div>
</div>
