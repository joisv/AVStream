<nav x-cloak class="ease-in duration-100 absolute sm:relative">
    <div class="p-4 lg:w-[23%] md:w-[32%] sm:w-[35%] max-w-[80vw] z-50 fixed ease-in duration-200" x-data="{
        open: @json(request()->routeIs('post')) ||
            @json(request()->routeIs('post.create')) ||
            @json(request()->routeIs('post.edit')) ||
            @json(request()->routeIs('actress.index')) ||
            @json(request()->routeIs('studio.index')),
        openStream: @json(request()->routeIs('download')) || @json(request()->routeIs('movie')),
        openSub: @json(request()->routeIs('subscription.plan')),
        openSetting:  @json(request()->routeIs('setting.basic')) || @json(request()->routeIs('setting.telegram')) || @json(request()->routeIs('setting.contact-payment'))
    }" x-cloak
        :class="openMenu ? '-translate-x-[150%]' : ''">
        <button class="ring focus:ring-rose-500 p-2 rounded-md absolute -right-11 xl:hidden flex" @click="toggleMenu()">
            <x-icons.menu />
        </button>
        <div class="bg-gray-800 space-y-5 h-[95vh] p-3 relative shadow-2xl overflow-y-auto">

            <div>
                <a href="/">
                    @if ($setting->logo)
                        <div class="w-24">
                            <img src="{{ asset('storage/' . $setting->logo) }}" alt="" srcset=""
                                class="object-containt">
                        </div>
                    @else
                        <h1 class="text-rose-400 font-semibold text-3xl ">AV<span class="text-gray-200">Stream</span>
                        </h1>
                    @endif
                </a>
            </div>

            <div class="space-y-2">
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    <svg class="fill-gray-200" width="25px" height="25px" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg" id="dashboard" class="icon glyph" stroke="rgb(229 231 235)">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <rect x="2" y="2" width="9" height="11" rx="2"></rect>
                            <rect x="13" y="2" width="9" height="7" rx="2"></rect>
                            <rect x="2" y="15" width="9" height="7" rx="2"></rect>
                            <rect x="13" y="11" width="9" height="11" rx="2"></rect>
                        </g>
                    </svg>
                    {{ __('Dashboard') }}
                </x-nav-link>
                <div>
                    <button
                        class="focus:outline-none text-white focus:ring-4 focus:border-0 focus:bg-gray-700 border border-gray-200 font-medium items-center text-sm p-2 flex w-full"
                        @click="open = ! open">
                        <div class="flex gap-3 items-center w-full">
                            <x-icons.post />
                            Post
                        </div>
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                            class="ease-in duration-200" :class="open ? 'rotate-180' : ''"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M15 11L12.2121 13.7879C12.095 13.905 11.905 13.905 11.7879 13.7879L9 11M7 21H17C19.2091 21 21 19.2091 21 17V7C21 4.79086 19.2091 3 17 3H7C4.79086 3 3 4.79086 3 7V17C3 19.2091 4.79086 21 7 21Z"
                                    stroke="rgb(229 231 235)" stroke-width="2" stroke-linecap="round"></path>
                            </g>
                        </svg>
                    </button>
                    <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-10"
                        x-transition:enter-end="opacity-100 -translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 -translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-10" class="mt-3 flex flex-col items-end">
                        <div x-cloak class="w-[90%] bg-rose-500 space-y-2 p-3 shadow-2xl">
                            <x-nav-link href="{{ route('post') }}" :active="request()->routeIs('post') ||
                                request()->routeIs('post.create') ||
                                request()->routeIs('post.edit')">
                                {{ __('Post series') }}
                            </x-nav-link>
                            <x-nav-link href="{{ route('actress.index') }}" :active="request()->routeIs('actress.index') ||
                                request()->routeIs('actress.create') ||
                                request()->routeIs('actress.edit')">
                                {{ __('Actress') }}
                            </x-nav-link>
                            <x-nav-link href="{{ route('studio.index') }}" :active="request()->routeIs('studio.index')">
                                {{ __('Studio') }}
                            </x-nav-link>
                        </div>
                    </div>
                </div>
                <div>
                    <button
                        class="focus:outline-none text-white focus:ring-4 focus:border-0 focus:bg-gray-700 border border-gray-200 font-medium items-center text-sm p-3 flex w-full"
                        @click="openStream = ! openStream">
                        <div class="flex gap-3 items-center w-full">
                            <x-icons.movie :active="request()->routeIs('download')" />
                            Embed & Download
                        </div>
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                            class="ease-in duration-200" :class="openStream ? 'rotate-180' : ''"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M15 11L12.2121 13.7879C12.095 13.905 11.905 13.905 11.7879 13.7879L9 11M7 21H17C19.2091 21 21 19.2091 21 17V7C21 4.79086 19.2091 3 17 3H7C4.79086 3 3 4.79086 3 7V17C3 19.2091 4.79086 21 7 21Z"
                                    stroke="rgb(229 231 235)" stroke-width="2" stroke-linecap="round"></path>
                            </g>
                        </svg>
                    </button>
                    <div x-cloak x-show="openStream" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-10"
                        x-transition:enter-end="opacity-100 -translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 -translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-10" class="mt-3 flex flex-col items-end">
                        <div x-cloak class="w-[90%] bg-rose-500 space-y-2 p-3 shadow-2xl">
                            <x-nav-link href="{{ route('movie') }}" :active="request()->routeIs('movie')">
                                {{ __('Embed') }}
                            </x-nav-link>
                            <x-nav-link href="{{ route('download') }}" :active="request()->routeIs('download')">
                                {{ __('Download') }}
                            </x-nav-link>
                        </div>
                    </div>
                </div>
                @hasrole('admin|super-admin')
                    <div>
                        <button
                            class="focus:outline-none text-white focus:ring-4 focus:border-0 focus:bg-gray-700 border border-gray-200 font-medium items-center text-sm p-3 flex w-full"
                            @click="openSub = ! openSub">
                            <div class="flex gap-3 items-center w-full">
                                <svg fill="#d1d5db" width="29px" height="29px" viewBox="-2 -5 24 24"
                                    xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin"
                                    class="jam jam-newsletter" stroke="#d1d5db" stroke-width="0.00024000000000000003">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M2 0h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm0 2v10h16V2H2zm3 6h6a1 1 0 0 1 0 2H5a1 1 0 1 1 0-2zm10-5h2v2h-2V3z">
                                        </path>
                                    </g>
                                </svg>
                                Subscription & Plan
                            </div>
                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                class="ease-in duration-200" :class="openSub ? 'rotate-180' : ''"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M15 11L12.2121 13.7879C12.095 13.905 11.905 13.905 11.7879 13.7879L9 11M7 21H17C19.2091 21 21 19.2091 21 17V7C21 4.79086 19.2091 3 17 3H7C4.79086 3 3 4.79086 3 7V17C3 19.2091 4.79086 21 7 21Z"
                                        stroke="rgb(229 231 235)" stroke-width="2" stroke-linecap="round"></path>
                                </g>
                            </svg>
                        </button>
                        <div x-cloak x-show="openSub" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 -translate-y-10"
                            x-transition:enter-end="opacity-100 -translate-y-0"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 -translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-10" class="mt-3 flex flex-col items-end">
                            <div x-cloak class="w-[90%] bg-rose-500 space-y-2 p-3 shadow-2xl">
                                <x-nav-link href="{{ route('subscription.plan') }}" :active="request()->routeIs('subscription.plan')">
                                    {{ __('Plan') }}
                                </x-nav-link>
                                <x-nav-link href="{{ route('subscription.log') }}" :active="request()->routeIs('subscription.log')">
                                    {{ __('Subscription') }}
                                </x-nav-link>
                            </div>
                        </div>
                    </div>
                @endhasrole
                <x-nav-link href="{{ route('category.index') }}" :active="request()->routeIs('category.index')">
                    <x-icons.category />
                    {{ __('Category') }}
                </x-nav-link>
                <x-nav-link href="{{ route('genre') }}" :active="request()->routeIs('genre')">
                    <x-icons.category />
                    {{ __('Genre') }}
                </x-nav-link>

                <x-nav-link href="{{ route('user.index') }}" :active="request()->routeIs('user.index')">
                    <x-icons.users />
                    {{ __('User') }}
                </x-nav-link>
                <x-nav-link href="{{ route('role') }}" :active="request()->routeIs('role')">
                    <x-icons.employee />
                    {{ __('Role & Permission') }}
                </x-nav-link>
                <x-nav-link href="{{ route('reports') }}" :active="request()->routeIs('reports')">
                    <livewire:navigation.user-report />
                </x-nav-link>
                <div>
                    <button
                        class="focus:outline-none text-white focus:ring-4 focus:border-0 focus:bg-gray-700 border border-gray-200 font-medium items-center text-sm p-3 flex w-full"
                        @click="openSetting = ! openSetting">
                        <div class="flex gap-3 items-center w-full">
                            <x-icons.settings />
                            Settings
                        </div>
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                            class="ease-in duration-200" :class="openSetting ? 'rotate-180' : ''"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M15 11L12.2121 13.7879C12.095 13.905 11.905 13.905 11.7879 13.7879L9 11M7 21H17C19.2091 21 21 19.2091 21 17V7C21 4.79086 19.2091 3 17 3H7C4.79086 3 3 4.79086 3 7V17C3 19.2091 4.79086 21 7 21Z"
                                    stroke="rgb(229 231 235)" stroke-width="2" stroke-linecap="round"></path>
                            </g>
                        </svg>
                    </button>
                    <div x-cloak x-show="openSetting" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-10"
                        x-transition:enter-end="opacity-100 -translate-y-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 -translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-10" class="mt-3 flex flex-col items-end">
                        <div x-cloak class="w-[90%] bg-rose-500 space-y-2 p-3 shadow-2xl">
                            <x-nav-link href="{{ route('setting.basic') }}" :active="request()->routeIs('setting.basic')">
                                {{ __('Basic') }}
                            </x-nav-link>
                            <x-nav-link href="{{ route('setting.telegram') }}" :active="request()->routeIs('setting.telegram')">
                                {{ __('Telegram') }}
                            </x-nav-link>
                            <x-nav-link href="{{ route('setting.contact-payment') }}" :active="request()->routeIs('setting.contact-payment')">
                                {{ __('Contact & Payment') }}
                            </x-nav-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
