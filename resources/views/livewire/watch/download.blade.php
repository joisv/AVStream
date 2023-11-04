<x-modals maxWidth="sm">
    <div class="bg-background border-rose-500 p-3 text-white overflow-hidden space-y-3"
        wire:init="getDownloads">
        <h1 class="font-semibold text-lg text-start text-rose-500">Download Quality</h1>
        {{-- regular download --}}
        <div class="space-y-5">
            <div class="text-gray-200">
                @forelse ($regularDownloads as $index => $regular)
                    <div class="flex items-center mb-4">
                        <input id="default-radio-1" type="radio" value="{{ $regular['id'] }}"
                            wire:model="selectedDownload" wire:loading.attr="disabled" name="default-radio"
                            class="w-3 h-3 text-rose-600 bg-gray-200 focus:ring-rose-500 ">
                        <label for="default-radio-1" class="ml-2 font-medium ">{{ $regular['name'] }}</label>
                    </div>
                    {{-- {{ $regular['name'] }} --}}
                @empty
                    <div class="flex items-center mb-4">
                        <label for="default-radio-1" class="ml-2 font-medium ">no download available</label>
                    </div>
                @endforelse
            </div>
            <div>
                <div class="flex space-x-1 items-center">
                    <x-icons.crown isVip="true" default="34px" />
                    <h1 class="text-rose-500 text-lg font-bold">VIP</h1>
                </div>
                <p class="text-gray-400 text-sm sm:text-base font-semibold">mengunduh konten dengan kualitas lebih tinggi dan kecepatan super
                    cepat. </p>
                <div class="space-y-3 mt-3">
                    @forelse ($vipDownloads as $index => $vip)
                        <div class="flex items-center mb-4">
                            <input id="vip-radio-{{ $index }}" type="radio" value="{{ $vip['id'] }}"
                                wire:model="selectedDownload" wire:loading.attr="disabled" name="vip-radio"
                                class="w-3 h-3 text-rose-600 bg-gray-200 focus:ring-rose-500 ">
                            <label for="vip-radio-{{ $index }}"
                                class="ml-2 font-medium">{{ $vip['name'] }}</label>
                        </div>
                    @empty
                        <div class="flex items-center mb-4">
                            <label for="default-radio-1" class="ml-2 font-medium ">no download available</label>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="mt-14 space-y-2">
                <h1 class="font-medium text-yellow-500 text-sm">Alert⚠ : If the popup doesn't appear, allow the
                    browser to open popups from this website</h1>
                <div class="w-full flex justify-end">
                    {{-- <button type="button" wire:loading.attr="disabled"
                        class="rounded-md p-1 h-10 bg-transparent text-white hover:border hover:border-rose-500 outline-none"
                        @click="$wire.modal = false">Cancel</button> --}}
                @empty(!$selectedDownload)
                    <button type="button" wire:loading.attr="disabled" wire:click="download"
                        class="rounded-md p-1 w-1/2 text-center bg-rose-500 text-white">Download</button>
                @endempty
            </div>
        </div>
    </div>
    <div class="fixed w-full left-0 -top-2 opacity-70 h-full" wire:loading.flex>
        <div class="w-full flex justify-center h-full items-center">
            <x-icons.loading-circle />
        </div>
    </div>
    <script>
        window.addEventListener('open-new-tab', event => {
            window.open(event.detail.open, '_blank');
        })
    </script>
</div>
</x-modals>
