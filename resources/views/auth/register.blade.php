<x-guest-layout>
    <x-slot name="seo">
        {!! seo($SEOData) !!}
    </x-slot>
    <div class="w-full flex flex-col items-end space-y-2">
        <header class="w-full flex justify-end">
            <h1 class="text-gray-400 font-drukMedium text-6xl w-[80%] text-end">Already have account</h1>
        </header>
        <a href="{{ route('login') }}" class="w-[85%]">
            <div class="bg-rose-500 p-2 text-accent w-full flex justify-center text-xl font-medium">
                Login
            </div>
        </a>
    </div>
    <div class="sm:w-1 sm:h-[35vh] w-full h-1 opacity-0 sm:opacity-50 bg-rose-500"></div>
    <div class="w-full">
        <header>
            <h1 class="text-gray-400 font-drukMedium text-6xl mb-3">Register</h1>
        </header>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-inputs.input-icon id="name" type="text" name="name" :value="old('name')" required autofocus
                    autocomplete="name" placeholder="name">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <rect width="24" height="24" fill="white"></rect>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM11.9999 6C9.79077 6 7.99991 7.79086 7.99991 10C7.99991 12.2091 9.79077 14 11.9999 14C14.209 14 15.9999 12.2091 15.9999 10C15.9999 7.79086 14.209 6 11.9999 6ZM17.1115 15.9974C17.8693 16.4854 17.8323 17.5491 17.1422 18.1288C15.7517 19.2966 13.9581 20 12.0001 20C10.0551 20 8.27215 19.3059 6.88556 18.1518C6.18931 17.5723 6.15242 16.5032 6.91351 16.012C7.15044 15.8591 7.40846 15.7251 7.68849 15.6097C8.81516 15.1452 10.2542 15 12 15C13.7546 15 15.2018 15.1359 16.3314 15.5954C16.6136 15.7102 16.8734 15.8441 17.1115 15.9974Z"
                                fill="#323232"></path>
                        </g>
                    </svg>
                </x-inputs.input-icon>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-inputs.input-icon id="email" type="email" name="email" :value="old('email')" required
                    autocomplete="username" placeholder="email">
                    <svg fill="#000000" class="w-8 h-8" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M12,1a11,11,0,0,0,0,22,1,1,0,0,0,0-2,9,9,0,1,1,9-9v2.857a1.857,1.857,0,0,1-3.714,0V7.714a1,1,0,1,0-2,0v.179A5.234,5.234,0,0,0,12,6.714a5.286,5.286,0,1,0,3.465,9.245A3.847,3.847,0,0,0,23,14.857V12A11.013,11.013,0,0,0,12,1Zm0,14.286A3.286,3.286,0,1,1,15.286,12,3.29,3.29,0,0,1,12,15.286Z">
                            </path>
                        </g>
                    </svg>
                </x-inputs.input-icon>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-inputs.input-icon id="password" type="password" name="password" required autocomplete="new-password"
                    placeholder="password">
                    <svg class="w-8 h-8" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g id="Layer_2" data-name="Layer 2">
                                <g id="invisible_box" data-name="invisible box">
                                    <rect width="48" height="48" fill="none"></rect>
                                </g>
                                <g id="Layer_7" data-name="Layer 7">
                                    <g>
                                        <path
                                            d="M39,18H35V13A11,11,0,0,0,24,2H22A11,11,0,0,0,11,13v5H7a2,2,0,0,0-2,2V44a2,2,0,0,0,2,2H39a2,2,0,0,0,2-2V20A2,2,0,0,0,39,18ZM15,13a7,7,0,0,1,7-7h2a7,7,0,0,1,7,7v5H15ZM37,42H9V22H37Z">
                                        </path>
                                        <circle cx="15" cy="32" r="3"></circle>
                                        <circle cx="23" cy="32" r="3"></circle>
                                        <circle cx="31" cy="32" r="3"></circle>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </x-inputs.input-icon>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-inputs.input-icon id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" placeholder="confirm password">
                    <svg class="w-8 h-8" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g id="Layer_2" data-name="Layer 2">
                                <g id="invisible_box" data-name="invisible box">
                                    <rect width="48" height="48" fill="none"></rect>
                                </g>
                                <g id="Layer_7" data-name="Layer 7">
                                    <g>
                                        <path
                                            d="M39,18H35V13A11,11,0,0,0,24,2H22A11,11,0,0,0,11,13v5H7a2,2,0,0,0-2,2V44a2,2,0,0,0,2,2H39a2,2,0,0,0,2-2V20A2,2,0,0,0,39,18ZM15,13a7,7,0,0,1,7-7h2a7,7,0,0,1,7,7v5H15ZM37,42H9V22H37Z">
                                        </path>
                                        <circle cx="15" cy="32" r="3"></circle>
                                        <circle cx="23" cy="32" r="3"></circle>
                                        <circle cx="31" cy="32" r="3"></circle>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </x-inputs.input-icon>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center md:justify-end justify-start mt-4">
                <button type="submit"
                    class="bg-rose-500 p-2 text-accent w-[85%] flex justify-center text-xl font-medium focus:ring-4 focus:ring-gray-500">
                    Register
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
