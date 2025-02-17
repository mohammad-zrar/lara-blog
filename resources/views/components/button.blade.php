@props(['link' => false, 'variant' => 'fill'])

@php
    $styles = [
        'fill' => 'bg-orange-600 hover:bg-orange-600/90 text-gray-50 px-2 py-1 rounded-sm transition-all',
        'flat' =>
            'hover:bg-orange-50 text-orange-600 hover:text-orange-600/90 px-2 py-1 rounded-sm cursor-pointer transition-all',
        'outline' =>
            'border border-orange-600 text-orange-600 hover:bg-orange-50 hover:text-orange-600/90 px-2 py-1 rounded-sm cursor-pointer transition-all',
    ];

    // Validate variant
    $validVariants = ['fill', 'flat', 'outline'];
    $variant = in_array($variant, $validVariants) ? $variant : 'fill';
    $variantClass = $styles[$variant];
@endphp

@if ($link)
    <a {{ $attributes->class([$variantClass]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->class([$variantClass]) }}>
        {{ $slot }}
    </button>
@endif
