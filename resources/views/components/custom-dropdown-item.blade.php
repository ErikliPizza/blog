@props(['active' => false])

@php
    $classes = "dropdown-item text-secondary ";
    if ($active) $classes .= 'text-dark';
@endphp
<a
    {{ $attributes(['class' => $classes]) }}
>
    {{ $slot }}
</a>
