@php
    $userName = auth()->check() ? Str::limit(auth()->user()->name, 8, '...') : '';
@endphp

<div x-data="{
    watchJav: false,
    category: false,
    myCollection: false,
    count: 0,
    search: false
}">
    <nav class="md:flex hidden">
        <div class="w-full py-3 px-8 fixed z-50 flex justify-between backdrop-brightness-90 backdrop-blur-sm">
            <div>
                <a href="/">
                    @if ($logo)
                        <div class="w-36">
                            <img src="{{ asset('storage/' . $logo) }}" alt="" srcset=""
                                class="object-containt">
                        </div>
                    @else
                        <h1 class="text-rose-400 font-semibold text-3xl uppercase">AV<span
                                class="text-gray-200">STREAM</span>
                        </h1>
                    @endif
                </a>
            </div>
            <ul class="flex space-x-2 items-center">
                <li>
                    <x-dropdown-navigation align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-base leading-4 dark:text-gray-400 bg-transparent text-gray-200 font-bold focus:outline-none transition ease-in-out duration-150 hover:text-rose-400">
                                <div>Watch JAV</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link href="{{ route('watch.by', ['keyword' => 'created_at']) }}">
                                <p class="font-semibold">New Release</p>
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('watch.by', ['keyword' => 'updated_at']) }}">
                                <p class="font-semibold">Recent Update</p>
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('actresses') }}">
                                <p class="font-semibold">Actress</p>
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('watch.by', ['keyword' => 'most_watch_today']) }}">
                                <p class="font-semibold">Most watch today</p>
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('watch.by', ['keyword' => 'most_watch_week']) }}">
                                <p class="font-semibold">Most watch week</p>
                            </x-dropdown-link>
                            <x-dropdown-link href=""
                                href="{{ route('watch.by', ['keyword' => 'most_watch_month']) }}">
                                <p class="font-semibold">Most watch month</p>
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown-navigation>
                </li>
                {{-- Category --}}
                <li>
                    <livewire:category-navigation />
                </li>
                <li>
                    <a href="{{ route('genres') }}">
                        <span
                            class="px-3 py-2 text-base leading-4 dark:text-gray-400 bg-transparent text-gray-200 font-bold focus:outline-none transition ease-in-out duration-150 hover:text-rose-400">Genres</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('studios') }}">
                        <span
                            class="px-3 py-2 text-base leading-4 dark:text-gray-400 bg-transparent text-gray-200 font-bold focus:outline-none transition ease-in-out duration-150 hover:text-rose-400">Studios</span>
                    </a>
                </li>
                <li>
                    <x-dropdown-navigation align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-base leading-4 dark:text-gray-400 bg-transparent text-gray-200 font-bold focus:outline-none transition ease-in-out duration-150 hover:text-rose-400 relative">
                                <div>My collection: @auth
                                        {{ $userName }}
                                    @endauth
                                </div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div x-cloak x-show="$store.count > 0 || $store.subscriptionCount > 0"
                                    class="w-3 h-3 bg-rose-400 absolute rounded-full text-center font-medium text-white top-0 left-2">

                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @if (Route::has('login'))
                                @auth
                                    <x-dropdown-link href="{{ route('vip') }}">
                                        <p class="font-semibold">Upgrade VIP</p>
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('actress.collection') }}">
                                        <p class="font-semibold">Actress Collection</p>
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('save') }}">
                                        <p class="font-semibold">Jav Collection</p>
                                    </x-dropdown-link>
                                    <livewire:navigation.subscription-log />
                                    <livewire:navigation.notification />
                                    <x-dropdown-link href="{{ route('user.profile') }}">
                                        <p class="font-semibold">Profile</p>
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        
                                        <x-dropdown-link href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            <p class="font-semibold">Logout</p>
                                        </x-dropdown-link>
                                    </form>
                                @else
                                    <x-dropdown-link href="{{ route('vip') }}">
                                        <p class="font-semibold">Upgrade VIP</p>
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('login') }}">
                                        <p class="font-semibold">Login</p>
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('register') }}">
                                        <p class="font-semibold">Register</p>
                                    </x-dropdown-link>
                                @endauth
                            @endif
                        </x-slot>
                    </x-dropdown-navigation>
                </li>
                <li>
                    <button type="button" class="mt-2" @click="search = ! search">
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M17.0392 15.6244C18.2714 14.084 19.0082 12.1301 19.0082 10.0041C19.0082 5.03127 14.9769 1 10.0041 1C5.03127 1 1 5.03127 1 10.0041C1 14.9769 5.03127 19.0082 10.0041 19.0082C12.1301 19.0082 14.084 18.2714 15.6244 17.0392L21.2921 22.707C21.6828 23.0977 22.3163 23.0977 22.707 22.707C23.0977 22.3163 23.0977 21.6828 22.707 21.2921L17.0392 15.6244ZM10.0041 17.0173C6.1308 17.0173 2.99087 13.8774 2.99087 10.0041C2.99087 6.1308 6.1308 2.99087 10.0041 2.99087C13.8774 2.99087 17.0173 6.1308 17.0173 10.0041C17.0173 13.8774 13.8774 17.0173 10.0041 17.0173Z"
                                    fill="#e5e7eb"></path>
                            </g>
                        </svg>
                    </button>
                </li>
            </ul>
        </div>
    </nav>
    <nav class="md:hidden fixed top-0 z-50">
        <div
            class="w-full py-3 px-4 fixed z-50 flex justify-between backdrop-brightness-90 backdrop-blur-sm items-center">
            <div>
                <a href="/">
                    @if ($logo)
                        <div class="w-24">
                            <img src="{{ asset('storage/' . $logo) }}" alt="" srcset=""
                                class="object-containt">
                        </div>
                    @else
                        <h1 class="text-rose-400 font-semibold text-3xl">AV<span
                                class="text-gray-200">Stream</span>
                        </h1>
                    @endif
                </a>
            </div>
            <div class="flex space-x-3 items-center">
                <button class="mb-1" type="button" @click="search = ! search">
                    <svg width="22px" height="22px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M17.0392 15.6244C18.2714 14.084 19.0082 12.1301 19.0082 10.0041C19.0082 5.03127 14.9769 1 10.0041 1C5.03127 1 1 5.03127 1 10.0041C1 14.9769 5.03127 19.0082 10.0041 19.0082C12.1301 19.0082 14.084 18.2714 15.6244 17.0392L21.2921 22.707C21.6828 23.0977 22.3163 23.0977 22.707 22.707C23.0977 22.3163 23.0977 21.6828 22.707 21.2921L17.0392 15.6244ZM10.0041 17.0173C6.1308 17.0173 2.99087 13.8774 2.99087 10.0041C2.99087 6.1308 6.1308 2.99087 10.0041 2.99087C13.8774 2.99087 17.0173 6.1308 17.0173 10.0041C17.0173 13.8774 13.8774 17.0173 10.0041 17.0173Z"
                                fill="#e5e7eb"></path>
                        </g>
                    </svg>
                </button>
                <x-dropdown-navigation align="right" width="w-52" :stop="true">
                    <x-slot name="trigger">
                        <button type="button">
                            <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M4 6H20M4 12H20M4 18H20" stroke="#e5e7eb" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </g>
                            </svg>
                            <div x-cloak x-show="$store.count > 0 || $store.subscriptionCount > 0"
                                class="w-3 h-3 rounded-full bg-red-500 absolute top-0 right-4"></div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <ul class="space-y-2">
                            <li>
                                <button @click="watchJav = ! watchJav"
                                    class="flex justify-between w-full items-center px-2 font-medium">
                                    <span class="text-sm font-semibold">Watch JAV</span>
                                    <div class="ease-in duration-100" :class="{ 'rotate-180': watchJav }">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                                <div x-show="watchJav" class="bg-gray-600 py-1">
                                    <x-dropdown-link href="{{ route('watch.by', ['keyword' => 'created_at']) }}">
                                        <p class="font-semibold text-gray-200">New Release</p>
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('watch.by', ['keyword' => 'updated_at']) }}">
                                        <p class="font-semibold text-gray-200">Recent Update</p>
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('actresses') }}">
                                        <p class="font-semibold text-gray-200">Actress</p>
                                    </x-dropdown-link>
                                    <x-dropdown-link
                                        href="{{ route('watch.by', ['keyword' => 'most_watch_today']) }}">
                                        <p class="font-semibold text-gray-200">Most watch today</p>
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('watch.by', ['keyword' => 'most_watch_week']) }}">
                                        <p class="font-semibold text-gray-200">Most watch week</p>
                                    </x-dropdown-link>
                                    <x-dropdown-link
                                        href="{{ route('watch.by', ['keyword' => 'most_watch_month']) }}">
                                        <p class="font-semibold text-gray-200">Most watch month</p>
                                    </x-dropdown-link>

                                </div>
                            </li>
                            <li>
                                <livewire:category-navigation />
                            </li>
                            <li>
                                <a href="{{ route('genres') }}">
                                    <span class="text-sm px-2 font-semibold">Genres</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('studios') }}">
                                    <span class="text-sm px-2 font-semibold">Studios</span>
                                </a>
                            </li>
                            {{-- my collection --}}
                            <li>
                                <button @click="myCollection = ! myCollection"
                                    class="flex justify-between w-full items-center px-2 font-medium">
                                    <span class="text-sm font-semibold">My Collection: @auth
                                            {{ $userName }}
                                        @endauth
                                    </span>
                                    <div class="ease-in duration-100" :class="{ 'rotate-180': myCollection }">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                                <div x-show="myCollection" class="bg-gray-600 py-1">
                                    @if (Route::has('login'))
                                        @auth
                                            <x-dropdown-link href="{{ route('vip') }}">
                                                <p class="font-semibold text-gray-200">Upgrade VIP</p>
                                            </x-dropdown-link>
                                            <x-dropdown-link href="{{ route('actress.collection') }}">
                                                <p class="font-semibold text-gray-200">Actress Collection</p>
                                            </x-dropdown-link>
                                            <x-dropdown-link href="{{ route('save') }}">
                                                <p class="font-semibold text-gray-200">Jav Collection</p>
                                            </x-dropdown-link>
                                            <livewire:navigation.subscription-log />
                                            <livewire:navigation.notification />
                                            <x-dropdown-link href="{{ route('user.profile') }}">
                                                <p class="font-semibold text-gray-200">Profile</p>
                                            </x-dropdown-link>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <x-dropdown-link href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                                    <p class="font-semibold text-gray-200">Logout</p>
                                                </x-dropdown-link>
                                            </form>
                                        @else
                                            <x-dropdown-link href="{{ route('vip') }}">
                                                <p class="font-semibold text-gray-200">Upgrade VIP</p>
                                            </x-dropdown-link>
                                            <x-dropdown-link href="{{ route('login') }}">
                                                <p class="font-semibold text-gray-200">Login</p>
                                            </x-dropdown-link>
                                            <x-dropdown-link href="{{ route('register') }}">
                                                <p class="font-semibold text-gray-200">Register</p>
                                            </x-dropdown-link>
                                        @endauth
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </x-slot>
                </x-dropdown-navigation>

            </div>
        </div>
    </nav>
    <form action="{{ route('search') }}" method="GET">
        <div class="w-full py-3 px-5 fixed sm:top-16 top-12 flex justify-center z-50" x-cloak x-show="search">
            <div class="flex w-full max-w-3xl">
                <div class="relative w-full">
                    <input type="search" id="search-dropdown"
                        class="block p-2.5 w-full z-20 text-sm text-gray-200 bg-gray-800 rounded-md focus:border-rose-500 "
                        placeholder="Search here" required name="keyword">
                    <button type="submit"
                        class="absolute top-0 right-0 py-2.5 px-5 text-sm font-medium h-full text-white bg-gray-700 rounded-r-md hover:bg-rose-500 focus:ring-4 focus:outline-none focus:ring-rose-300">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </form>
    @push('script')
        <script>
            document.addEventListener('alpine:init', () => {
                Livewire.on('sendNotifiCount', count => {
                    Alpine.store('count', count);
                });
                Livewire.on('subscriptionCount', count => {
                    Alpine.store('subscriptionCount', count);
                });
            });
        </script>
    @endpush
</div>
