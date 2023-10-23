<footer class="relative mt-52">
    <div class="w-full bg-background md:py-12 py-0 lg:px-16 md:px-8 px-4 ">
        <div class="max-w-7xl mx-auto">
            <div class="lg:flex space-y-8 lg:space-y-0 lg:space-x-32">
                <div class="lg:w-1/3 w-full ">
                    @if ($setting->logo)
                    <div class="w-1/2">
                        <img src="{{ asset('storage/' . $setting->logo) }}" alt="" srcset="" class="object-containt">
                    </div>
                    @else
                        <h1 class="text-rose-400 font-semibold text-3xl uppercase">AV<span
                                class="text-gray-200">STREAM</span>
                            </h1>
                    @endif
                    <p class="text-gray-600 font-semibold lg:text-base text-base mt-5">{{ $setting->description ?? '' }}</p>
                </div>
                <div class="grid grid-cols-2 gap-4 lg:flex lg:space-x-10">
                    <div>
                        <h1 class="uppercase lg:text-base text-base text-gray-500 font-extrabold">Videos</h1>
                        <ul class=" text-gray-600 font-semibold">
                            <li class="mt-2">
                                <a href="{{ route('watch.by', ['keyword' => 'updated_at']) }}">
                                    <h1 class="hover:text-rose-400 ease-out duration-200 lg:text-base md:text-lg">Recent
                                        Update</h1>
                                </a>
                            </li>
                            <li class="mt-2">
                                <a href="{{ route('watch.by', ['keyword' => 'created_at']) }}">
                                    <h1 class="hover:text-rose-400 ease-out duration-200 lg:text-base md:text-lg text-sm">New
                                        Release</h1>
                                </a>
                            </li>
                            <li class="mt-2">
                                <a href="{{ route('watch.by', ['keyword' => 'most_watch_today']) }}">
                                    <h1 class="hover:text-rose-400 ease-out duration-200 lg:text-base md:text-lg text-sm">Most
                                        Watched</h1>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h1 class="uppercase lg:text-base text-base text-gray-500 font-extrabold">Search</h1>
                        <ul class=" text-gray-600 font-semibold">
                            <li class="mt-2">
                                <a href="{{ route('actresses') }}">
                                    <h1 class="hover:text-rose-400 ease-out duration-200 lg:text-base md:text-lg text-sm">Actress
                                    </h1>
                                </a>
                            </li>
                            <li class="mt-2">
                                <a href="{{ route('genres') }}">
                                    <h1 class="hover:text-rose-400 ease-out duration-200 lg:text-base md:text-lg text-sm">Genre
                                    </h1>
                                </a>
                            </li>
                            <li class="mt-2">
                                <a href="{{ route('studios') }}">
                                    <h1 class="hover:text-rose-400 ease-out duration-200 lg:text-base md:text-lg text-sm">Studio
                                    </h1>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h1 class="uppercase lg:text-base text-base text-gray-500 font-extrabold">Link</h1>
                        <ul class=" text-gray-600 font-semibold">
                            <li class="mt-2">
                                <a href="{{ route('contact') }}">
                                    <h1 class="hover:text-rose-400 ease-out duration-200 lg:text-base md:text-lg text-sm">Contacts
                                    </h1>
                                </a>
                            </li>
                            <li class="mt-2">
                                <a href="{{ route('terms') }}">
                                    <h1 class="hover:text-rose-400 ease-out duration-200 lg:text-base md:text-lg text-sm">Terms
                                    </h1>
                                </a>
                            </li>
                            <li class="mt-2">
                                <a href="{{ route('about') }}">
                                    <h1 class="hover:text-rose-400 ease-out duration-200 lg:text-base md:text-lg text-sm">About
                                    </h1>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- <div class="absolute bottom-0 text-rose-500 right-16 p-2 font-semibold">
                <h1>{{ $version }}</h1>
                <h2 class="text-gray-600 text-sm italic">{{ $made }}</h2>
            </div> --}}
        </div>
    </div>
</footer>
