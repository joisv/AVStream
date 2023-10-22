<x-modals maxWidth="sm">
    <div class="w-full bg-background border-rose-400 border-2 p-3 space-y-2">
        <header>
            <h1 class="text-xl font-semibold text-rose-400">Do you want to proceed with the subscription purchase?</h1>
        </header>
        <div class="w-full space-y-1 text-base text-gray-300 font-medium">
            <h2>Plan: {{ $duration }} {{ $billing_cycle }}</h2>
            <h3>Price: {{ $price }}</h3>
            <div>
                <label for="payment_option" class="block mb-2 text-sm font-medium text-gray-300">Payment option</label>
                <select id="payment_option"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-rose-500 focus:border-rose-500 block w-full p-2.5 "
                    wire:model.delay="payment_method">
                    <option selected>Choose a payment</option>
                    @forelse ($payment_option as $payment)
                        <option value="{{ $payment->name }}">{{ $payment->name }}</option>
                    @empty
                        <option value="US">payment is not available</option>
                    @endforelse
                </select>
            </div>
        </div>
        <h1 class="font-medium text-yellow-500 text-sm mt-2">Alert⚠ : After continue purchase check youre subscription
            log and notification</h1>
        <form wire:submit.prevent="save">
            <button type="submit"
                class="p-2 mt-4 bg-rose-500 ring-0 focus:ring-0 border-0 focus:border-0 outline-none text-lg font-medium text-white rounded-md">Continue
                purchase?</button>
        </form>
        <div class="absolute w-full left-0 -top-2 bg-gray-400 opacity-70 h-full" wire:loading.flex>
            <div class="w-full flex justify-center h-full items-center">
                <x-icons.loading-circle />
            </div>
        </div>
    </div>
</x-modals>
