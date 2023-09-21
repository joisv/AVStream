<x-guest-layout>

    <div class="w-full flex flex-col items-end space-y-2 ">
        <header class="w-full flex justify-end">
            <h1 class="text-gray-400 font-drukMedium text-6xl w-[80%] text-end">Dont have account</h1>
        </header>
        <a href="{{ route('register') }}" class="w-[85%]">
            <div class="bg-rose-500 p-2 text-accent w-full flex justify-center text-xl font-medium">
                Register
            </div>
        </a>
    </div>
    <div class="sm:w-1 sm:h-[35vh] w-full h-1 opacity-0 sm:opacity-50 bg-rose-400"></div>
    <div class="w-full mt-2 p-2">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <header>
            <h1 class="text-gray-400 font-drukMedium text-6xl mb-3">Login</h1>
        </header>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <div>
                <x-inputs.input-icon id="email" placeholder='email' type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username">
                    <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                        <path
                            d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                        <path
                            d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                    </svg>
                </x-inputs.input-icon>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-inputs.input-icon id="password" type="password" name="password" required
                    autocomplete="current-password" placeholder="password">
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

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center md:justify-end justify-start mt-4">
                {{-- @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif --}}

               <button type="submit" class="bg-rose-500 w-[85%] p-2 text-accent flex justify-center text-xl font-medium focus:ring-4 focus:ring-gray-500">
                Login
               </button>
            </div>
        </form>
    </div>
</x-guest-layout>
