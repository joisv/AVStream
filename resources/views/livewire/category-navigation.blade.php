<div>
    <div class="hidden sm:flex">
        <x-dropdown-navigation align="right" width="48">
            <x-slot name="trigger">
                <button
                    class="inline-flex items-center px-3 py-2 border border-transparent text-base leading-4 dark:text-gray-400 bg-transparent text-gray-200 font-bold focus:outline-none transition ease-in-out duration-150 hover:text-rose-400">
                    <div>Category</div>

                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                @forelse ($categories as $category)
                    <x-dropdown-link href="{{ route('category', $category->slug) }}">
                        <p class="font-semibold">{{ $category->name }}</p>
                    </x-dropdown-link>
                @empty
                    <x-dropdown-link>
                        <p class="font-semibold">No categories found</p>
                    </x-dropdown-link>
                @endforelse

            </x-slot>
        </x-dropdown-navigation>
    </div>
    <div class="sm:hidden flex">
        <div class="w-full">
            <button @click="category = ! category" class="flex justify-between w-full items-center px-2 font-medium">
                <span class="text-sm">Category</span>
                <div class="ease-in duration-100" :class="{ 'rotate-180': category }">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
            <div x-show="category" class="bg-gray-600 py-1">
                @forelse ($categories as $category)
                    <x-dropdown-link href="{{ route('category', $category->slug) }}">
                        <p class="font-semibold text-gray-200">{{ $category->name }}</p>
                    </x-dropdown-link>
                    @empty
                    <x-dropdown-link >
                        <p class="font-semibold text-gray-200">No category</p>
                    </x-dropdown-link>
                @endforelse
            </div>
        </div>
    </div>
</div>
