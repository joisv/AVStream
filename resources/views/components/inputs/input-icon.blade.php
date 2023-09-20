@props(['disabled' => false])

{{-- <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}> --}}

<div class="relative ">
    <div class="absolute inset-y-0 -left-1 flex items-center pl-3.5 pointer-events-none opacity-50">
        {{ $slot }}
    </div>
    <input {!! $attributes->merge(['class' => 'text-lg border border-0 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block w-full pl-12 p-2.5 ']) !!}>
</div>