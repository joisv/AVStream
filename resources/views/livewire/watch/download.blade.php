<x-modals maxWidth="sm">
    <div class="bg-background border-rose-500 rounded-md p-3 text-white overflow-hidden space-y-3"
        wire:init="getDownloads">
        <h1 class="font-semibold text-lg text-start">Download Quality</h1>
        {{-- regular download --}}
        <div class="text-gray-200">
            @forelse ($regularDownloads as $index => $regular)
                <div class="flex items-center mb-4">
                    <input id="default-radio-1" type="radio" value="{{ $regular['id'] }}" wire:model="selectedDownload"
                        wire:loading.attr="disabled" name="default-radio"
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
            <div class="flex space-x-2 items-center">
                <svg width="34px" height="34px" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M5.82333 6.00037C6.2383 6.36683 6.5 6.90285 6.5 7.5C6.5 8.60457 5.60457 9.5 4.5 9.5C3.90285 9.5 3.36683 9.2383 3.00037 8.82333M5.82333 6.00037C5.94144 6 6.06676 6 6.2 6H17.8C17.9332 6 18.0586 6 18.1767 6.00037M5.82333 6.00037C4.94852 6.00308 4.46895 6.02593 4.09202 6.21799C3.71569 6.40973 3.40973 6.71569 3.21799 7.09202C3.02593 7.46895 3.00308 7.94852 3.00037 8.82333M3.00037 8.82333C3 8.94144 3 9.06676 3 9.2V14.8C3 14.9332 3 15.0586 3.00037 15.1767M3.00037 15.1767C3.36683 14.7617 3.90285 14.5 4.5 14.5C5.60457 14.5 6.5 15.3954 6.5 16.5C6.5 17.0971 6.2383 17.6332 5.82333 17.9996M3.00037 15.1767C3.00308 16.0515 3.02593 16.531 3.21799 16.908C3.40973 17.2843 3.71569 17.5903 4.09202 17.782C4.46895 17.9741 4.94852 17.9969 5.82333 17.9996M5.82333 17.9996C5.94144 18 6.06676 18 6.2 18H17.8C17.9332 18 18.0586 18 18.1767 17.9996M21 15.1771C20.6335 14.7619 20.0973 14.5 19.5 14.5C18.3954 14.5 17.5 15.3954 17.5 16.5C17.5 17.0971 17.7617 17.6332 18.1767 17.9996M21 15.1771C21.0004 15.0589 21 14.9334 21 14.8V9.2C21 9.06676 21 8.94144 20.9996 8.82333M21 15.1771C20.9973 16.0516 20.974 16.5311 20.782 16.908C20.5903 17.2843 20.2843 17.5903 19.908 17.782C19.5311 17.9741 19.0515 17.9969 18.1767 17.9996M20.9996 8.82333C20.6332 9.2383 20.0971 9.5 19.5 9.5C18.3954 9.5 17.5 8.60457 17.5 7.5C17.5 6.90285 17.7617 6.36683 18.1767 6.00037M20.9996 8.82333C20.9969 7.94852 20.9741 7.46895 20.782 7.09202C20.5903 6.71569 20.2843 6.40973 19.908 6.21799C19.5311 6.02593 19.0515 6.00308 18.1767 6.00037M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z"
                            stroke="#f43f5e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </svg>
                <h1 class="text-rose-500 text-lg text-start font-semibold">VIP</h1>
            </div>
            <p class="text-gray-400 font-medium">mengunduh konten dengan kualitas lebih tinggi dan kecepatan super
                cepat. </p>
            <div class="space-y-3 mt-3">
                @forelse ($vipDownloads as $index => $vip)
                    <div class="flex items-center mb-4">
                        <input id="vip-radio-{{ $index }}" type="radio" value="{{ $vip['id'] }}"
                            wire:model="selectedDownload" wire:loading.attr="disabled" name="vip-radio"
                            class="w-3 h-3 text-rose-600 bg-gray-200 focus:ring-rose-500 ">
                        <label for="vip-radio-{{ $index }}" class="ml-2 font-medium">{{ $vip['name'] }}</label>
                    </div>
                @empty
                    <div class="flex items-center mb-4">
                        <label for="default-radio-1" class="ml-2 font-medium ">no download available</label>
                    </div>
                @endforelse
            </div>
            <div class="mt-14 space-y-2">
                <h1 class="font-medium text-yellow-500 text-sm">Alert⚠ : If the popup doesn't appear, allow the
                    browser to open popups from this website</h1>
                <div class="grid grid-cols-2 gap-2">
                    <button type="button" wire:loading.attr="disabled"
                        class="rounded-md p-1 h-10 bg-transparent text-white hover:border hover:border-rose-500 outline-none"
                        @click="$wire.modal = false">Cancle</button>
                    <button type="button" wire:loading.attr="disabled" wire:click="download"
                        class="rounded-md p-1 h-10 text-center bg-rose-500 text-white">Download</a>
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
