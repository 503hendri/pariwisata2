@props([
    'tone' => 'gold',
])

@php
    $tones = [
        'gold' => 'bg-[#C6A75E] text-[#1C1C1C]',
        'dark' => 'bg-[#1C1C1C] text-white',
        'light' => 'bg-white text-[#1C1C1C] border border-zinc-200',
    ];
    
    $classes = 'inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] ' . $tones[$tone];
    $attrs = $attributes->merge(['class' => $classes]);
@endphp

<span {{ $attrs }}>{{ $slot }}</span>