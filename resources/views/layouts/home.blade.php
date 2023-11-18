<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{ $seo ?? '' }}

    {{-- icons --}}
    {{-- <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('images/icon/apple-touch-icon-57x57.png') }}" />
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
    <meta name="msapplication-square310x310logo" content="{{ asset('images/icon/mstile-310x310.png') }}" /> --}}

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
    
        cookie = $store.warning.checkCookie('warning')
        if (cookie === false && warningSetting) {
            $store.warning.showWarning = true
            setTimeout(() => {
                openModal()
            }, [3500])
        } else {
            $store.warning.showWarning = false
            {{-- setTimeout(() => {
                openModal()
            }, [3500]) --}}
        }
    
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
    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'warning-modal')"
        class="bg-red-500 p-3">skidi</button>
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
            <button x-data="" @click="() => {
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
    <x-livewire-alert::scripts />
    @stack('script')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('warning', {
                showWarning: true,

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
