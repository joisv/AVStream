<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <!-- Fonts -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
      [x-cloak] { display: none !important; }
    </style>
</head>

<body class="antialiased">
    <div class="relative min-h-screen bg-center bg-gray-100 flex justify-between" x-data="{
        openMenu: false,
        screenWidth: window.innerWidth,
        toggleMenu() { this.openMenu = !this.openMenu },
    
        init() {
            this.screenWidth = window.innerWidth;
            if (this.screenWidth <= 1024) {
                this.openMenu = true;
            }
        },
    
    
    
    }"
        x-init="() => {
            window.addEventListener('resize', () => {
        
                screenWidth = window.innerWidth;
                if (screenWidth <= 1024) {
                    openMenu = true;
                } else {
                    openMenu = false;
                }
        
            });
        }">
        @include('layouts.navigation')
        <main class="relative p-5 " x-cloak
            :class="openMenu ? 'w-full flex justify-center' : 'w-full flex justify-end lg:justify-center lg:w-[79vw]'">
            <div class="w-full max-w-5xl">
                <div class="w-full py-2 flex items-center justify-between ">
                    <button class="ring focus:ring-rose-500 p-2 rounded-md" x-data x-on:click="toggleMenu()">
                        <x-icons.menu />
                    </button>
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>

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
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('setting')">
                                    {{ __('Setting') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
                {{ $slot }}
            </div>
        </main>
    </div>
    <div x-data="{ modal: Alpine.store('modal') }" class="fixed top-0">
        <div x-cloak x-show="modal.on" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100 "
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 "
            x-transition:leave-end="opacity-0">
            @stack('modal')
        </div>
    </div>
    {{-- <footer class="w-full flex justify-end">
        <div class=" bottom-0 text-rose-500 right-16 p-2 font-semibold mr-10">
            <h1>{{ $version }}</h1>
            <h2 class="text-gray-600 text-sm italic">{{ $made }}</h2>
        </div>
    </footer> --}}
    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @stack('script')
</body>

</html>
