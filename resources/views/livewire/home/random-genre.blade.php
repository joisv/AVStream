<div class="text-white">
    @if (!$isLoading)
        @forelse ($postGenres as $index => $post)
            <header class="pb-4 mt-5 flex justify-between items-center">
                <div>
                    <h1 class="sm:text-3xl text-2xl text-gray-200 font-semibold">{{ $post['name']->name ?? '' }}</h1>
                </div>
                <a href="{{ route('genre.show', $post['name']->name ?? '') }}"
                    class="text-gray-500 font-semibold text-xl">
                    More
                </a>
            </header>
            <div class="grid sm:grid-cols-3 lg:grid-cols-4 grid-cols-2 text-gray-400 gap-2">
                @forelse ($post['genres'] as $post)
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
                    <div
                        class="text-xl font-semibold text-gray-300 p-16 sm:col-span-3 lg:col-span-4 col-span-2 text-center">
                        No Jav found</div>
                @endforelse
            </div>
        @empty
            <div class="col-span-4">
                <h3>No jav found</h3>
            </div>
        @endforelse
    @else
        <header class="pb-4 mt-5 ">
            <div>
                <h1 class="sm:text-3xl text-2xl text-gray-200 font-semibold">Loading...</h1>
            </div>
        </header>
        <div class="grid sm:grid-cols-3 lg:grid-cols-4 grid-cols-2 text-gray-400 gap-2">
            @foreach ([1, 2, 3, 4] as $item)
                <article>
                    <div role="status"
                        class="flex items-center justify-center md:h-44 lg:h-32 xl:h-44 h-28 max-w-sm bg-gray-800 rounded-lg animate-pulse dark:bg-gray-700">
                        <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                            <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                            <path
                                d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM9 13a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2Zm4 .382a1 1 0 0 1-1.447.894L10 13v-2l1.553-1.276a1 1 0 0 1 1.447.894v2.764Z" />
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
    <script>
        document.addEventListener('livewire:load', function() {

            @this.getGenres()

        })
    </script>
</div>
