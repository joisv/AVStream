<div class="min-h-screen sm:mb-[25vh] mb-[7vh] p-2 lg:p-0" wire:init="getPlans">
    <section class="max-w-4xl mx-auto mt-20 p-3 flex ">
        <header class="sm:w-1/2 w-full">
            <h1
                class="text-gray-300 hover:text-rose-500 ease-in duration-100 cursor-pointer font-extrabold text-3xl mb-3">
               Upgarde your account
            </h1>
            <p class="text-base font-light text-gray-400">Teman, ayo bergabung dengan komunitas kita dan rasakan manfaat eksklusif yang hanya tersedia untuk pelanggan setia 🌟. Yuk, segera langganan hari ini untuk pengalaman yang gak ada duanya! 💻🚀</p>
        </header>
    </section>
    <div class="mt-5 border-t-2 border-rose-400 py-10 md:px-5 px-2 flex justify-center max-w-4xl mx-auto">
        <div class="grid md:grid-cols-3 gap-3" :class="screenWidth > 517 ? 'grid-cols-2' : ''">
            @empty(!$plans)
                @forelse ($plans as $plan)
                    <div class="border-2 border-gray-500 p-3 border-opacity-70 w-full text-center group flex flex-col justify-between">
                        <div class="space-y-4">
                            <header class="flex flex-col items-center">
                                <h1 class="text-gray-400 font-semibold text-xl min-h-10">{{ $plan->duration }} {{ $plan->billing_cycle }}</h1>
                                <div class="h-1 rounded-sm mt-3 w-full bg-gradient-to-tr from-violet-800 to-rose-500"></div>
                            </header>
                            <div class="md:px-10 px-3 cursor-pointer ">
                                <h1 class="md:text-5xl text-xl font-bold text-gray-200">{{ $plan->price }}$</h1>
                                <p class="text-gray-400 text-base font-medium ">{{ $plan->description }}</p>
                            </div>
                        </div>
                        <button class="text-white uppercase mx-auto mt-4 text-lg font-bold bg-rose-500 p-2 group-hover:shadow-me ease-in duration-100 group-hover:-translate-y-1 w-fit" wire:click="modalSubmit({{ $plan }})">
                            get the plan
                        </button>
                    </div>

                @empty
                    <div>
                        no plans
                    </div>
                @endforelse
            @endempty
            @if ($loading)
                <div class="min-h-screen md:col-span-3 col-span-2 flex justify-center items-center">
                    <div
                        class="flex items-center justify-center md:h-44 lg:h-32 xl:h-44 h-28 max-w-sm rounded-lg animate-pulse dark:bg-gray-700">
                        <svg class="w-10 h-10 text-gray-200 dark:text-gray-600" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                            <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                            <path
                                d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM9 13a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2Zm4 .382a1 1 0 0 1-1.447.894L10 13v-2l1.553-1.276a1 1 0 0 1 1.447.894v2.764Z" />
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <livewire:vip-submit />
</div>
