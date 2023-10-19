<div >
    <div class="relative h-fit" wire:loading.remove>
        <div #swiperRef="" class="swiper mySwiper absolute">
            <div class="swiper-wrapper flex items-center">
                @forelse ($genres as $genre)
                    <div class="swiper-slide py-1 px-2 rounded-md border border-rose-400 hover:border-gray-400 w-fit text-start group">
                        <a href="{{ route('genre.show', $genre->slug) }}">
                            <h1 class="font-bold  sm:text-xl text-base text-gray-200 group-hover:text-rose-400 ease-in duration-100">
                                {{ Str::limit($genre->name, 9, '...') }}
                            </h1>
                            <p class="sm:text-base font-semibold text-gray-400 text-sm">{{ $genre->posts->count() }}</p>
                        </a>
                    </div>
                @empty
                    <div class="w-full p-4 font-bold text-xl text-gray-200">
                        no genre
                    </div>
                @endforelse
                <div class="swiper-slide py-1 px-2 w-fit text-start group">
                    <a href="{{ route('genres') }}">
                        <h1 class="font-bold  sm:text-xl text-base text-gray-200 group-hover:text-rose-400 ease-in duration-100">
                            More..
                        </h1>
                    </a>
                </div>
            </div>
        </div>
        <div class="absolute text-white top-2/3 right-2 shadow-2xl flex space-x-2 bg-gray-800 p-2 z-50">
            <button id="custom-prev-button">
                <svg fill="#000000" width="24px" height="24px" viewBox="0 0 24 24" id="left-arrow"
                    data-name="Flat Line" xmlns="http://www.w3.org/2000/svg" class="icon flat-line">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <line id="prev" x1="21" y1="12" x2="3" y2="12"
                            style="fill: none; stroke: #f4f4f4; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                        </line>
                        <polyline id="prev-2" data-name="prev" points="6 9 3 12 6 15"
                            style="fill: none; stroke: #f4f4f4; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                        </polyline>
                    </g>
                </svg>
            </button>
            <button id="custom-next-button">
                <svg fill="#000000" width="24px" height="24px" viewBox="0 0 24 24" id="left-arrow"
                    data-name="Flat Line" xmlns="http://www.w3.org/2000/svg" class="icon flat-line"
                    transform="rotate(180)">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <line id="next" x1="21" y1="12" x2="3" y2="12"
                            style="fill: none; stroke: #f4f4f4; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                        </line>
                        <polyline id="next-2" data-name="next" points="6 9 3 12 6 15"
                            style="fill: none; stroke: #f4f4f4; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                        </polyline>
                    </g>
                </svg>
            </button>
        </div>
    </div>

    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper;
        const prevButton = document.getElementById("custom-prev-button");
        const nextButton = document.getElementById("custom-next-button");

        function updateSwiper() {
            const screenWidth = window.innerWidth;
            var slidePerView = 9;

            if (screenWidth < 480) {
                slidePerView = 2
            } else if (screenWidth < 720) {
                slidePerView = 5;
            } else if (screenWidth < 1024) {
                slidePerView = 6;
            } else if (screenWidth < 1536) {
                slidePerView = 9
            }

            if (swiper) {
                swiper.destroy();
            }

            swiper = new Swiper(".mySwiper", {
                slidesPerView: slidePerView,
                centeredSlides: false,
                spaceBetween: 10,
                pagination: {
                    el: ".swiper-pagination",
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                }
            });


        }

        prevButton.addEventListener("click", function() {
            if (swiper) {
                swiper.slidePrev();
            }
        });

        nextButton.addEventListener("click", function() {
            if (swiper) {
                swiper.slideNext();
            }
        });

        window.addEventListener('DOMContentLoaded', updateSwiper);
        window.addEventListener('resize', updateSwiper);
    </script>
</div>
