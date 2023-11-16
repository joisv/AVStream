<div class="min-h-screen sm:mb-[25vh] mb-[7vh] p-2 lg:p-0">
    <section class="w-full h-44 p-3 flex justify-center items-end mb-5">
        <header class="lg:w-[40%] w-[80%] text-center ">
            <h1
                class="text-gray-300 hover:text-rose-500 ease-in duration-100 cursor-pointer font-extrabold text-2xl mb-3">
                Actress List
            </h1>
            @if ($actresses->currentPage() === 1)
                <x-inputs.text wire:model.debounce.500ms="search" placeholder="Search actress name..." />
            @endif
        </header>
    </section>
    @if ($actresses->currentPage() === 1)
        <div class="md:flex md:justify-between grid grid-cols-2 gap-3 md:gap-0 py-4 md:space-x-5">
            <div class="w-full" wire:loading.remove>
                <select id="height"
                    class="bg-gray-800 border-2 border-gray-500 text-sm rounded-md focus:ring-rose-500 focus:border-rose-500 block w-full p-2.5 text-white font-medium"
                    wire:model.lazy="selectedHeightRange">
                    <option selected>Select height</option>
                    @forelse ($heightRanges as $height)
                        <option value="{{ $height }}">Between {{ $height }} cm</option>
                    @empty
                        <option value="">No height found</option>
                    @endforelse
                </select>

            </div>
            <div class="w-full">
                <select id="cup"
                    class="bg-gray-800 border-2 border-gray-500 text-sm rounded-md focus:ring-rose-500 focus:border-rose-500 block w-full p-2.5 text-white font-medium"
                    wire:model.lazy="selectedCupRange">
                    <option selected value="">Select cup</option>
                    @forelse (json_decode($cupRanges) as $cup)
                        <option value="{{ $cup->cup_size }}">{{ $cup->cup_size }} Cup</option>
                    @empty
                        <option value="">No cup found</option>
                    @endforelse
                </select>
            </div>
            <div class="w-full">
                <select id="countries"
                    class="bg-gray-800 border-2 border-gray-500 text-sm rounded-md focus:ring-rose-500 focus:border-rose-500 block w-full p-2.5 text-white font-medium"
                    wire:model.lazy="selectedAgeRange">
                    <option selected>Select age</option>
                    @forelse ($ageRanges as $age)
                        <option value="{{ $age }}">Between {{ $age }}</option>
                    @empty
                        <option value="">No age found</option>
                    @endforelse
                </select>

            </div>
            <div class="w-full">
                <select id="countries"
                    class="bg-gray-800 border-2 border-gray-500 text-sm rounded-md focus:ring-rose-500 focus:border-rose-500 block w-full p-2.5 text-white font-medium"
                    wire:model.lazy="selectedDebutRange">
                    <option selected>Select debut year</option>
                    @forelse (array_reverse($debutRanges) as $debut)
                        <option value="{{ $debut }}">Between {{ $debut }}</option>
                    @empty
                        <option value="">No debut found</option>
                    @endforelse
                </select>

            </div>
        </div>
    @endif
    <div class="rounded-md bg-gray-800 p-10 mb-10 min-h-fit">
        <div class="grid lg:grid-cols-6 md:grid-cols-4 gap-8 justify-center" x-cloak
            :class="screenWidth <= 410 ? 'grid-cols-2' : 'grid-cols-3'">
        @empty(!$actresses)
            @forelse ($actresses as $actress)
                <a href="{{ route('actress', $actress->slug) }}">
                    <div class="text-white flex flex-col items-center" wire:loading.remove>
                        <div class="md:w-24 md:h-24 w-20 h-20 rounded-full overflow-hidden">
                            <img src="{{ asset('storage/' . $actress->profile) }}" alt="" srcset=""
                                class="w-full h-full object-cover object-center">
                        </div>
                        <div class="text-center">
                            <h1 class="w-40 mt-4 text-amber-300 opacity-75 font-semibold md:text-xl text-lg">
                                {{ $actress->name }}
                            </h1>
                            <div class="text-gray-400 font-semibold md:text-lg text-base">
                                <h3>{{ $actress->posts->count() }} videos</h3>
                                <h3>Debut {{ $actress->debut }}</h3>
                            </div>
                        </div>

                    </div>
                </a>
            @empty
                <div wire:loading.remove class="text-xl font-semibold text-gray-300 p-16 col-span-6 text-center">
                    No Jav found</div>
            @endforelse

        @endempty
        <div class="col-span-6 mx-auto min-h-[25vh]" wire:loading.flex>
            <x-icons.loading-circle />
        </div>
    </div>
</div>
<div class="w-full">
    {{ $actresses->onEachSide(2)->links('components.paginations') }}
</div>
</div>
