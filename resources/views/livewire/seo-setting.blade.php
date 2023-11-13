<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <header>
        <h1 class="text-2xl font-semibold">Basic Info</h1>
    </header>
    <form wire:submit.prevent="save" class="py-4">
        <div class="md:w-[65%] w-full space-y-5">
            {{-- Logo --}}
            <div class="col-span-full">
                <div class="mt-2 space-y-2 items-center gap-x-3">
                    <div>
                        <x-inputs.label-input for="logo" class="text-gray-500">Logo</x-inputs.label-input>
                        <p class="text-sm text-gray-800">max 2mb recomended 354*100</p>
                    </div>
                    <div class="flex space-x-2 items-center">
                        @if ($logo)

                            @if (is_object($logo))
                                <div class="w-32 h-12">
                                    <img src="{{ $logo->temporaryUrl() }}" alt=""
                                        class="object-contain w-full h-full object-center">
                                </div>
                            @elseif (Str::startsWith($logo, 'logo'))
                                <div class="w-32 h-12">
                                    <img src="{{ asset('storage/' . $logo) }}" alt=""
                                        class="object-contain w-full h-full object-center">
                                </div>
                            @endif
                        @else
                            <div class="w-32 h-12">
                                <img src="{{ asset('images/nyan-cat.gif') }}" alt=""
                                    class="object-contain w-full h-full object-centert">
                            </div>
                        @endif
                        <div wire:loading.flex wire:target="logo" class="w-fit h-fit items-center justify-center"
                            wire:ignore>
                            <x-icons.loading />
                        </div>
                    </div>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 p-2"
                        id="logo" type="file" wire:model="logo">
                    @error('logo')
                        <span class="error">{{ $message }}</span>
                    @enderror

                </div>
            </div>
            <div class="col-span-full" x-data="{
                icon: 'max 2mb recomended (.ico) 100*100 '
            }">
                <div class="mt-2 space-y-2 items-center gap-x-3">
                    <div>
                        <x-inputs.label-input for="logo" class="text-gray-500">Favicon</x-inputs.label-input>
                        <p class="text-sm text-gray-800" x-text="icon"></p>
                    </div>
                    <div class="flex space-x-2 items-center">
                        @if ($favicon)

                            @if (is_object($favicon))
                                <div class="w-14 h-14">
                                    <img src="{{ $favicon->temporaryUrl() }}" alt=""
                                        class="object-cover object-center w-full h-full">
                                </div>
                            @elseif (Str::startsWith($favicon, 'favicon'))
                                <div class="w-14 h-14">
                                    <img src="{{ asset('storage/' . $favicon) }}" alt=""
                                        class="object-cover object-center w-full h-full">
                                </div>
                            @endif
                        @else
                            <div class="w-14 h-14">
                                <img src="{{ asset('images/nyan-cat.gif') }}" alt=""
                                    class="object-cover object-center w-full h-full">
                            </div>
                        @endif
                        <div wire:loading.flex wire:target="favicon" class="w-fit h-fit items-center justify-center">
                            <x-icons.loading />
                        </div>
                    </div>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 p-2"
                        id="logo" type="file" wire:model="favicon">
                    @error('favicon')
                        <span class="error">{{ $message }}</span>
                    @enderror

                </div>
            </div>
            <div class="w-full ">
                <x-inputs.label-input for="site_name" class="text-gray-500">Site name</x-inputs.label-input>
                <x-inputs.text-input wire:model.defer="site_name" id="site_name" placeholder="Youre site name" />
                @error('site_name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full">
                <x-inputs.label-input for="keywords" class="text-gray-500">Keywords</x-inputs.label-input>
                <x-inputs.textarea wire:model.defer="keywords" placeholder="keywords here (separate with commas ,)" />
                @error('keywords')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full">
                <x-inputs.label-input for="description" class="text-gray-500">Description</x-inputs.label-input>
                <x-inputs.textarea wire:model.defer="description" placeholder="Write your description here..." />
                @error('description')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div x-data="{ expanded: false }">
                <div class="flex justify-between py-2">
                    <x-inputs.label-input class="text-gray-500">Terms</x-inputs.label>
                        @if (auth()->user()->hasRole('super-admin'))
                            <a href="{{ route('terms.edit') }}"
                                class="w-fit h-fit px-1 rounded-sm bg-rose-400 text-white">edit</a>
                        @endif
                </div>
                <div @click="expanded = ! expanded"
                    class="w-full cursor-pointer p-2 border rounded-sm select-none border-gray-300 " x-show="expanded"
                    x-collapse.min.70px>
                    <article
                        class="prose prose-base lg:prose-lg prose-code:text-rose-500 prose-a:text-blue-600 prose-p:text-gray-900">
                        {!! $seoSetting->terms !!}
                    </article>
                </div>
            </div>
            <div x-data="{ expander: false }">
                <div class="flex justify-between py-2">
                    <x-inputs.label-input class="text-gray-500">About</x-inputs.label>
                        @if (auth()->user()->hasRole('super-admin'))
                            <a href="{{ route('about.edit') }}"
                                class="w-fit h-fit px-1 rounded-sm bg-rose-400 text-white">edit</a>
                        @endif
                </div>
                <div @click="expander = ! expander"
                    class="w-full cursor-pointer p-2 border rounded-sm select-none border-gray-300 " x-show="expander"
                    x-collapse.min.70px>
                    <article
                        class="prose prose-base lg:prose-lg prose-code:text-rose-500 prose-a:text-blue-600 prose-p:text-gray-900">
                        {!! $seoSetting->about !!}
                    </article>
                </div>
            </div>
            <div class="w-full ">
                <x-inputs.label-input for="whatsapp_number" class="text-gray-500">WhatsApp number</x-inputs.label-input>
                <x-inputs.text-input wire:model.defer="whatsapp_number" id="whatsapp_number"
                    placeholder="WhatsApp number for confirmation payment" />
                @error('whatsapp_number')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full ">
                <x-inputs.label-input for="banner_video_url" class="text-gray-500">Banner video <span
                        class="text-sm font-semibold text-gray-500">.mp4</span></x-inputs.label-input>
                <x-inputs.text-input wire:model.defer="banner_video_url" id="banner_video_url"
                    placeholder="Banner video url (mp4)" />
                @error('banner_video_url')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="w-full flex justify-end mt-4 md:mt-0">
            <x-primary-button wire:loading.attr="disabled" type="submit"
                custom="disabled:opacity-50 bg-rose-500 hover:bg-rose-600 focus:ring-rose-300">
                <x-slot name="icon">
                    <x-icons.edit />
                </x-slot>
                <x-slot name="child">
                    save
                </x-slot>
            </x-primary-button>
        </div>
    </form>
</div>
