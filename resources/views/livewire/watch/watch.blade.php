@php
    $selected = json_decode($selectedEmbeds, true);
    $selectedName = $selected ? Str::limit($selected['name'], 10, '...') : '';
@endphp
<div class="lg:flex sm:space-x-4 overflow-hidden min-h-[200vh] md:mt-[10vh] mt-[8vh]">
    <div class="max-w-screen-lg w-full lg:w-[70%] p-3 lg:p-0 top-0 relative text-text h-fit">
        <div class="w-full relative pb-[56.25%] " wire:loading.remove wire:target="selectedEmbeds">
            @if ($selected)
                @if ($post->isVip == 1)
                    @auth
                        @can('can premium content')
                            <iframe class="absolute top-0 left-0 w-full h-full" src="{{ $selected['url_movie'] ?? '' }}"
                                title="Jav Player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen>
                            </iframe>
                        @else
                            <div class="absolute top-0 left-0 w-full h-full flex justify-center items-center">
                                <x-icons.crown isVip="true" default="60px" />
                                <div>
                                    <h1 class="text-gray-300 text-xl font-semibold">VIP Content</h1>
                                    <p class="text-base font-medium text-gray-400">you dont have VIP <a
                                            href="{{ route('vip') }}" class="text-rose-500 font-medium underline">upgrade youre
                                            account here</a></p>
                                </div>
                            </div>
                        @endcan
                    @else
                        <div class="absolute top-0 left-0 w-full h-full flex justify-center items-center">
                            <x-icons.crown isVip="true" default="60px" />
                            <div>
                                <h1 class="text-gray-300 text-xl font-semibold">VIP Content</h1>
                                <p class="text-base font-medium text-gray-400">you need to login first and <a
                                        href="{{ route('vip') }}" class="text-rose-500 font-medium underline">upgrade to
                                        VIP</a>
                                </p>
                            </div>
                        </div>
                    @endauth
                @else
                    @if ($selected['isVip'])
                        @auth
                            @can('can premium content')
                                <iframe class="absolute top-0 left-0 w-full h-full" src="{{ $selected['url_movie'] ?? '' }}"
                                    title="Jav Player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen>
                                </iframe>
                            @else
                                <div class="absolute top-0 left-0 w-full h-full flex justify-center items-center">
                                    <x-icons.crown isVip="true" default="60px" />
                                    <div>
                                        <h1 class="text-gray-300 text-xl font-semibold">VIP Quality Content</h1>
                                        <p class="text-base font-medium text-gray-400">you dont have VIP <a
                                                href="{{ route('vip') }}" class="text-rose-500 font-medium underline">upgrade
                                                youre
                                                account here</a></p>
                                        <p class="text-base font-medium text-gray-400"> or choose another quality</p>
                                    </div>
                                </div>
                            @endcan
                        @else
                            <div class="absolute top-0 left-0 w-full h-full flex justify-center items-center">
                                <x-icons.crown isVip="true" default="60px" />
                                <div>
                                    <h1 class="text-gray-300 text-xl font-semibold">VIP Quality Content</h1>
                                    <p class="text-base font-medium text-gray-400">you need to login first or <span
                                            class="text-rose-500 font-medium underline">choose another quality</span>
                                    </p>
                                </div>
                            </div>
                        @endauth
                    @else
                        <iframe class="absolute top-0 left-0 w-full h-full" src="{{ $selected['url_movie'] ?? '' }}"
                            title="Jav Player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    @endif
                @endif
            @else
                <div class="absolute top-0 left-0 w-full h-full flex justify-center items-center">
                        <h1 class="text-rose-500 text-2xl font-semibold">404 <span class="underline text-gray-500">Embed not found...</span></h1>
                </div>
            @endif
        </div>
        <div class="pb-[24%] flex flex-col items-center" wire:loading.flex wire:target="selectedEmbeds">
            <div class="mt-[24%]">

                <x-icons.loading-circle default="34px" />
            </div>
        </div>
        <section class="py-4 space-y-7">
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
                            <button type="button" class="flex space-x-1 items-center" wire:click="savePost" wire:loading.attr="disabled">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" wire:loading.remove wire:target="savePost">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                    </g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.62436 4.4241C3.96537 5.18243 2.75 6.98614 2.75 9.13701C2.75 11.3344 3.64922 13.0281 4.93829 14.4797C6.00072 15.676 7.28684 16.6675 8.54113 17.6345C8.83904 17.8642 9.13515 18.0925 9.42605 18.3218C9.95208 18.7365 10.4213 19.1004 10.8736 19.3647C11.3261 19.6292 11.6904 19.7499 12 19.7499C12.3096 19.7499 12.6739 19.6292 13.1264 19.3647C13.5787 19.1004 14.0479 18.7365 14.574 18.3218C14.8649 18.0925 15.161 17.8642 15.4589 17.6345C16.7132 16.6675 17.9993 15.676 19.0617 14.4797C20.3508 13.0281 21.25 11.3344 21.25 9.13701C21.25 6.98614 20.0346 5.18243 18.3756 4.4241C16.7639 3.68739 14.5983 3.88249 12.5404 6.02065C12.399 6.16754 12.2039 6.25054 12 6.25054C11.7961 6.25054 11.601 6.16754 11.4596 6.02065C9.40166 3.88249 7.23607 3.68739 5.62436 4.4241ZM12 4.45873C9.68795 2.39015 7.09896 2.10078 5.00076 3.05987C2.78471 4.07283 1.25 6.42494 1.25 9.13701C1.25 11.8025 2.3605 13.836 3.81672 15.4757C4.98287 16.7888 6.41022 17.8879 7.67083 18.8585C7.95659 19.0785 8.23378 19.292 8.49742 19.4998C9.00965 19.9036 9.55954 20.3342 10.1168 20.6598C10.6739 20.9853 11.3096 21.2499 12 21.2499C12.6904 21.2499 13.3261 20.9853 13.8832 20.6598C14.4405 20.3342 14.9903 19.9036 15.5026 19.4998C15.7662 19.292 16.0434 19.0785 16.3292 18.8585C17.5898 17.8879 19.0171 16.7888 20.1833 15.4757C21.6395 13.836 22.75 11.8025 22.75 9.13701C22.75 6.42494 21.2153 4.07283 18.9992 3.05987C16.901 2.10078 14.3121 2.39015 12 4.45873Z"
                                            class="{{ $hasPost ? 'fill-rose-400' : 'fill-gray-500' }}"></path>
                                    </g>
                                </svg>
                                <svg aria-hidden="true"
                                    class="w-4 h-4 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-rose-500"
                                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    wire:loading.flex wire:target="savePost">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="currentColor" />
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentFill" />
                                </svg>
                                <span class="sr-only">Loading...</span>
                                <div class="text-md font-semibold hidden sm:flex">Save</div>
                            </button>
                        </li>
                        <li>
                            <button type="button" class="flex space-x-1 items-center focus:opacity-60"
                                wire:click="getDownload">
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
                                <div class="text-md font-semibold hidden sm:flex">Download</div>
                            </button>
                        </li>
                        <li>
                            <button wire:click="reportIssue" type="button"
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
                                <div class="text-md font-semibold hidden sm:flex">Report issue</div>
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

    <livewire:watch.download :postId="$post->id" />
    <livewire:watch.report-issue :post_id="$post->id" />
</div>
