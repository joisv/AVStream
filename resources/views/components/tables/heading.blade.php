@props([
    'sortable' => null,
    'direction' => null
])

<th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" scope="col">
    <button type="button" {{ $attributes }}>
        {{ $slot }}
    </button>
</th>