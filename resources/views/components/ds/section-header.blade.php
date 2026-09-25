@props([
    'eyebrow' => null,
    'title' => null,
    'description' => null,
    'align' => 'left',
    'theme' => 'light',
    'eyebrowClass' => null,
])

@php
    $alignClasses = match($align) {
        'center' => 'text-center items-center',
        'right' => 'text-right items-end',
        default => 'text-left items-start',
    };
    
    $eyebrowClasses = 'uppercase text-[#C6A75E] text-sm font-semibold tracking-[0.3em] block mb-2 ' . $eyebrowClass;
    
    $titleClasses = match($theme) {
        'dark' => 'heading-font text-4xl md:text-5xl font-bold text-white',
        default => 'heading-font text-4xl md:text-5xl font-bold text-[#1C1C1C] dark:text-white',
    };
    
    $descriptionClasses = match($theme) {
        'dark' => 'text-zinc-300 mt-4 max-w-2xl',
        default => 'text-zinc-600 mt-4 max-w-2xl',
    };
    
    $dividerClass = $align === 'center' ? 'mx-auto' : '';
@endphp

<div class="flex flex-col {{ $alignClasses }} mb-10 md:mb-12">
    @if ($eyebrow)
        <div class="flex flex-col {{ $align === 'center' ? 'items-center' : '' }} mb-3">
            <span class="{{ $eyebrowClasses }}">{{ $eyebrow }}</span>
            <div class="{{ $dividerClass }} w-12 h-0.5 bg-[#C6A75E] mt-2"></div>
        </div>
    @endif
    
    @if ($title)
        <h2 class="{{ $titleClasses }}">{{ $title }}</h2>
    @endif
    
    @if ($description)
        <p class="{{ $descriptionClasses }}">{{ $description }}</p>
    @endif
</div>