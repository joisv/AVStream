<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{ $seo ?? '' }}

    {{-- icons --}}
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('images/icon/apple-touch-icon-57x57.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="{{ asset('images/icon/apple-touch-icon-114x114.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="{{ asset('images/icon/apple-touch-icon-72x72.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="{{ asset('images/icon/apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60"
        href="{{ asset('images/icon/apple-touch-icon-60x60.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120"
        href="{{ asset('images/icon/apple-touch-icon-120x120.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76"
        href="{{ asset('images/icon/apple-touch-icon-76x76.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152"
        href="{{ asset('images/icon/apple-touch-icon-152x152.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('images/icon/favicon-196x196.png') }}" sizes="196x196" />
    <link rel="icon" type="image/png" href="{{ asset('images/icon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/png" href="{{ asset('images/icon/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('images/icon/favicon-16x16.png') }}" sizes="16x16" />
    <link rel="icon" type="image/png" href="{{ asset('images/icon/favicon-128.png') }}" sizes="128x128" />
    <meta name="application-name" content="&nbsp;" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="{{ asset('images/icon/mstile-144x144.png') }}" />
    <meta name="msapplication-square70x70logo" content="{{ asset('images/icon/mstile-70x70.png') }}" />
    <meta name="msapplication-square150x150logo" content="{{ asset('images/icon/mstile-150x150.png') }}" />
    <meta name="msapplication-wide310x150logo" content="{{ asset('images/icon/mstile-310x150.png') }}" />
    <meta name="msapplication-square310x310logo" content="{{ asset('images/icon/mstile-310x310.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @livewireStyles
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
</head>

<body class="antialiased bg-background">
    <div class="relative" x-data="{
        screenWidth: window.innerWidth,
        expanded: $persist(false),
        expandedDetail: $persist(true)
    
    }" x-init="() => {
        window.addEventListener('resize', () => {
    
            screenWidth = window.innerWidth;
            if (screenWidth >= 768) {
                expanded = true;
                expandedDetail = true;
            } else {
                expanded = false;
                expandedDetail = false;
            }
    
        });
    }">
        @include('layouts.home-navigation')
        @if (request()->is('/'))
            <div
                class="md:h-[50vh] relative bg-transparent flex items-center justify-start overflow-hidden mt-[10vh] max-w-screen-2xl w-full">
                <video src="{{ $setting->banner_video_url }}" autoplay muted="muted" preload="auto" loop="loop"
                    class="w-full object-top blur-xl opacity-50"></video>
                <div class="absolute text-gray-200 px-5 md:px-10 sm:w-3/4 md:w-1/2 ">
                    @auth
                        @if (auth()->user()->can('can premium content'))
                            <h1 class="text-2xl sm:text-3xl md:text-4xl font-semibold">Treat yourself to the ultimate
                                cinematic
                                experience with our VIP account!</h1>
                            <div
                                class="bg-rose-500 flex items-center justify-center rounded-md p-2 text-base sm:text-lg md:text-xl font-semibold space-x-1 w-fit mt-3">
                                <p>VIP</p>
                                <x-icons.crown />
                            </div>
                        @else
                            <h1 class="text-2xl sm:text-3xl md:text-4xl font-semibold">Elevate Your Experience with VIP
                                Membership!</h1>
                            <a href="{{ route('vip') }}">
                                <p
                                    class="bg-rose-500 rounded-md p-2 text-base sm:text-lg md:text-xl font-semibold w-fit mt-3">
                                    Get full acceess</p>
                            </a>
                        @endif
                    @else
                        <h1 class="text-2xl sm:text-3xl md:text-4xl font-semibold">Elevate Your Experience with VIP
                            Membership!</h1>
                        <a href="{{ route('vip') }}">
                            <p class="bg-rose-500 rounded-md p-2 text-base sm:text-lg md:text-xl font-semibold w-fit mt-3">
                                Get full acceess</p>
                        </a>
                    @endauth
                </div>
            </div>
        @endif
        <div class="xl:max-w-7xl lg:max-w-4xl md:max-w-3xl mx-auto space-y-7">
            {{ $slot }}
        </div>
    </div>
    @stack('modal')
    @include('layouts.home-footer')
    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    @stack('script')
</body>

</html>
