@php
    $reportContent = ['Buffering occurs periodically', 'Low video quality', 'Video disconnects or stops abruptly', 'Audio and video synchronization is incorrect', 'Playback issues on specific devices', 'Disturbing ads or pop-ups', 'Display becomes unresponsive'];
@endphp
<x-modals maxWidth="md">
    <form wire:submit.prevent="save">
        <div class="space-y-2 w-full p-3 bg-background rounded-md border border-rose-500 text-white">
            <header>
                <h1 class="text-rose-500 font-medium text-xl py-3">Report this post</h1>
            </header>

            @foreach ($reportContent as $index => $report)
                <div class="flex items-center">
                    <input id="default-radio-1-{{ $index }}" type="radio" value="{{ $report }}"
                        wire:model.delay="content" name="default-radio"
                        class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-blue-500  ">
                    <label for="default-radio-1-{{ $index }}"
                        class="ml-2 text-sm font-medium ">{{ $report }}</label>
                </div>
            @endforeach
            @error('content')
                <div class="error">{{ $message }}</div>
            @enderror
            <div class=" w-full flex justify-end">
                <x-primary-button type="submit" custom="bg-rose-500 hover:bg-rose-600 focus:ring-rose-300">
                    <x-slot name="child">
                        submit
                    </x-slot>
                </x-primary-button>
            </div>
        </div>
    </form>
    <div class="absolute w-full left-0 top-0 bg-gray-400 opacity-70 h-full" wire:loading.flex>
        <div class="w-full flex justify-center h-full items-center">
            <x-icons.loading-circle />
        </div>
    </div>
</x-modals>
