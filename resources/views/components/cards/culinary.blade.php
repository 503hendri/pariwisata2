@props(['culinary'])

<div class="group relative rounded-3xl overflow-hidden h-80" wire:key="culinary-{{ $culinary->id }}" lazy>
    <img src="{{ asset('storage/' . $culinary->image) }}"
        class="w-full h-full object-cover group-hover:scale-110 transition-transform" alt="{{ $culinary->name }}">
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent"></div>
    <div class="absolute bottom-6 left-6">
        <div class="text-[#C6A75E] text-xs">{{ $culinary->category }}</div>
        <div class="text-3xl heading-font">{{ $culinary->name }}</div>
    </div>
</div>
