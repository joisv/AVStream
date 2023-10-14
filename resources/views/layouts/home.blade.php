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
        [x-cloak] { display: none !important; }
    </style>
    @livewireStyles
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
