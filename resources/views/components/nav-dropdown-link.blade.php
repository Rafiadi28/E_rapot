@props(['active' => false])

<a {{ $attributes->merge(['class' => 'block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 rounded transition duration-150 ease-in-out']) }}>
    {{ $slot }}
</a>