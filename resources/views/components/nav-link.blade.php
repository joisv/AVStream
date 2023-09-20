@props(['active'])

@php
$default_class = 'inline-flex gap-3 items-center p-3 text-sm font-semibold leading-5 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out w-full';

$isActive = 'bg-gray-900 text-gray-200 ';
$isNotActive = 'hover:bg-gray-900 text-gray-200 border border-gray-200';

$classes = ($active ?? false)
            ? $isActive .' '. $default_class
            : $isNotActive . ' ' . $default_class;
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
