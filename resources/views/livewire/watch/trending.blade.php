<div class="h-fit lg:w-[30%] w-full px-2 sm:p-0 text-gray-300 text font-semibold relative min-h-screen sm:space-y-4 space-y-2"
    wire:init="getTrending">
    <header>
        <h1 class="text-rose-500 font-bold text-xl sm:text-2xl lg:text-xl ">Trending</h1>
    </header>
    <div class="space-y-2">
        @empty(!$recomendations)
            @forelse ($recomendations as $recomendation)
                <div>
                    <a href="{{ route('watch', ['c' => $recomendation->code]) }}">
                        <div class="flex lg:space-x-2 md:space-x-6 space-x-3 items-start">
                            <div
                                class="rounded-sm overflow-hidden w-[45%] lg:w-[55%] xl:h-32 sm:h-40 h-24 md:h-44 lg:h-20 relative bg-red-500">
                                <img src="{{ asset('storage/' . $recomendation->poster_path) }}" alt="" srcset=""
                                    class="object-cover object-center w-full">
                                @if ($recomendation->isVip)
                                    <div
                                        class="p-1 rounded-sm absolute bottom-2 left-2 flex space-x-1 items-center">
                                        <x-icons.crown default="18px" />
                                        <p class="text-white text-xs font-semibold">VIP</p>
                                    </div>
                                @endif
                            </div>
                            <div class="lg:w-[45%] w-[45%] ">
                                <h2 class="text-base sm:text-lg lg:text-sm">
                                    {{ Str::limit($recomendation->title, 25, '...') }}</h2>
                                <p class="text-gray-400 text-sm sm:text-base lg:text-sm lg:hidden xl:flex">
                                    {{ Str::limit($recomendation->overview, 40, '...') }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div>no data display</div>
            @endforelse
        @endempty
    </div>
    <div class="absolute w-full left-0 top-0 opacity-70 h-full" wire:loading.flex>
        <div class="w-full flex justify-center h-full items-center">
            <x-icons.loading-circle />
        </div>
    </div>
</div>
