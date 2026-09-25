@php
    $validCoordinate = is_numeric($destination->latitude) && is_numeric($destination->longitude)
        && (float) $destination->latitude !== 0.0 && (float) $destination->longitude !== 0.0;

    $entry = $destination->entry_fee !== null ? (float) $destination->entry_fee : null;
    $min = $destination->price_range_min !== null ? (float) $destination->price_range_min : null;
    $max = $destination->price_range_max !== null ? (float) $destination->price_range_max : null;
    $short = fn ($amount) => 'IDR ' . number_format($amount / 1000, 0) . 'k';

    if ($min && $max && $max > $min) {
        $priceLabel = $short($min) . ' - ' . $short($max);
        $priceNote = 'Rentang harga';
    } elseif ($entry || $min) {
        $priceLabel = $short($entry ?: $min);
        $priceNote = 'Harga tiket';
    } elseif ($entry === 0.0) {
        $priceLabel = 'Gratis';
        $priceNote = 'Tiket masuk';
    } else {
        $priceLabel = 'Hubungi Kami';
        $priceNote = 'Informasi harga';
    }

    $hasWhatsApp = is_string($destination->whatsapp) && preg_match('/^\+?[0-9][0-9\s\-()]{7,}$/', trim($destination->whatsapp));
    $hasPhone = is_string($destination->phone) && preg_match('/^\+?[0-9][0-9\s\-()]{7,}$/', trim($destination->phone));
    $hasWebsite = is_string($destination->website) && filter_var(trim($destination->website), FILTER_VALIDATE_URL);

    $images = $destination->images->pluck('url');

    $days = [
        'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu', 'Sunday' => 'Minggu',
    ];
    $today = $days[now()->format('l')];
    $hoursRaw = str_replace('\n', "\n", $destination->operating_hours ?? '');
    $rows = collect(explode("\n", $hoursRaw))->filter();
@endphp

