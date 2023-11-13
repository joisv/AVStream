@php
    $reportContent = ['Buffering occurs periodically', 'Low video quality', 'Video disconnects or stops abruptly', 'Audio and video synchronization is incorrect', 'Playback issues on specific devices', 'Disturbing ads or pop-ups', 'Display becomes unresponsive'];
@endphp
<div @closemodal.window="show = ! show">
    <form wire:submit.prevent="save">
        <div class="space-y-2 w-full p-3 bg-background border border-rose-500 text-white">
            <header>
                <h1 class="text-rose-500 font-medium text-xl py-3">Report this post</h1>
            </header>
            <button type="button" x-on:click.prevent="$dispatch('open-modal', 'close-modal')" class="text-white">close</button>

            @foreach ($reportContent as $index => $report)
                <div class="flex items-center">
                    <input id="default-radio-1-{{ $index }}" type="radio" value="{{ $report }}"
                        wire:model.defer="content" name="default-radio"
                        class="w-3 h-3 text-rose-600 bg-gray-200 focus:ring-rose-500 ">
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
    <div class="absolute w-full left-0 top-0 opacity-70 h-full" wire:loading.flex>
        <div class="w-full flex justify-center h-full items-center">
            <x-icons.loading-circle />
        </div>
    </div>
</div @openmodal.window="console.log('halo dunia')">
