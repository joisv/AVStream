<div class="space-y-2">

    <header>
            <h1>Most Watch</h1>
    </header>
    <div class="text-sm p-1">
        @forelse ($mostWatched as $item)
            <div class="flex space-x-3 items-center border-b-2 border-gray-500 py-2">
                <x-icons.eye stroke="#f43f5e" />
                <div class="w-[95%] space-y-2">
                    <div>
                        <h1 class="font-light">{{ $item->title }}</h1>
                    </div>
                    <div>
                        <span>{{ number_format($item->views) }}</span>
                    </div>
                </div>
            </div>
        @empty
        @endforelse
    </div>
</div>
