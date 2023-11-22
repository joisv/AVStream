<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{ $seo ?? '' }}
    <link rel="icon" type="image/x-icon"
        href="{{ asset($setting->favicon ? 'storage/' . $setting->favicon : 'images/nyan-cat.gif') }}">
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-T4S2P3QX');
    </script>
    <!-- End Google Tag Manager -->
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
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
</head>

<body class="antialiased bg-background">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T4S2P3QX" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="relative" x-data="{
        screenWidth: window.innerWidth,
        expanded: $persist(false),
        expandedDetail: $persist(true),
        cookie: false,
        warningSetting: @js($setting->is_warning_active),
        openModal: () => {
            $dispatch('open-modal', 'warning-modal')
        },
        enterWarning: () => {
            $dispatch('closemodal')
    
        }
    
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
    }"
        @finish-mount.window="() => {
            cookie = $store.warning.checkCookie('warning')
            if (cookie === false && warningSetting) {
                $store.warning.showWarning = true
                openModal()
            } else {
                $store.warning.showWarning = false
            }
        }">
        @include('layouts.home-navigation')
        @if (request()->is('/'))
            @if ($setting->is_info_active)
            @empty(!$setting->info)
                <div class="text-white p-2 w-full bg-gray-800 space-y-2">
                    <div class="flex space-x-2 items-center">
                        <svg width="24px" height="24px" viewBox="0 0 24.00 24.00" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M12 17V11" stroke="#e5e7eb" stroke-width="1.5" stroke-linecap="round"></path>
                                <circle cx="1" cy="1" r="1" transform="matrix(1 0 0 -1 11 9)"
                                    fill="#e5e7eb">
                                </circle>
                                <path
                                    d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C21.5093 4.43821 21.8356 5.80655 21.9449 8"
                                    stroke="#e5e7eb" stroke-width="1.5" stroke-linecap="round"></path>
                            </g>
                        </svg>
                        <h1 class="text-gray-300 font-bold text-lg">Info</h1>
                    </div>
                    <article
                        class="prose prose-base lg:prose-lg prose-code:text-rose-500 prose-a:text-blue-600 prose-headings:text-gray-200 prose-blockquote:text-white">
                        {!! $setting->info !!}
                    </article>
                </div>
            @endempty
        @endif

        <div
            class="md:h-[50vh] relative bg-transparent flex items-center justify-start overflow-hidden mt-[5vh] max-w-screen-2xl w-full">
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
    <div class="xl:max-w-7xl lg:max-w-4xl md:max-w-3xl mx-auto">
        {{ $slot }}
    </div>
</div>
<x-modal-v2 name="warning-modal" :show="$errors->isNotEmpty()" maxWidth="lg">
    <div class="w-full p-3 bg-background text-gray-200 space-y-3" @closemodal.window="show = ! show">
        <div class="space-y-2">
            <header>
                <h1 class="text-3xl font-bold ">{{ config('app.name') }} is <span class="text-rose-500">adult
                        only</span> website</h1>
            </header>
            <article
                class="prose prose-sm md:prose-base prose-code:text-rose-500 prose-a:text-blue-600 prose-headings:text-gray-200">
                {!! $setting->warning_message !!}
            </article>
        </div>
        <button x-data=""
            @click="() => {
                $dispatch('closemodal')
                $store.warning.setCookie('warning', 1, 1)
            }"
            class="p-2 h-fit bg-rose-600 text-gray-200 text-sm md:text-base font-semibold text-center rounded-sm w-full">
            im 18 or older to enter {{ config('app.name') }}
        </button>
    </div>
</x-modal-v2>
@stack('modal')
@include('layouts.home-footer')
@livewireScripts
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>
<script src="https://cdn.rawgit.com/video-dev/hls.js/18bb552/dist/hls.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.8.5/dist/lazyload.min.js"></script>
<x-livewire-alert::scripts />
@stack('script')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('warning', {
            showWarning: true,
            lazyLoad: new LazyLoad({
                threshold: 0,
            }),

            setCookie(name, value, days) {
                var expires = "";
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + value + expires + "; path=/";
            },

            checkCookie(name) {
                var cookies = document.cookie.split(';');
                for (var i = 0; i < cookies.length; i++) {
                    var cookie = cookies[i].trim();
                    // Cek apakah cookie sesuai dengan nama yang diinginkan
                    if (cookie.indexOf(name + '=') === 0) {
                        return true; // Cookie ditemukan
                    }
                }
                return false; // Cookie tidak ditemukan
            }
        })
    })
</script>
</body>

</html>
