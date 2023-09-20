@props([
    'default' => 'bg-blue-700 hover:bg-blue-800 focus:ring-blue-300',
    'custom' => '',
])

<button
    {{ $attributes->merge(['class' => 'text-white ' . ($custom ? $custom : $default) . ' focus:ring-4 focus:outline-none font-medium rounded-md text-sm px-3 py-2 text-center inline-flex items-center mr-2']) }}>
    <div>
        {{ $icon ?? null }}
    </div>
    {{ $child ?? null }}
</button>
