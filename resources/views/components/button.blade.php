@props(['variant' => 'primary', 'href' => null])

@php
    $base = 'inline-flex items-center justify-center rounded-lg px-4 py-2 text-sm font-semibold transition focus-visible:outline-2 focus-visible:outline-offset-2';

    $variants = [
        'primary' => 'bg-orange-500 text-white hover:bg-orange-600 focus-visible:outline-orange-500',
        'secondary' => 'bg-white text-slate-800 ring-1 ring-slate-300 hover:bg-slate-100 focus-visible:outline-blue-700',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus-visible:outline-red-600',
    ];

    $classes = $base.' '.($variants[$variant] ?? $variants['primary']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => $classes]) }}>{{ $slot }}</button>
@endif
