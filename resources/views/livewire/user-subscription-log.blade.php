@php
    switch ($sort) {
        case 'pending':
            $key = 'Pending';
            break;
        case 'active':
            $key = 'Active';
            break;
        case 'cancelled':
            $key = 'cancelled';
            break;
        case 'expired':
            $key = 'Expired';
            break;

        default:
            $key = 'Latest';
            break;
    }
@endphp
<div class="min-h-screen sm:mb-[25vh] mb-[50vh]" x-data="{
    wa_link: 'https://web.whatsapp.com/send',
    phone: @js($whatsapp),
    invoice_number: @js($usersSubscription->payment_code),
    user_name: @js($usersSubscription->user->name),
    billing: @js($usersSubscription->billing_amount),
    email: @js($usersSubscription->user ? $usersSubscription->user->email : ''),
    message: '*Confirm payment*',

    confirmPayment() {
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            this.wa_link = 'whatsapp://send';
        }
    
        const final_url = this.wa_link +
            '?phone=' + encodeURIComponent(this.phone) +
            '&text=' + encodeURIComponent(this.message + '\n\n' +
                'Name: ' + this.user_name + '\n' +
                'Email Address: ' + this.email + '\n' +
                'Invoice: ' + this.invoice_number + '\n' +
                'Amount: ' + this.billing
            );
    
        window.open(final_url, '_blank');
    }
    
}"
>
    <div class="max-w-2xl h-32 mx-auto p-3 space-y-2 mt-20">
        <div class="flex justify-end items-center my-4">
            @empty(!$usersSubscription)
                <button @click="confirmPayment"
                    class="focus:ring-4 focus:ring-rose-500 rounded-sm p-2 text-sm ease-in duration-100 text-gray-200 font-semibold bg-gray-900 hover:ring-2 hover:ring-rose-400">
                    Confirm payment
                </button>
            @endempty
            <x-dropdown-navigation align="right" width="48">
                <x-slot name="trigger">
                    <button
                        class="inline-flex items-center px-3 py-2 border border-transparent text-base leading-4 dark:text-gray-400 bg-transparent text-gray-200 font-bold focus:outline-none transition ease-in-out duration-150">
                        <div class="hover:text-rose-400 ease-in duration-150 text-lg">Sort by: {{ $key }}</div>

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
                    <div class="space-y-1">
                        <label for="created_at"
                            class="relative block w-full px-4 py-2 text-left text-sm font-semibold leading-5 text-gray-700 dark:text-gray-300 hover:bg-slate-300 transition duration-150 ease-in-out">
                            <input type="radio" name="" id="created_at" value="created_at"
                                class="absolute opacity-0" wire:model.lazy="sort">
                            New created
                        </label>
                        <label for="active"
                            class="relative block w-full px-4 py-2 text-left text-sm font-semibold leading-5 text-gray-700 dark:text-gray-300 hover:bg-slate-300 transition duration-150 ease-in-out">
                            <input type="radio" name="" id="active" value="active"
                                class="absolute opacity-0" wire:model.lazy="sort">
                            Active
                        </label>
                        <label for="pending"
                            class="relative block w-full px-4 py-2 text-left text-sm font-semibold leading-5 text-gray-700 dark:text-gray-300 hover:bg-slate-300 transition duration-150 ease-in-out">
                            <input type="radio" name="" id="pending" value="pending"
                                class="absolute opacity-0" wire:model.lazy="sort">
                            Pending
                        </label>
                        <label for="expired"
                            class="relative block w-full px-4 py-2 text-left text-sm font-semibold leading-5 text-gray-700 dark:text-gray-300 hover:bg-slate-300 transition duration-150 ease-in-out">
                            <input type="radio" name="" id="expired" value="expired"
                                class="absolute opacity-0" wire:model.lazy="sort">
                            Expired
                        </label>
                        <label for="cancelled"
                            class="relative block w-full px-4 py-2 text-left text-sm font-semibold leading-5 text-gray-700 dark:text-gray-300 hover:bg-slate-300 transition duration-150 ease-in-out">
                            <input type="radio" name="" id="cancelled" value="cancelled"
                                class="absolute opacity-0" wire:model.lazy="sort">
                            Cancelled
                        </label>
                    </div>
                </x-slot>
            </x-dropdown-navigation>
        </div>
        @empty(!$subscriptions)
            @forelse ($subscriptions as $subscribe)
                <div class="bg-gray-800 w-full py-2 px-4" wire:loading.remove>
                    <div class="flex justify-between items-center">
                        <div class="flex space-x-2">
                            <h1 class="text-2xl font-semibold text-gray-200">{{ $subscribe->payment_code }}</h1>
                            <h3
                                class='{{ $subscribe->status === 'active' ? 'bg-rose-500 text-white' : ($subscribe->status === 'pending' ? 'bg-yellow-500 text-white' : ($subscribe->status === 'expired' ? 'bg-white text-black' : '')) }} px-1 text-sm text-center h-fit '>
                                {{ $subscribe->status }}</h3>
                        </div>
                        <div>
                            <h2 class="text-gray-300 font-medium text-lg">{{ $subscribe->user->name ?? '' }}</h2>
                        </div>
                    </div>
                    <div class="space-y-1 mt-3 sm:grid sm:grid-cols-2">
                        <div class="flex space-x-1 h-fit col-span-2">
                            <h1 class="font-medium text-gray-200">User Id:</h1>
                            <h2 class="text-gray-300 font-medium">{{ $subscribe->user_id }}</h2>
                        </div>
                        <div class="flex space-x-1 h-fit">
                            <h1 class="font-medium text-gray-200">Start Date:</h1>
                            <h2 class="text-gray-300 font-medium">{{ $subscribe->start_date }}</h2>
                        </div>
                        <div class="flex space-x-1 h-fit">
                            <h1 class="font-medium text-gray-200">End Date:</h1>
                            <h2 class="text-gray-300 font-medium">{{ $subscribe->end_date }}</h2>
                        </div>
                        <div class="flex space-x-1 h-fit">
                            <h1 class="font-medium text-gray-200">Blling Amount:</h1>
                            <h2 class="text-gray-300 font-medium">{{ $subscribe->billing_amount }}</h2>
                        </div>
                        <div class="flex space-x-1 h-fit">
                            <h1 class="font-medium text-gray-200">Payment Method:</h1>
                            <h2 class="text-gray-300 font-medium">{{ $subscribe->payment_method }}</h2>
                        </div>
                    </div>
                </div>
            @empty
                <div class="min-h-[50vh] flex justify-center items-center font-bold text-3xl text-gray-300">No subscriptions
                    to display</div>
            @endforelse
        @endempty
        <div class="w-full justify-center" wire:loading.flex>
            <div
                class="flex items-center justify-center min-h-[50vh]  max-w-sm rounded-lg w-full animate-pulse dark:bg-gray-700">
                <svg class="w-10 h-10 text-gray-600 dark:text-gray-600" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                    <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                    <path
                        d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM9 13a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2Zm4 .382a1 1 0 0 1-1.447.894L10 13v-2l1.553-1.276a1 1 0 0 1 1.447.894v2.764Z" />
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div class="w-full">
            {{ $subscriptions->onEachSide(2)->links('components.paginations') }}
        </div>
    </div>
</div>
