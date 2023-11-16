@php
    $selectedName = $selected ? Str::limit($selected['name'], 10, '...') : '';
@endphp
<div class="lg:flex sm:space-x-4 overflow-hidden min-h-[200vh] md:mt-[10vh] mt-[8vh] " x-data="{
    label: @entangle('selected').defer,
    iframe: null,
    wrapper: false,
    playerErr: null
}"
    @plyr.window="() => {
        this.iframe = document.querySelector('iframe');
        this.playerErr = document.getElementById('player_err')
        console.log(this.iframe, this.pleyerErr)
        this.wrapper = document.querySelector('.wrapper-player');
        if (this.iframe !== null || this.playerErr !== null) {
            this.wrapper.classList.add('pb-[56%]', 'relative');
        } else {
            // Pastikan wrapper tidak null sebelum mencoba menghapus kelas
            if (wrapper !== null) {
                this.wrapper.classList.remove('pb-[56%]', 'relative');
            }
        }
}"
    x-init="() => {
        this.iframe = document.querySelector('iframe');
        this.playerErr = document.getElementById('player_err')
        this.wrapper = document.querySelector('.wrapper-player');
        if (this.iframe !== null || this.playerErr !== null) {
            this.wrapper.classList.add('pb-[56%]', 'relative');
        } else {
            // Pastikan wrapper tidak null sebelum mencoba menghapus kelas
            if (wrapper !== null) {
                this.wrapper.classList.remove('pb-[56%]', 'relative');
            }
        }
    }">
    <div class="max-w-screen-lg w-full lg:w-[70%] top-0 relative text-text h-fit">
        <div class="wrapper-player w-full pb-[56%] relative" wire:loading.remove wire:target="selectedEmbeds">
            @if ($selected)
                @if ($post->isVip == 1)
                    @auth
                        @can('can premium content')
                            @if ($selected['player'] == 'hls')
                                <x-hls-player
                                    poster="{{ Str::startsWith($selected['poster'], ['http://', 'https://']) ? $selected['poster'] : asset('storage/' . $selected['poster']) }}"
                                    id="hls" />
                            @elseif($selected['player'] == 'direct')
                                <video controls crossorigin playsinline
                                    poster="{{ Str::startsWith($selected['poster'], ['http://', 'https://']) ? $selected['poster'] : asset('storage/' . $selected['poster']) }}"
                                    id="player">
                                    <!-- Video files -->
                                    <source src="{{ $selected['url_movie'] }}" type="video/mp4" size="576">

                                    <!-- Caption files -->
                                    {{-- <track kind="captions" label="English" srclang="en"
                                    src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt" default>
                                <track kind="captions" label="Français" srclang="fr"
                                    src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.fr.vtt"> --}}

                                    <!-- Fallback for browsers that don't support the <video> element -->
                                    <a href="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4"
                                        download>Download</a>
                                </video>
                            @else
                                <x-embed-player src="{{ $selected['url_movie'] ?? '' }}" />
                            @endif
                        @else
                            <div class="absolute top-0 left-0 w-full h-full flex justify-center items-center">
                                <x-icons.crown isVip="true" default="60px" />
                                <x-player-error>
                                    <x-slot name="title">VIP Content</x-slot>
                                    <x-slot name="message">you dont have VIP <a href="{{ route('vip') }}"
                                        class="text-rose-500 font-medium underline">upgrade youre
                                        account here</a></x-slot>
                                </x-player-error>
                            </div>
                        @endcan
                    @else
                        <div class="absolute top-0 left-0 w-full h-full flex justify-center items-center">
                            <x-icons.crown isVip="true" default="60px" />
                            <x-player-error>
                                <x-slot name="title">VIP Content</x-slot>
                                <x-slot name="message">you need to login first and <a
                                    href="{{ route('vip') }}" class="text-rose-500 font-medium underline">upgrade to
                                    VIP</a></x-slot>
                            </x-player-error>
                        </div>
                    @endauth
                @else
                    @if ($selected['isVip'])
                        @auth
                            @can('can premium content')
                                @if ($selected['player'] == 'hls')
                                    <x-hls-player id="hls"
                                        poster="{{ Str::startsWith($selected['poster'], ['http://', 'https://']) ? $selected['poster'] : asset('storage/' . $selected['poster']) }}"></x-hls-player>
                                @elseif($selected['player'] == 'direct')
                                    <video controls crossorigin playsinline
                                        poster="{{ Str::startsWith($selected['poster'], ['http://', 'https://']) ? $selected['poster'] : asset('storage/' . $selected['poster']) }}"
                                        id="player">
                                        <!-- Video files -->
                                        <source src="{{ $selected['url_movie'] }}" type="video/mp4" size="576">

                                        <!-- Caption files -->
                                        {{-- <track kind="captions" label="English" srclang="en"
                                src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt" default>
                            <track kind="captions" label="Français" srclang="fr"
                                src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.fr.vtt"> --}}

                                        <!-- Fallback for browsers that don't support the <video> element -->
                                        <a href="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4"
                                            download>Download</a>
                                    </video>
                                @else
                                    <x-embed-player src="{{ $selected['url_movie'] ?? '' }}" />
                                @endif
                            @else
                                <div class="absolute top-0 left-0 w-full h-full flex justify-center items-center">
                                    <x-icons.crown isVip="true" default="60px" />
                                    <x-player-error>
                                        <x-slot name="title">VIP Quality Content</x-slot>
                                        <x-slot name="message">you dont have VIP <a
                                            href="{{ route('vip') }}" class="text-rose-500 font-medium underline">upgrade
                                            youre
                                            account here</a></x-slot>
                                    </x-player-error>
                                </div>
                            @endcan
                        @else
                            <div class="absolute top-0 left-0 w-full h-full flex justify-center items-center">
                                <x-icons.crown isVip="true" default="60px" />
                                <x-player-error>
                                    <x-slot name="title">VIP Quality Content</x-slot>
                                    <x-slot name="message">you need to login first or <span
                                        class="text-rose-500 font-medium underline">choose another quality</span></x-slot>
                                </x-player-error>
                            </div>
                        @endauth
                    @else
                        @if ($selected['player'] == 'hls')
                            <x-hls-player id="hls"
                                poster="{{ Str::startsWith($selected['poster'], ['http://', 'https://']) ? $selected['poster'] : asset('storage/' . $selected['poster']) }}"></x-hls-player>
                        @elseif($selected['player'] == 'direct')
                            <video controls crossorigin playsinline
                                poster="{{ Str::startsWith($selected['poster'], ['http://', 'https://']) ? $selected['poster'] : asset('storage/' . $selected['poster']) }}"
                                id="player">
                                <!-- Video files -->
                                <source src="{{ $selected['url_movie'] }}" type="video/mp4" size="576">

                                <!-- Caption files -->
                                {{-- <track kind="captions" label="English" srclang="en"
                        src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt" default>
                    <track kind="captions" label="Français" srclang="fr"
                        src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.fr.vtt"> --}}

                                <!-- Fallback for browsers that don't support the <video> element -->
                                <a href="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4"
                                    download>Download</a>
                            </video>
                        @else
                            <x-embed-player src="{{ $selected['url_movie'] ?? '' }}" />
                        @endif
                    @endif
                @endif
            @else
                <div class="absolute top-0 left-0 w-full h-full flex justify-center items-center">
                    <h1 class="text-rose-500 text-2xl font-semibold">404 <span class="underline text-gray-500">Embed not
                            found...</span></h1>
                </div>
            @endif

        </div>
        <div class="pb-[24%] flex flex-col items-center p-3 lg:p-0 " wire:loading.flex wire:target="selectedEmbeds">
            <div class="mt-[24%]">
                <x-icons.loading-circle default="34px" />
            </div>
        </div>
        <section class="py-4 space-y-7 p-3 lg:p-0">
            <div>
                <header class="md:flex justify-between w-full">
                    <h1 class="text-gray-300 font-medium sm:text-xl text-base md:w-[70%]">
                        {{ $post->code . ' ' . $post->title }}
                    </h1>
                    @if ($post->isVip == 1)
                        @auth
                            @can('can premium content')
                                <div class="md:w-[30%] w-full">
                                    <div class="flex justify-end items-center">

                                        <x-dropdown-navigation align="right" width="48">
                                            <x-slot name="trigger">
                                                <button
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-base leading-4 dark:text-gray-400 bg-transparent text-gray-200 font-bold focus:outline-none transition ease-in-out duration-150">
                                                    <div class="hover:text-rose-400 ease-in duration-150 text-base sm:text-lg">
                                                        Quality:
                                                        {{ $selectedName ?? '' }}
                                                    </div>

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
                                                <div class="space-y-1">
                                                    @forelse ($post->movies as $index => $embed)
                                                        <label for="created_at_{{ $index }}"
                                                            class="relative flex justify-between w-full px-4 py-2 text-left text-sm font-semibold leading-5 text-gray-700 dark:text-gray-300 hover:bg-slate-300 transition duration-150 ease-in-out">
                                                            <input type="radio" name=""
                                                                id="created_at_{{ $index }}"
                                                                value="{{ $embed }}" class="absolute opacity-0"
                                                                wire:model.lazy="selectedEmbeds">
                                                            {{ $embed->name }}
                                                            <div>
                                                                <x-icons.crown isVip="{{ $embed->isVip }}" />
                                                            </div>
                                                        </label>
                                                    @empty
                                                        <div
                                                            class="relative block w-full px-4 py-2 text-left text-sm font-semibold leading-5 text-gray-700 dark:text-gray-300 hover:bg-slate-300 transition duration-150 ease-in-out">
                                                            embed not found</div>
                                                    @endforelse
                                                </div>
                                            </x-slot>
                                        </x-dropdown-navigation>
                                    </div>
                                </div>
                            @endcan
                        @endauth
                    @else
                        <div class="md:w-[30%] w-full">
                            <div class="flex justify-end items-center">
                                <x-dropdown-navigation align="right" width="48">
                                    <x-slot name="trigger">
                                        <button
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-base leading-4 dark:text-gray-400 bg-transparent text-gray-200 font-bold focus:outline-none transition ease-in-out duration-150">
                                            <div class="hover:text-rose-400 ease-in duration-150 text-base sm:text-lg">
                                                Quality:
                                                {{ $selectedName ?? '' }}
                                            </div>

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
                                        <div class="space-y-1">
                                            @forelse ($post->movies as $index => $embed)
                                                <label for="created_at_{{ $index }}"
                                                    class="relative flex justify-between w-full px-4 py-2 text-left text-sm font-semibold leading-5 text-gray-700 dark:text-gray-300 hover:bg-slate-300 transition duration-150 ease-in-out">
                                                    <input type="radio" name=""
                                                        id="created_at_{{ $index }}"
                                                        value="{{ $embed }}" class="absolute opacity-0"
                                                        wire:model.lazy="selectedEmbeds">
                                                    {{ $embed->name }}
                                                    <div>
                                                        <x-icons.crown isVip="{{ $embed->isVip }}" />
                                                    </div>
                                                </label>
                                            @empty
                                                <div
                                                    class="relative block w-full px-4 py-2 text-left text-sm font-semibold leading-5 text-gray-700 dark:text-gray-300 hover:bg-slate-300 transition duration-150 ease-in-out">
                                                    embed not found</div>
                                            @endforelse
                                        </div>
                                    </x-slot>
                                </x-dropdown-navigation>
                            </div>
                        </div>
                    @endif
                </header>
                <nav class="text-gray-400 w-full flex justify-center mt-7">
                    <ul class="flex space-x-3">
                        <li>
                            <livewire:watch.save :hasPost="$hasPost" :user="$user" :post="$post"/>
                        </li>
                        <li>
                            <button type="button" class="flex space-x-1 items-center focus:opacity-60"
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'download-modal')">
                                <svg width="21px" height="21px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                    </g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M12 3V16M12 16L16 11.625M12 16L8 11.625" stroke="#9ca3af"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        </path>
                                        <path
                                            d="M15 21H9C6.17157 21 4.75736 21 3.87868 20.1213C3 19.2426 3 17.8284 3 15M21 15C21 17.8284 21 19.2426 20.1213 20.1213C19.8215 20.4211 19.4594 20.6186 19 20.7487"
                                            stroke="#9ca3af" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                                <div class="text-sm sm:text-base font-semibold">Download</div>
                            </button>
                        </li>
                        <li>
                            <button x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'report-modal')" type="button"
                                class="flex space-x-1 items-center focus:opacity-60">
                                <svg width="21px" height="21px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                    </g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M4 1C3.44772 1 3 1.44772 3 2V22C3 22.5523 3.44772 23 4 23C4.55228 23 5 22.5523 5 22V13.5983C5.46602 13.3663 6.20273 13.0429 6.99251 12.8455C8.40911 12.4914 9.54598 12.6221 10.168 13.555C11.329 15.2964 13.5462 15.4498 15.2526 15.2798C17.0533 15.1004 18.8348 14.5107 19.7354 14.1776C20.5267 13.885 21 13.1336 21 12.3408V5.72337C21 4.17197 19.3578 3.26624 18.0489 3.85981C16.9875 4.34118 15.5774 4.87875 14.3031 5.0563C12.9699 5.24207 12.1956 4.9907 11.832 4.44544C10.5201 2.47763 8.27558 2.24466 6.66694 2.37871C6.0494 2.43018 5.47559 2.53816 5 2.65249V2C5 1.44772 4.55228 1 4 1ZM5 4.72107V11.4047C5.44083 11.2247 5.95616 11.043 6.50747 10.9052C8.09087 10.5094 10.454 10.3787 11.832 12.4455C12.3106 13.1634 13.4135 13.4531 15.0543 13.2897C16.5758 13.1381 18.1422 12.6321 19 12.3172V5.72337C19 5.67794 18.9081 5.66623 18.875 5.68126C17.7575 6.18804 16.1396 6.81972 14.5791 7.03716C13.0776 7.24639 11.2104 7.1185 10.168 5.55488C9.47989 4.52284 8.2244 4.25586 6.83304 4.3718C6.12405 4.43089 5.46427 4.58626 5 4.72107Z"
                                            fill="#9ca3af"></path>
                                    </g>
                                </svg>
                                <div class="text-sm sm:text-base font-semibold">Report issue</div>
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="border-t-2 border-rose-400 w-full text-gray-500 font-semibold sm:text-lg text-md">
                <div class="mt-4">
                    <p class="cursor-pointer" @click="expandedDetail = ! expandedDetail" x-cloak
                        x-show="expandedDetail" x-collapse.min.50px>{{ $post->overview }} </p>
                    <button @click="expandedDetail = ! expandedDetail"
                        class="p-1 bg-rose-400 text-white font-medium text-sm rounded-md mt-2 w-fit"
                        type="button">more
                        detail</button>
                    <ul class="text-gray-400 mt-4 space-y-1 font-medium">
                        <li>
                            <div class="flex space-x-1">
                                <h3>Release date:</h3>
                                <p>{{ $post->created_at->format('M, d Y') }}</p>
                            </div>
                        </li>
                        <li>
                            <div class="flex space-x-1">
                                <h3 class="whitespace-nowrap">Original Title:</h3>
                                <p>{{ $post->title }}</p>
                            </div>
                        </li>
                        <li>
                            <div class="flex space-x-1">
                                <h3>Code:</h3>
                                <p>{{ $post->code }}</p>
                            </div>
                        </li>
                        <li>
                            <div class="flex space-x-1">
                                <h3>Category:</h3>
                                <p class="text-amber-200 opacity-90">
                                    <a
                                        href="{{ route('category', $post->category->slug) }}">{{ $post->category->name }}</a>
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="flex space-x-1">
                                <h3>Actress:</h3>
                                <p class="text-amber-200 opacity-90">
                                    @foreach ($post->actresses as $actress)
                                        <a href="{{ route('actresses', $actress->name) }}">{{ $actress->name }}</a>
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="flex space-x-1">
                                <h3>Genres:</h3>
                                <p class="text-amber-200 opacity-90">
                                    @foreach ($post->genres as $genre)
                                        <a href="{{ route('genres', $genre->name) }}">{{ $genre->name }}</a>
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="flex space-x-1">
                                <h3>Studio:</h3>
                                <p class="text-amber-200 opacity-90">
                                    @foreach ($post->studios as $studio)
                                        <a href="{{ route('studios', $studio->name) }}">{{ $studio->name }}</a>
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <livewire:watch.recomendation />
    </div>
    <livewire:watch.trending />
    <x-modal-v2 name="download-modal" :show="$errors->isNotEmpty()" maxWidth="sm">
        <livewire:watch.download :postId="$post->id" />
    </x-modal-v2>
    <x-modal-v2 name="report-modal" :show="$errors->isNotEmpty()" maxWidth="sm">
        <livewire:watch.report-issue :post_id="$post->id" />
    </x-modal-v2>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', () => {
            const source = @js($selected['url_movie']);
            const video = document.getElementById('hls');
            const defaultOptions = {
                ratio: '16:9'
            };

            function initializePlyr(playerSelector, options) {
                const player = new Plyr(playerSelector, options);
                window.player = player;
                
            }

            function initializeHls(video, source, defaultOptions) {
                
                const hls = new Hls();
                hls.loadSource(source);

                hls.on(Hls.Events.MANIFEST_PARSED, function(event, data) {
                    const availableQualities = hls.levels.map((l) => l.height)
                    availableQualities.unshift(0);

                    defaultOptions.quality = {
                        default: 0,
                        options: availableQualities,
                        forced: true,
                        onChange: (e) => updateQuality(e),
                    }

                    defaultOptions.i18n = {
                        qualityLabel: {
                            0: 'Auto',
                        },
                    }

                    hls.on(Hls.Events.LEVEL_SWITCHED, function(event, data) {
                        const span = document.querySelector(
                            ".plyr__menu__container [data-plyr='quality'][value='0'] span")
                        if (hls.autoLevelEnabled) {
                            span.innerHTML = `AUTO (${hls.levels[data.level].height}p)`
                        } else {
                            span.innerHTML = `AUTO`
                        }
                    })

                    const player = new Plyr(video, defaultOptions);
                    window.hls = hls;
                    window.addEventListener('resize', () => {
                        player.setup();
                    });
                });

                hls.attachMedia(video);
            }

            function updateQuality(newQuality) {
                if (window.hls && newQuality === 0) {
                    window.hls.currentLevel = -1;
                } else if (window.hls) {
                    window.hls.levels.forEach((level, levelIndex) => {
                        if (level.height === newQuality) {
                            console.log("Found quality match with " + newQuality);
                            window.hls.currentLevel = levelIndex;
                        }
                    });
                }
            }

            @this.on('plyr', (selected) => {
                if (selected['player'] === 'hls') {
                    if (!Hls.isSupported()) {
                        initializePlyr('#player', defaultOptions);
                    } else {
                        initializeHls(video, selected['url_movie'], defaultOptions);
                    }
                } else {
                    initializePlyr('#player', defaultOptions);
                }
            });

            // Initial setup outside the livewire event
            if (Hls.isSupported()) {
                initializeHls(video, source, defaultOptions);
            } else {
                initializePlyr('#player', defaultOptions);
            }
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            @this.on('plyr', (selected) => {
                const source = selected['url_movie'];
                const video = document.getElementById('hls');

                const defaultOptions = {
                    ratio: '16:9',
                    captions: {
                        active: false,
                        language: 'auto',
                        update: false
                    },
                    fullscreen: {
                        enabled: true,
                        fallback: true,
                        iosNative: false,
                        container: null
                    }
                };
                if (selected['player'] == 'hls') {
                    if (!Hls.isSupported()) {
                        const player = new Plyr('#player', defaultOptions);
                        window.player = player;
                    } else {
                        // For more Hls.js options, see https://github.com/dailymotion/hls.js
                        const hls = new Hls();
                        hls.loadSource(source);

                        // From the m3u8 playlist, hls parses the manifest and returns
                        // all available video qualities. This is important, in this approach,
                        // we will have one source on the Plyr player.
                        hls.on(Hls.Events.MANIFEST_PARSED, function(event, data) {

                            // Transform available levels into an array of integers (height values).
                            const availableQualities = hls.levels.map((l) => l.height)
                            availableQualities.unshift(0) //prepend 0 to quality array

                            // Add new qualities to option
                            defaultOptions.quality = {
                                default: 0, //Default - AUTO
                                options: availableQualities,
                                forced: true,
                                onChange: (e) => updateQuality(e),
                            }
                            // Add Auto Label 
                            defaultOptions.i18n = {
                                qualityLabel: {
                                    0: 'Auto',
                                },
                            }

                            hls.on(Hls.Events.LEVEL_SWITCHED, function(event, data) {
                                var span = document.querySelector(
                                    ".plyr__menu__container [data-plyr='quality'][value='0'] span"
                                )
                                if (hls.autoLevelEnabled) {
                                    span.innerHTML =
                                        `AUTO (${hls.levels[data.level].height}p)`
                                } else {
                                    span.innerHTML = `AUTO`
                                }
                            })

                            // Initialize new Plyr player with quality options
                            var player = new Plyr(video, defaultOptions);
                        });

                        hls.attachMedia(video);
                        window.hls = hls;
                    }

                    function updateQuality(newQuality) {
                        if (newQuality === 0) {
                            window.hls.currentLevel = -1; //Enable AUTO quality if option.value = 0
                        } else {
                            window.hls.levels.forEach((level, levelIndex) => {
                                if (level.height === newQuality) {
                                    console.log("Found quality match with " + newQuality);
                                    window.hls.currentLevel = levelIndex;
                                }
                            });
                        }
                    }
                } else {
                    const player = new Plyr('#player');
                    window.player = player;
                }
            })

            const source = @js($selected['url_movie']);
            const video = document.getElementById('hls');

            const defaultOptions = {
                ratio: '16:9',
                captions: {
                    active: false,
                    language: 'auto',
                    update: false
                },
                fullscreen: {
                    enabled: true,
                    fallback: true,
                    iosNative: false,
                    container: null
                }
            };
            if (@js($selected['player']) == 'hls') {

                if (!Hls.isSupported()) {
                    const player = new Plyr('#player');
                    window.player = player;
                } else {
                    // For more Hls.js options, see https://github.com/dailymotion/hls.js
                    const hls = new Hls();
                    hls.loadSource(source);

                    // From the m3u8 playlist, hls parses the manifest and returns
                    // all available video qualities. This is important, in this approach,
                    // we will have one source on the Plyr player.
                    hls.on(Hls.Events.MANIFEST_PARSED, function(event, data) {

                        // Transform available levels into an array of integers (height values).
                        const availableQualities = hls.levels.map((l) => l.height)
                        availableQualities.unshift(0) //prepend 0 to quality array

                        // Add new qualities to option
                        defaultOptions.quality = {
                            default: 0, //Default - AUTO
                            options: availableQualities,
                            forced: true,
                            onChange: (e) => updateQuality(e),
                        }
                        // Add Auto Label 
                        defaultOptions.i18n = {
                            qualityLabel: {
                                0: 'Auto',
                            },
                        }

                        hls.on(Hls.Events.LEVEL_SWITCHED, function(event, data) {
                            var span = document.querySelector(
                                ".plyr__menu__container [data-plyr='quality'][value='0'] span"
                            )
                            if (hls.autoLevelEnabled) {
                                span.innerHTML = `AUTO (${hls.levels[data.level].height}p)`
                            } else {
                                span.innerHTML = `AUTO`
                            }
                        })

                        // Initialize new Plyr player with quality options
                        var player = new Plyr(video, defaultOptions);
                    });

                    hls.attachMedia(video);
                    window.hls = hls;
                }

                function updateQuality(newQuality) {
                    if (newQuality === 0) {
                        window.hls.currentLevel = -1; //Enable AUTO quality if option.value = 0
                    } else {
                        window.hls.levels.forEach((level, levelIndex) => {
                            if (level.height === newQuality) {
                                console.log("Found quality match with " + newQuality);
                                window.hls.currentLevel = levelIndex;
                            }
                        });
                    }
                }
            } else {
                const player = new Plyr('#player');
                window.player = player;
            }
        });
    </script>
</div>
