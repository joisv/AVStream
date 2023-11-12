<div>
    <header class="pb-4">
        <h1 class="sm:text-3xl text-2xl text-gray-200 font-semibold">Recent Update</h1>
    </header>
    <div class="grid sm:grid-cols-3 lg:grid-cols-4 grid-cols-2 text-gray-400 gap-2">

        @if (!$isLoading)
            @forelse ($posts as $post)
                <article>
                    <a href="{{ route('watch', ['c' => $post->code]) }}">
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
        @else
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
        @endif

    </div>
@empty(!$posts)
    <div class="w-full mt-4 p-4">
        <button wire:click="loadMore" type="button" class="flex justify-center space-x-4 items-center mx-auto group" wire:loading.remove wire:target="loadMore">
            <div>
                <h3 class="text-gray-300 font-semibold text-lg sm:text-xl group-hover:text-rose-500 ease-in duration-100">load more</h3>
            </div>
            <svg class="fill-gray-300 h-7 w-7  group-hover:fill-rose-500 ease-in duration-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </button>
        <div class="w-full justify-center" wire:loading.flex wire:target="loadMore">
            <x-icons.loading-circle default="24px"/>
        </div>
    </div>
@endempty
<script>
    document.addEventListener('livewire:load', function() {

        @this.getPosts()

    })
</script>
</div>
