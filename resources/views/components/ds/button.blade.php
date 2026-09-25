@props([
    'variant' => 'gold',
    'size' => 'md',
    'href' => null,
    'type' => 'button',
    'disabled' => false,
])

@php
    $base = 'inline-flex items-center justify-center font-semibold rounded-3xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-[#C6A75E] focus:ring-offset-2 focus:ring-offset-[#1C1C1C] dark:focus:ring-offset-zinc-950';
    
    $variants = [
        'gold' => 'bg-[#C6A75E] text-[#1C1C1C] hover:bg-[#bfa662] hover:scale-105 border border-[#C6A75E] hover:border-[#bfa662] disabled:bg-[#C6A75E]/50 disabled:cursor-not-allowed disabled:hover:scale-100',
        'dark' => 'bg-[#1C1C1C] text-white hover:bg-[#C6A75E] hover:text-[#1C1C1C] border border-[#1C1C1C] hover:border-[#C6A75E] disabled:bg-[#1C1C1C]/50 disabled:cursor-not-allowed disabled:hover:bg-[#1C1C1C]/50',
        'ghost' => 'border-2 border-white text-white hover:bg-white hover:text-[#1C1C1C] disabled:border-white/50 disabled:text-white/50 disabled:cursor-not-allowed disabled:hover:bg-transparent',
        'white' => 'bg-white text-[#1C1C1C] hover:bg-zinc-100 hover:scale-105 border border-zinc-200 hover:border-zinc-300 disabled:bg-zinc-100 disabled:cursor-not-allowed disabled:hover:scale-100',
    ];
    
    $sizes = [
        'sm' => 'px-4 py-2 text-sm',
        'md' => 'px-8 py-3 text-base',
        'lg' => 'px-10 py-4 text-lg',
    ];
    
    $classes = $base . ' ' . $variants[$variant] . ' ' . $sizes[$size];
    $attrs = $attributes->merge(['class' => $classes, 'disabled' => $disabled]);
@endphp

@if ($href)
    <a {{ $attrs }} href="{{ $href }}" wire:navigate>{{ $slot }}</a>
@else
    <button {{ $attrs }} type="{{ $type }}" wire:click.prevent="{{$attributes->get('wire:click') ?? ''}}">{{ $slot }}</button>
@endif