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
                    <div role="status">
                        <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full">
        {{ $studios->onEachSide(2)->links('components.paginations') }}
    </div>
</div>