<div class="bg-white dark:bg-zinc-950">

    {{-- HERO --}}
    <section class="relative h-[480px] md:h-[560px] overflow-hidden">
        <img src="{{ Storage::url($destination->cover) }}" alt="{{ $destination->name }}"
             class="absolute inset-0 w-full h-full object-cover"
             onerror="this.onerror=null; this.src='{{ Storage::url('images/no-image.jpg') }}'">
        <div class="absolute inset-0 bg-gradient-to-t from-[#1C1C1C] via-[#1C1C1C]/60 to-[#1C1C1C]/20"></div>

        <div class="absolute bottom-0 left-0 w-full p-6 md:p-10">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col items-start">
                    <span class="uppercase text-[#C6A75E] text-xs font-semibold tracking-[0.3em]">{{ $destination->category?->name ?? 'Destinasi' }}</span>
                    <div class="w-12 h-0.5 bg-[#C6A75E] mt-3"></div>
                </div>

                <h1 class="mt-5 heading-font text-3xl md:text-5xl lg:text-6xl font-bold text-white leading-tight max-w-4xl">
                    {{ $destination->name }}
                </h1>

                <div class="mt-5 flex flex-wrap items-center gap-x-5 gap-y-2 text-white/80 text-sm">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-[#C6A75E]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <span class="font-semibold text-white">{{ number_format((float) $destination->rating, 1) }}</span>
                        @if($destination->review_count > 0)
                            <span>({{ $destination->review_count }} ulasan)</span>
                        @endif
                    </span>
                    @if($destination->address)
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $destination->address }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- SHARE --}}
        <div x-data="{ shareOpen: false }" class="absolute top-6 right-6">
            <button @click="shareOpen = true" type="button" aria-label="Bagikan destinasi ini"
                    class="flex items-center gap-2 bg-white/15 backdrop-blur-md border border-white/20 text-white text-sm font-medium px-4 py-2.5 rounded-full hover:bg-white/25 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.769-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z"/></svg>
                Bagikan
            </button>

            <div x-show="shareOpen" x-transition x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
                <div @click="shareOpen = false" class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

                <div class="relative bg-white dark:bg-zinc-900 w-full max-w-md rounded-3xl shadow-xl p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="heading-font text-lg font-bold text-[#1C1C1C] dark:text-white">Bagikan Destinasi</h3>
                        <button @click="shareOpen = false" type="button" aria-label="Tutup"
                                class="w-8 h-8 flex items-center justify-center rounded-full text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <div class="grid grid-cols-3 gap-2 text-center">
                        <a href="https://wa.me/?text={{ urlencode($destination->name . ' ' . url()->current()) }}" target="_blank" rel="noopener"
                           class="flex flex-col items-center gap-2 p-3 rounded-2xl hover:bg-zinc-50 dark:hover:bg-zinc-800 transition-colors">
                            <span class="w-11 h-11 flex items-center justify-center rounded-full bg-[#1F4D3B] text-white font-semibold text-xs">WA</span>
                            <span class="text-xs text-zinc-600 dark:text-zinc-400">WhatsApp</span>
                        </a>

                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener"
                           class="flex flex-col items-center gap-2 p-3 rounded-2xl hover:bg-zinc-50 dark:hover:bg-zinc-800 transition-colors">
                            <span class="w-11 h-11 flex items-center justify-center rounded-full bg-[#1877F2] text-white font-semibold text-xs">FB</span>
                            <span class="text-xs text-zinc-600 dark:text-zinc-400">Facebook</span>
                        </a>

                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($destination->name) }}" target="_blank" rel="noopener"
                           class="flex flex-col items-center gap-2 p-3 rounded-2xl hover:bg-zinc-50 dark:hover:bg-zinc-800 transition-colors">
                            <span class="w-11 h-11 flex items-center justify-center rounded-full bg-[#1C1C1C] text-white font-semibold text-xs">X</span>
                            <span class="text-xs text-zinc-600 dark:text-zinc-400">X</span>
                        </a>
                    </div>

                    <button type="button"
                            onclick="navigator.clipboard.writeText('{{ url()->current() }}'); this.querySelector('span').textContent='Tersalin!'"
                            class="mt-4 w-full flex items-center justify-center gap-2 py-3 rounded-2xl bg-zinc-100 dark:bg-zinc-800 text-sm font-semibold text-[#1C1C1C] dark:text-white hover:bg-[#C6A75E] hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                        <span>Salin tautan</span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- MAIN CONTENT --}}
    <div class="max-w-7xl mx-auto px-6 py-12 md:py-16 grid lg:grid-cols-3 gap-10 md:gap-12">

        {{-- LEFT --}}
        <div class="lg:col-span-2 space-y-8">

            {{-- DESCRIPTION --}}
            <div>
                <div class="flex flex-col items-start">
                    <span class="uppercase text-[#C6A75E] text-xs font-semibold tracking-[0.3em]">Tentang</span>
                    <div class="w-12 h-0.5 bg-[#C6A75E] mt-3"></div>
                </div>
                <h2 class="mt-4 heading-font text-2xl md:text-3xl font-bold text-[#1C1C1C] dark:text-white">Tentang Destinasi</h2>
                <div class="mt-4 text-zinc-600 dark:text-zinc-400 leading-relaxed space-y-4">
                    {!! $destination->description !!}
                </div>
            </div>

            {{-- GALLERY --}}
            <div x-data="airbnbGallery()" x-init="init()">
                <div class="flex flex-col items-start">
                    <span class="uppercase text-[#C6A75E] text-xs font-semibold tracking-[0.3em]">Galeri</span>
                    <div class="w-12 h-0.5 bg-[#C6A75E] mt-3"></div>
                </div>
                <h2 class="mt-4 heading-font text-2xl md:text-3xl font-bold text-[#1C1C1C] dark:text-white">Galeri Foto</h2>

                @if ($images->count())
                    <div class="mt-6 grid grid-cols-4 grid-rows-2 gap-3 h-[300px] md:h-[420px]">
                        <div class="col-span-4 row-span-2 sm:col-span-2 cursor-pointer" @click="open(0)">
                            <img src="{{ Storage::url($images[0]) }}" loading="lazy"
                                 class="w-full h-full object-cover rounded-2xl hover:brightness-90 transition">
                        </div>

                        @foreach ($images->skip(1)->take(4) as $index => $img)
                            <div class="hidden sm:block cursor-pointer" @click="open({{ $index + 1 }})">
                                <img src="{{ Storage::url($img) }}" loading="lazy"
                                     class="w-full h-full object-cover rounded-2xl hover:brightness-90 transition">
                            </div>
                        @endforeach
                    </div>
                @else
                    <x-ds.empty-state
                        title="Belum Ada Foto"
                        description="Galeri foto untuk destinasi ini belum tersedia."
                        icon="image"
                        class="mt-6"
                    />
                @endif

                {{-- LIGHTBOX --}}
                <div x-show="show" x-transition x-cloak
                     class="fixed inset-0 bg-black/95 flex flex-col items-center justify-center z-50 p-4 md:p-6"
                     @keydown.escape.window="close()">
                    <button @click="close()" type="button" aria-label="Tutup galeri"
                            class="absolute top-5 right-6 w-10 h-10 flex items-center justify-center rounded-full bg-white/10 text-white hover:bg-white/20 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>

                    <div class="relative flex items-center justify-center w-full max-w-6xl">
                        <button @click="prev()" type="button" aria-label="Foto sebelumnya"
                                class="absolute left-0 md:left-4 w-11 h-11 flex items-center justify-center rounded-full bg-white/10 text-white hover:bg-white/20 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        </button>

                        <img :src="images[current]" class="max-h-[80vh] rounded-2xl shadow-2xl" alt="">

                        <button @click="next()" type="button" aria-label="Foto berikutnya"
                                class="absolute right-0 md:right-4 w-11 h-11 flex items-center justify-center rounded-full bg-white/10 text-white hover:bg-white/20 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>

                    <div class="flex gap-3 mt-6 overflow-x-auto max-w-5xl px-6 py-1">
                        <template x-for="(img, index) in images" :key="index">
                            <img :src="img" @click="current = index"
                                 class="w-16 h-16 md:w-20 md:h-20 object-cover rounded-xl cursor-pointer border-2 flex-shrink-0 transition"
                                 :class="current === index ? 'border-[#C6A75E]' : 'border-transparent opacity-60 hover:opacity-100'">
                        </template>
                    </div>
                </div>
            </div>

            {{-- MAP --}}
            @if($validCoordinate)
                <div>
                    <div class="flex flex-col items-start">
                        <span class="uppercase text-[#C6A75E] text-xs font-semibold tracking-[0.3em]">Lokasi</span>
                        <div class="w-12 h-0.5 bg-[#C6A75E] mt-3"></div>
                    </div>
                    <h2 class="mt-4 heading-font text-2xl md:text-3xl font-bold text-[#1C1C1C] dark:text-white">Lokasi</h2>

                    <div class="mt-6 rounded-2xl overflow-hidden border border-zinc-100 dark:border-zinc-800">
                        <iframe
                            src="https://maps.google.com/maps?q={{ $destination->latitude }},{{ $destination->longitude }}&z=15&output=embed"
                            class="w-full h-[360px] md:h-[420px]"
                            style="border:0;"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Peta lokasi {{ $destination->name }}"
                            allowfullscreen></iframe>

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-4 bg-white dark:bg-zinc-900 border-t border-zinc-100 dark:border-zinc-800">
                            <div class="min-w-0">
                                <p class="text-[11px] uppercase tracking-[0.22em] text-zinc-400">Alamat</p>
                                <p class="mt-1 text-sm text-[#1C1C1C] dark:text-white">{{ $destination->address }}</p>
                                <p class="mt-1 text-xs text-zinc-400">{{ $destination->latitude }}, {{ $destination->longitude }}</p>
                            </div>
                            <a href="https://www.google.com/maps/dir/?api=1&destination={{ $destination->latitude }},{{ $destination->longitude }}"
                               target="_blank" rel="noopener"
                               class="flex-shrink-0 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-full bg-[#C6A75E] text-white text-sm font-semibold hover:bg-[#1C1C1C] transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 7m0 13V7"/></svg>
                                Buka Rute
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            {{-- REVIEWS --}}
            <div>
                <div class="flex flex-col items-start">
                    <span class="uppercase text-[#C6A75E] text-xs font-semibold tracking-[0.3em]">Ulasan</span>
                    <div class="w-12 h-0.5 bg-[#C6A75E] mt-3"></div>
                </div>
                <h2 class="mt-4 heading-font text-2xl md:text-3xl font-bold text-[#1C1C1C] dark:text-white">Review Pengunjung</h2>

                <div class="mt-6">
                    @forelse ($destination->reviews as $review)
                        <div class="py-5 border-b border-zinc-100 dark:border-zinc-800 last:border-0">
                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 flex-shrink-0 rounded-full bg-[#1F4D3B] text-white flex items-center justify-center font-semibold">
                                    {{ strtoupper(substr($review->name, 0, 1)) }}
                                </div>
                                <div class="flex-grow min-w-0">
                                    <div class="flex flex-wrap items-center justify-between gap-2">
                                        <span class="font-semibold text-[#1C1C1C] dark:text-white">{{ $review->name }}</span>
                                        <span class="flex items-center gap-1 text-xs text-zinc-500">
                                            <svg class="w-3.5 h-3.5 text-[#C6A75E]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                            {{ $review->rating }}/5
                                        </span>
                                    </div>
                                    <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400 leading-relaxed">{{ $review->comment }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <x-ds.empty-state
                            title="Belum Ada Review"
                            description="Jadilah yang pertama membagikan pengalaman Anda di destinasi ini."
                            icon="chat"
                        />
                    @endforelse
                </div>
            </div>

        </div>

        {{-- SIDEBAR --}}
        <div class="space-y-6">
            <div class="lg:sticky lg:top-24 bg-white dark:bg-zinc-900 rounded-3xl border border-zinc-100 dark:border-zinc-800 p-6 md:p-8">
                <div class="text-center pb-6 border-b border-zinc-100 dark:border-zinc-800">
                    <span class="text-[11px] uppercase tracking-[0.22em] text-zinc-400">{{ $priceNote }}</span>
                    <div class="mt-2 heading-font text-3xl md:text-4xl font-bold text-[#1F4D3B] dark:text-[#C6A75E]">{{ $priceLabel }}</div>
                </div>

                {{-- CTA --}}
                <div class="mt-6 space-y-3">
                    @if($validCoordinate)
                        <a href="https://www.google.com/maps/search/?api=1&query={{ $destination->latitude }},{{ $destination->longitude }}"
                           target="_blank" rel="noopener"
                           class="flex items-center justify-center gap-2 w-full py-3.5 rounded-full bg-[#C6A75E] text-white font-semibold hover:bg-[#1C1C1C] transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Buka di Google Maps
                        </a>
                    @endif

                    @if($hasWhatsApp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $destination->whatsapp) }}"
                           target="_blank" rel="noopener"
                           class="flex items-center justify-center gap-2 w-full py-3.5 rounded-full bg-[#1F4D3B] text-white font-semibold hover:bg-[#173d2f] transition-colors">
                            Hubungi via WhatsApp
                        </a>
                    @endif

                    @if($hasPhone)
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $destination->phone) }}"
                           class="flex items-center justify-center gap-2 w-full py-3.5 rounded-full border border-zinc-200 dark:border-zinc-700 text-[#1C1C1C] dark:text-white font-semibold hover:border-[#C6A75E] transition-colors">
                            Telepon
                        </a>
                    @endif

                    @if($hasWebsite)
                        <a href="{{ $destination->website }}" target="_blank" rel="noopener"
                           class="flex items-center justify-center gap-2 w-full py-3.5 rounded-full border border-zinc-200 dark:border-zinc-700 text-[#1C1C1C] dark:text-white font-semibold hover:border-[#C6A75E] transition-colors">
                            Kunjungi Website
                        </a>
                    @endif
                </div>

                {{-- INFO --}}
                <div class="mt-6 pt-6 border-t border-zinc-100 dark:border-zinc-800 space-y-4 text-sm">
                    <div class="flex items-start justify-between gap-4">
                        <span class="text-zinc-500 dark:text-zinc-400">Kategori</span>
                        <span class="font-semibold text-[#1C1C1C] dark:text-white text-right">{{ $destination->category?->name ?? '-' }}</span>
                    </div>

                    @if($destination->address)
                        <div class="flex items-start justify-between gap-4">
                            <span class="text-zinc-500 dark:text-zinc-400 flex-shrink-0">Alamat</span>
                            <span class="font-medium text-[#1C1C1C] dark:text-white text-right">{{ $destination->address }}</span>
                        </div>
                    @endif
                </div>

                {{-- HOURS --}}
                <div class="mt-6 pt-6 border-t border-zinc-100 dark:border-zinc-800">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[11px] uppercase tracking-[0.22em] text-zinc-400">Jam Buka</span>
                    </div>
                    <div class="space-y-1 text-sm">
                        @forelse ($rows as $row)
                            @php
                                [$day, $time] = array_pad(explode(':', $row, 2), 2, '');
                                $day = trim($day);
                                $time = trim($time);
                                $isToday = $day === $today;
                            @endphp
                            <div class="flex justify-between gap-3 px-3 py-2 rounded-lg {{ $isToday ? 'bg-[#F8F6F1] dark:bg-zinc-800 font-semibold text-[#1C1C1C] dark:text-white' : 'text-zinc-500 dark:text-zinc-400' }}">
                                <span>{{ $day }}</span>
                                <span>{{ $time }}</span>
                            </div>
                        @empty
                            <p class="text-zinc-400 text-sm">Belum diatur</p>
                        @endforelse
                    </div>
                </div>

                <p class="mt-6 text-center text-xs text-zinc-400">Informasi dapat berubah sewaktu-waktu</p>
            </div>

            {{-- NEARBY --}}
            @if(($nearby ?? collect())->count())
                <div class="bg-white dark:bg-zinc-900 rounded-3xl border border-zinc-100 dark:border-zinc-800 p-6">
                    <div class="flex flex-col items-start mb-4">
                        <span class="uppercase text-[#C6A75E] text-xs font-semibold tracking-[0.3em]">Sekitar</span>
                        <div class="w-12 h-0.5 bg-[#C6A75E] mt-3"></div>
                    </div>
                    <h3 class="heading-font text-lg font-bold text-[#1C1C1C] dark:text-white mb-4">Destinasi Lainnya</h3>

                    <div class="space-y-2">
                        @foreach ($nearby as $place)
                            <a href="{{ route('destination.show', $place->slug) }}"
                               class="group flex gap-3 items-center p-2 rounded-2xl hover:bg-zinc-50 dark:hover:bg-zinc-800 transition-colors">
                                <img src="{{ Storage::url($place->cover) }}" loading="lazy" alt="{{ $place->name }}"
                                     class="w-14 h-14 rounded-xl object-cover flex-shrink-0"
                                     onerror="this.onerror=null; this.src='{{ Storage::url('images/no-image.jpg') }}'">
                                <div class="min-w-0">
                                    <div class="font-semibold text-sm text-[#1C1C1C] dark:text-white line-clamp-1 group-hover:text-[#C6A75E] transition-colors">{{ $place->name }}</div>
                                    <div class="text-xs text-zinc-400 line-clamp-1">{{ $place->address }}</div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

    </div>
</div>

@push('scripts')
    <script>
        function airbnbGallery() {
            return {
                show: false,
                current: 0,
                images: @json($images->map(fn ($image) => Storage::url($image))->values()),

                open(index) {
                    this.current = index;
                    this.show = true;
                    document.body.classList.add('overflow-hidden');
                },

                close() {
                    this.show = false;
                    document.body.classList.remove('overflow-hidden');
                },

                next() {
                    if (! this.images.length) return;
                    this.current = (this.current + 1) % this.images.length;
                },

                prev() {
                    if (! this.images.length) return;
                    this.current = (this.current - 1 + this.images.length) % this.images.length;
                },

                init() {
                    window.addEventListener('keydown', (e) => {
                        if (! this.show) return;
                        if (e.key === 'ArrowRight') this.next();
                        if (e.key === 'ArrowLeft') this.prev();
                        if (e.key === 'Escape') this.close();
                    });
                }
            };
        }
    </script>
@endpush
