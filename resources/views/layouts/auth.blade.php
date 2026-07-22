<x-layouts::auth.simple :title="$title ?? null" :footer="$footer ?? null" :links="$links ?? null">
    {{ $slot }}
</x-layouts::auth.simple>
