<div>
    <div class="relative h-fit">
        <div #swiperRef="" class="swiper mySwiper absolute">
            <div class="swiper-wrapper">
                <div class="swiper-slide p-1 rounded-md border border-rose-500 w-fit text-center">
                    <h1 class="font-bold  sm:text-xl text-base text-gray-200">
                        Incest
                    </h1>
                    <p class="sm:text-base font-medium text-gray-300 text-sm">2093</p>
                </div>
            </div>
            {{-- <div class="swiper-pagination"></div> --}}
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
            var slidePerView = 2;

            if(screenWidth < 480) {
                slidePerView = 2
            }
            else if (screenWidth < 720) {
                slidePerView = 5;
            } else if (screenWidth < 1024) {
                slidePerView = 6;
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

            // if (swiper && swiper.activeIndex === 0) {
            //     prevButton.classList.toggle("stroke-gray-400");
            // } else {
            //     prevButton.classList.toggle("stroke-gray-200");
            // }

            // if (swiper && swiper.activeIndex >= swiper.slides.length - slidePerView) {
            //     nextButton.classList.add("stroke-gray-400");
            //     nextButton.classList.remove("stroke-gray-200");
            // } else {
            //     nextButton.classList.add("stroke-gray-200");
            //     nextButton.classList.remove("stroke-gray-400");
            // }
           

        }

        // Mengatur fungsi untuk tombol custom previous
        prevButton.addEventListener("click", function() {
            if (swiper) {
                swiper.slidePrev();
            }
        });

        // Mengatur fungsi untuk tombol custom next
        nextButton.addEventListener("click", function() {
            if (swiper) {
                swiper.slideNext();
            }
        });

        // Panggil fungsi saat halaman dimuat dan saat ukuran layar berubah
        window.addEventListener('DOMContentLoaded', updateSwiper);
        window.addEventListener('resize', updateSwiper);
    </script>
</div>
