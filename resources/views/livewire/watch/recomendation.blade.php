<div class="py-6 space-y-3" wire:init="getRecomendations">
    <header>
        <h1 class="text-rose-500 font-bold sm:text-2xl text-xl">Recomendation</h1>
    </header>
    <div class="grid sm:grid-cols-3 lg:grid-cols-4 grid-cols-2 text-gray-400 gap-2 relative">
        @empty(!$recomendations)
            @forelse ($recomendations as $post)
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
                <div class="text-xl font-semibold text-gray-300 p-16 sm:col-span-3 lg:col-span-4 col-span-2 text-center">
                    No Jav found</div>
            @endforelse
        @endempty
        <div class="sm:col-span-3 lg:col-span-4 col-span-2  h-full min-h-[50vh]" wire:loading>
            <div class="w-full flex justify-center h-full items-center">
                <x-icons.loading-circle />
            </div>
        </div>
    </div>
</div>
