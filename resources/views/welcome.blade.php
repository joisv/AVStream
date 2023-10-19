<x-home-layout>
    <x-slot name="seo">
        {!! seo($SEOData) !!}
    </x-slot>
    <div
        class="md:h-[50vh] relative bg-red-500 flex items-center justify-start overflow-hidden mt-[10vh] max-w-screen-2xl w-full">
        <video src="http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4" autoplay
            muted="muted" preload="auto" loop="loop" class="w-full object-top"></video>
        <div class="absolute text-gray-200 px-5 md:px-10 sm:w-3/4 md:w-1/2 ">
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-semibold">Elevate Your Experience with VIP
                Membership!</h1>
            <a href="{{ route('vip') }}">
                <p class="bg-rose-500 rounded-md p-2 text-base sm:text-lg md:text-xl font-semibold w-fit mt-3">
                    Get full acceess</p>
            </a>
        </div>
    </div>
    <div class="min-h-screen mb-[35vh]">
        {{-- <section class="w-full h-[10vh] p-3 flex justify-center items-end mt-20 sm:mt-10">
            <header class="md:w-[50%] sm:w-[40%] w-[80%] text-center ">
                <h1 class="text-rose-400 font-semibold text-2xl mb-3">
                    Search any <span class="text-gray-200">Japan AV</span>
                </h1>
                <form action="{{ route('search') }}" method="GET">
                    <label for="main-search"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative  w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" id="main-search"
                            placeholder="search here"
                            name="keyword"
                            class='block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-rose-500 focus:border-rose-500 '>

                            <button type="sumbit" class="absolute top-0 right-0 border-2 border-l-gray-500 py-2.5 px-5 text-center rounded-r-md text-sm font-medium text-gray-900 focus:outline-none bg-transparent border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 ">search</button>
                        </div>
                </form>
    
            </header>
        </section> --}}
        <main class="space-y-8 p-2 sm:p-0 mt-3">
            <livewire:home.popular-genres />
            <livewire:home.recomended />
            {{-- <livewire:home.random-genre /> --}}
            <livewire:home.new-release />
            <livewire:home.recent-update />
        </main>
    </div>
</x-home-layout>
