@props([
    'destinations' => collect(),
])

@php
    $items = $destinations instanceof \Illuminate\Support\Collection ? $destinations : collect($destinations);

    $validCoordinate = function ($lat, $lng) {
        if (! is_numeric($lat) || ! is_numeric($lng)) {
            return false;
        }
        $lat = (float) $lat;
        $lng = (float) $lng;

        return $lat !== 0.0 && $lng !== 0.0 && $lat >= -90 && $lat <= 90 && $lng >= -180 && $lng <= 180;
    };

    $validPhone = function ($value) {
        return is_string($value) && preg_match('/^\+?[0-9][0-9\s\-()]{7,}$/', trim($value));
    };

    $validText = function ($value, $min = 10) {
        return is_string($value) && strlen(trim($value)) >= $min && strtoupper(trim($value)) !== 'TEST';
    };

    $formatPrice = function ($destination) {
        $entry = $destination->entry_fee !== null ? (float) $destination->entry_fee : null;
        $min = $destination->price_range_min !== null ? (float) $destination->price_range_min : null;
        $max = $destination->price_range_max !== null ? (float) $destination->price_range_max : null;

        $short = fn ($amount) => 'IDR ' . number_format($amount / 1000, 0) . 'k';

        if ($min && $max && $max > $min) {
            return $short($min) . ' - ' . $short($max);
        }

        $single = $entry ?: ($min ?: null);

        if ($single) {
            return 'Mulai ' . $short($single);
        }

        if ($entry === 0.0) {
            return 'Gratis';
        }

        return 'Hubungi Kami';
    };
@endphp

@if ($items->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
        @foreach ($items as $destination)
            @php
                $slug = $destination->slug;
                $name = $destination->name;
                $cover = $destination->cover;
                $rating = (float) $destination->rating;
                $reviews = (int) $destination->review_count;
                $address = $validText($destination->address, 8) ? $destination->address : null;
                $description = \Illuminate\Support\Str::limit(strip_tags($destination->description ?? ''), 120);
                $price = $formatPrice($destination);
                $hasMap = $validCoordinate($destination->latitude, $destination->longitude);
                $hasWhatsApp = $validPhone($destination->whatsapp);
                $url = '/destinations/' . $slug;
            @endphp

            <article class="group relative flex flex-col bg-white dark:bg-zinc-900 rounded-3xl border border-zinc-100 dark:border-zinc-800 hover:border-[#C6A75E]/40 transition-colors duration-300">
                {{-- Seluruh kartu dapat diklik lewat overlay tunggal (satu aksi, tanpa tag <a> bersarang) --}}
                <a href="{{ $url }}" class="absolute inset-0 z-0 rounded-3xl" aria-label="Lihat detail {{ $name }}"></a>

                <div class="relative z-10 aspect-[4/3] overflow-hidden rounded-t-3xl pointer-events-none">
                    <img src="{{ Storage::url($cover) }}" alt="{{ $name }}"
                         class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.03]"
                         onerror="this.onerror=null; this.src='{{ Storage::url('images/no-image.jpg') }}'">

                    <div class="absolute top-3 right-3 flex items-center gap-1 text-white text-xs font-semibold drop-shadow-[0_1px_3px_rgba(0,0,0,0.6)]">
                        <svg class="w-3.5 h-3.5 text-[#C6A75E]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <span>{{ number_format($rating, 1) }}</span>
                        @if($reviews > 0)
                            <span class="font-normal text-white/70">({{ $reviews }})</span>
                        @endif
                    </div>
                </div>

                <div class="relative z-10 flex flex-col flex-grow p-5 md:p-6 pointer-events-none">
                    <div class="w-10 h-0.5 bg-[#C6A75E] rounded-full"></div>

                    <div class="mt-4 flex items-baseline justify-between gap-3">
                        <span class="text-[11px] font-semibold uppercase tracking-[0.22em] text-zinc-400">Wisata</span>
                        <span class="text-sm font-bold text-[#1F4D3B] dark:text-[#C6A75E] whitespace-nowrap">{{ $price }}</span>
                    </div>

                    <h3 class="mt-2 heading-font text-xl font-bold text-[#1C1C1C] dark:text-white leading-snug line-clamp-2">
                        {{ $name }}
                    </h3>

                    @if($description)
                        <p class="mt-3 text-sm text-zinc-500 dark:text-zinc-400 leading-relaxed line-clamp-2">{{ $description }}</p>
                    @endif

                    @if($address)
                        <p class="mt-4 text-xs text-zinc-400 dark:text-zinc-500 line-clamp-1">{{ $address }}</p>
                    @endif

                    <div class="mt-auto pt-5 flex items-center justify-between gap-4 border-t border-zinc-100 dark:border-zinc-800 pointer-events-auto">
                        <div class="flex items-center gap-3 text-xs font-semibold text-[#1C1C1C] dark:text-white">
                            @if($hasMap)
                                <a href="https://www.google.com/maps/search/?api=1&query={{ $destination->latitude }},{{ $destination->longitude }}"
                                   target="_blank" rel="noopener" class="hover:text-[#C6A75E] transition-colors">Peta</a>
                            @endif
                            @if($hasMap && $hasWhatsApp)
                                <span class="text-zinc-300 dark:text-zinc-700">&#183;</span>
                            @endif
                            @if($hasWhatsApp)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $destination->whatsapp) }}"
                                   target="_blank" rel="noopener" class="hover:text-[#C6A75E] transition-colors">WhatsApp</a>
                            @endif
                            @if(! $hasMap && ! $hasWhatsApp)
                                <span class="text-zinc-400 dark:text-zinc-500 font-normal">Lihat detail</span>
                            @endif
                        </div>

                        <span class="w-8 h-8 flex items-center justify-center rounded-full border border-zinc-200 dark:border-zinc-700 text-[#1C1C1C] dark:text-white group-hover:bg-[#C6A75E] group-hover:border-[#C6A75E] group-hover:text-white transition-colors duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </span>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
@else
    <x-ds.empty-state
        title="Belum Ada Destinasi"
        description="Saat ini tidak ada destinasi yang tersedia untuk ditampilkan."
        icon="magnifying-glass"
    />
@endif
