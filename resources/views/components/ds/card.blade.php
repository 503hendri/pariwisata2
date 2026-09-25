@props([
    'hover' => true,
    'href' => null,
    'wireClick' => null,
])

@php
    $base = 'bg-white dark:bg-zinc-900 rounded-3xl overflow-hidden border border-zinc-100 dark:border-zinc-800 transition-all duration-500';
    
    $hoverClasses = $hover 
        ? 'hover:-translate-y-2 hover:border-[#C6A75E]/50 hover:shadow-[0_20px_50px_-15px_rgba(198,167,94,0.3)]' 
        : '';
    
    $classes = $base . ' ' . $hoverClasses;
@endphp

@if ($href)
    <a href="{{ $href }}" wire:navigate {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@elseif ($wireClick)
    <button wire:click="{{ $wireClick }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@else
    <div {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </div>
@endif