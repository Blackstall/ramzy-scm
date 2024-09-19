@props(['active'])

@php
$classes = ($active ?? false)
            ? 'bg-red-600'
            : 'hover:bg-red-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => 'block py-2.5 px-4 rounded ' . $classes]) }}>
    {{ $slot }}
</a>
