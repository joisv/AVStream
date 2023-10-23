<div>
    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : ($this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1))

        <nav class="md:flex-1 md:flex md:items-center md:justify-center text-white">
            <ul
                class="pagination relative z-0 inline-flex shadow-sm space-x-1 w-full justify-between md:justify-center md:w-fit">
                {{-- Previous Page Link --}}
                @if (!$paginator->onFirstPage())
                    <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')"
                        wire:loading.attr="disabled"
                        dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before"
                        rel="prev" aria-label="@lang('pagination.previous')">
                        <li
                            class="disabled relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-nord4 rounded-lg leading-5 hover:bg-gray-400 active:bg-gray-400 transition ease-in-out duration-150">

                            <svg class="w-5 h-5 -rotate-180" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <h3 class="text-gray-200 flex md:hidden font-semibold text-base">Previous</h3>
                        </li>
                    </button>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="disabled hidden md:flex" aria-disabled="true"><span>{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            <span
                                wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page{{ $page }}">

                                @if ($page == $paginator->currentPage())
                                    <span class="bg-rose-500 hidden md:inline-flex relative items-center px-4 py-2 -ml-px text-sm font-medium text-nord4 leading-5 rounded-lg hover:bg-nord1 focus:z-10 focus:outline-none active:bg-nord1 transition ease-in-out duration-150 cursor-pointer"
                                        aria-current="page"><p>{{ $page }}</p></span>
                                @else
                                    <button type="button" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        <span
                                            class="relative  hidden md:inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-nord4 leading-5 rounded-lg hover:bg-gray-400 focus:z-10 focus:outline-none active:bg-gray-400 transition ease-in-out duration-150">
                                            {{ $page }}</span>
                                    </button>
                                @endif
                            </span>
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')"
                        wire:loading.attr="disabled"
                        dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before"
                        aria-label="@lang('pagination.next')">
                        <li
                            class="disabled relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-nord4 rounded-lg leading-5 hover:bg-gray-400 active:bg-gray-400 transition ease-in-out duration-150">
                            <h3 class="text-gray-200 flex md:hidden font-semibold text-base">Next page</h3>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </li>
                        </a>
                @endif
            </ul>
        </nav>
    @endif
</div>
