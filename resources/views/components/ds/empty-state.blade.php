@props([
    'title' => 'Belum Ada Data',
    'description' => 'Data akan ditampilkan setelah tersedia.',
    'icon' => 'magnifying-glass',
])

@php
    $iconMap = [
        'magnifying-glass' => 'M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z',
        'calendar' => 'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5',
        'inbox' => 'M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.012-1.244h.88m-13.5-3h.38m-.38 0h-.37m13.5 0h-.38m.38 0h.37M9.75 15h.008v.008H9.75V15zm0-3.75h.008v.008H9.75V11.25zm0-3.75h.008v.008H9.75V7.5zm3.75 7.5h.008v.008H13.5V15zm0-3.75h.008v.008H13.5V11.25zm0-3.75h.008v.008H13.5V7.5z',
        'chart-bar' => 'M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z',
    ];
    
    $iconPath = $iconMap[$icon] ?? $iconMap['magnifying-glass'];
@endphp

<div {{ $attributes->merge(['class' => 'text-center py-16 px-8']) }}>
    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-zinc-100 dark:bg-zinc-800 mb-6">
        <svg class="w-8 h-8 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $iconPath }}"/>
        </svg>
    </div>
    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">{{ $title }}</h3>
    <p class="text-zinc-500 text-sm max-w-md mx-auto">{{ $description }}</p>
</div>