<div class="min-h-screen md:mb-[20vh] mb-[7vh] p-2 lg:p-0">
    <section class="w-full h-44 p-3 flex justify-center items-end">
        <header class="w-[40%] text-center ">
            <h1
                class="text-gray-300 hover:text-rose-500 ease-in duration-100 cursor-pointer font-extrabold md:text-4xl sm:text-2xl text-xl mb-3">
                Watch {{ $studio->name }}
            </h1>
        </header>
    </section>
    @if ($studios->currentPage() == 1)
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
            @forelse ($studios as $post)
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
                <div class="flex items-center justify-center md:h-44 lg:h-32 xl:h-44 h-28 ">
                    <div role="status">
                        <svg aria-hidden="true"
                            class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill" />
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full">
            {{ $studios->onEachSide(2)->links('components.paginations') }}
        </div>
    </div>
</div>
