@props(['active'])

@php
$classes = ($active ?? false)
    ? 'flex items-center px-6 py-3 text-gray-700 bg-gray-100'
    : 'flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>