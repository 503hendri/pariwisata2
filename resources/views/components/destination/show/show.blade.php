<div class="bg-gray-50">

    {{-- HERO SECTION --}}
    <section x-data="{ slide: 0 }" class="relative h-[520px] overflow-hidden">

        {{-- <template x-for="(img,i) in {{ $destination->images?->pluck('url') }}" :key="i">
            <img x-show="slide === i" x-transition :src="img"
                class="absolute inset-0 w-full h-full object-cover">
        </template> --}}
        <img src="{{ asset('storage/' . $destination->cover) }}" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>

        {{-- HERO CONTENT --}}
        <div class="absolute bottom-0 left-0 w-full p-10 text-white">

            <div class="max-w-7xl mx-auto flex justify-between items-end">

                <div>

                    <h1 class="text-5xl font-bold mb-3">
                        {{ $destination->name }}
                    </h1>

                    <div class="flex items-center gap-4 text-white/90">

                        <span class="flex items-center gap-1">
                            ⭐ 4.8
                        </span>

                        <span>
                            {{ $destination->location }}
                        </span>

                    </div>

                </div>

                {{-- Floating Action --}}
                <div x-data="{ shareOpen: false }" class="flex gap-3">

                    <button class="bg-white/20 backdrop-blur-md px-5 py-3 rounded-xl hover:bg-white/30">
                        ❤️ Save
                    </button>

                    <button @click="shareOpen = true"
                        class="bg-white/20 backdrop-blur-md px-5 py-3 rounded-xl hover:bg-white/30 transition">

                        🔗 Share
                    </button>

                    {{-- SHARE MODAL --}}
                    <div x-show="shareOpen" x-transition class="fixed inset-0 z-50 flex items-center justify-center"
                        style="display: none;">

                        {{-- BACKDROP --}}
                        <div @click="shareOpen=false" class="absolute inset-0 bg-black/40 backdrop-blur-sm">
                        </div>

                        {{-- MODAL --}}
                        <div class="relative bg-white w-full max-w-md rounded-2xl shadow-xl p-6">

                            <div class="flex items-center justify-between mb-6">

                                <h3 class="text-lg font-semibold text-gray-900">
                                    Share destinasi
                                </h3>

                                <button @click="shareOpen=false" class="text-gray-400 hover:text-gray-600 text-xl">
                                    ✕
                                </button>

                            </div>


                            {{-- SHARE GRID --}}
                            <div class="grid grid-cols-4 gap-4 text-center">

                                {{-- WHATSAPP --}}
                                <a href="https://wa.me/?text={{ urlencode($destination->name . ' ' . url()->current()) }}"
                                    target="_blank"
                                    class="flex flex-col items-center gap-2 p-3 rounded-xl hover:bg-gray-50">

                                    <div class="w-12 h-12 flex items-center justify-center bg-green-100 rounded-full">
                                        <x-icon name="phone" style="fill: #25D366" class="w-8 h-8" />
                                    </div>

                                    <span class="text-xs text-gray-600">
                                        WhatsApp
                                    </span>

                                </a>


                                {{-- TELEGRAM --}}
                                <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($destination->name) }}"
                                    target="_blank"
                                    class="flex flex-col items-center gap-2 p-3 rounded-xl hover:bg-gray-50">

                                    <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-full">
                                        <x-icon name="envelope" style="fill: #0088cc" class="w-8 h-8" />
                                    </div>

                                    <span class="text-xs text-gray-600">
                                        Telegram
                                    </span>

                                </a>


                                {{-- FACEBOOK --}}
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                    target="_blank"
                                    class="flex flex-col items-center gap-2 p-3 rounded-xl hover:bg-gray-50">

                                    <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-full">
                                        <x-icon name="facebook" fill="#1877f2" class="w-8 h-8" />
                                    </div>

                                    <span class="text-xs text-gray-600">
                                        Facebook
                                    </span>

                                </a>


                                {{-- TWITTER --}}
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($destination->name) }}"
                                    target="_blank"
                                    class="flex flex-col items-center gap-2 p-3 rounded-xl hover:bg-gray-50">

                                    <div
                                        class="w-12 h-12 flex items-center justify-center bg-black text-white rounded-full">
                                        X
                                    </div>

                                    <span class="text-xs text-gray-600">
                                        X
                                    </span>

                                </a>


                                {{-- COPY LINK --}}
                                <button onclick="navigator.clipboard.writeText('{{ url()->current() }}')"
                                    class="flex flex-col items-center gap-2 p-3 rounded-xl hover:bg-gray-50">

                                    <div class="w-12 h-12 flex items-center justify-center bg-gray-100 rounded-full">
                                        🔗
                                    </div>

                                    <span class="text-xs text-gray-600">
                                        Copy Link
                                    </span>

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- MAIN CONTENT --}}
    <div class="max-w-7xl mx-auto px-6 py-12 grid lg:grid-cols-3 gap-10">

        {{-- LEFT --}}
        <div class="lg:col-span-2 space-y-10">


            {{-- DESCRIPTION --}}
            <div class="bg-white rounded-3xl shadow-sm p-10">

                <h2 class="text-2xl font-bold mb-4">
                    Tentang Destinasi
                </h2>

                <p class="text-gray-600 leading-relaxed">
                    {{ $destination->description }}
                </p>

            </div>


            {{-- GALLERY --}}
            <div x-data="airbnbGallery()" x-init="init()" class="bg-white rounded-3xl shadow-sm p-8">

                <h2 class="text-2xl font-bold mb-6">
                    Galeri
                </h2>

                @php
                    $images = $destination->images->pluck('url');
                @endphp

                @if ($images->count())

                    <div class="grid grid-cols-4 grid-rows-2 gap-3 h-[420px]">

                        {{-- HERO IMAGE --}}
                        <div class="col-span-2 row-span-2 cursor-pointer" @click="open(0)">

                            <img src="{{ Storage::url($images[0]) }}"
                                class="w-full h-full object-cover rounded-l-2xl hover:brightness-90 transition">

                        </div>

                        {{-- SMALL IMAGES --}}
                        @foreach ($images->skip(1)->take(4) as $index => $img)
                            <div class="cursor-pointer" @click="open({{ $index + 1 }})">

                                <img src="{{ Storage::url($img) }}"
                                    class="w-full h-full object-cover rounded-r-2xl hover:brightness-90 transition">

                            </div>
                        @endforeach

                    </div>
                @else
                    <div class="flex flex-col items-center justify-center h-64">
                        <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        <p class="text-gray-500 ml-4">Tidak ada gambar tersedia</p>
                    </div>
                @endif


                {{-- FULLSCREEN LIGHTBOX --}}
                <div x-show="show" x-transition x-cloak
                    class="gallery-lightbox fixed inset-0 bg-black/95 flex flex-col items-center justify-center z-50 p-6">

                    {{-- CLOSE --}}
                    <button @click="close()" class="absolute top-6 right-8 text-white text-3xl">
                        ✕
                    </button>


                    {{-- IMAGE VIEWER --}}
                    <div class="relative flex items-center justify-center w-full max-w-6xl">

                        <button @click="prev()" class="absolute left-0 text-white text-4xl px-6">
                            ‹
                        </button>

                        <img :src="images[current]" class="max-h-[80vh] rounded-xl shadow-2xl">

                        <button @click="next()" class="absolute right-0 text-white text-4xl px-6">
                            ›
                        </button>

                    </div>


                    {{-- THUMBNAIL STRIP --}}
                    <div class="flex gap-3 mt-6 overflow-x-auto max-w-5xl px-6">

                        <template x-for="(img,index) in images">

                            <img :src="img" @click="current=index"
                                class="w-24 h-24 object-cover rounded-lg cursor-pointer border-2"
                                :class="current === index ? 'border-white' : 'border-transparent'">

                        </template>

                    </div>

                </div>

            </div>


            {{-- MAP --}}
            <div class="bg-white rounded-3xl shadow-sm p-10">

                <h2 class="text-2xl font-bold mb-6">
                    Lokasi
                </h2>

                <div id="map" class="h-[400px] rounded-xl"></div>

            </div>


            {{-- REVIEWS --}}
            <div class="bg-white rounded-3xl shadow-sm p-10">

                <h2 class="text-2xl font-bold mb-6">
                    Review Pengunjung
                </h2>

                <div class="space-y-6">

                    @forelse ($destination->reviews as $review)
                        <div class="flex gap-4">

                            <div class="w-12 h-12 bg-gray-200 rounded-full"></div>

                            <div>

                                <div class="font-semibold">
                                    {{ $review->name }}
                                </div>

                                <div class="text-yellow-400 text-sm">
                                    @for ($i = 0; $i < $review->rating; $i++)
                                        ⭐
                                    @endfor
                                </div>

                                <p class="text-gray-600 text-sm">
                                    {{ $review->comment }}
                                </p>

                            </div>

                        </div>
                    @empty
                        <div class="text-center text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                            <p>Belum ada review</p>
                        </div>
                    @endforelse

                </div>

            </div>

        </div>


        {{-- SIDEBAR --}}
        <div class="space-y-8">

            {{-- BOOKING / INFO CARD --}}
            <div class="">

                <div class="rounded-3xl overflow-hidden shadow-xl border border-gray-100 bg-white">

                    {{-- glow decoration --}}
                    <div class="absolute -top-20 -right-20 w-60 h-60 bg-indigo-300/30 blur-3xl rounded-full"></div>

                    <div class="p-8 space-y-8">

                        {{-- PRICE HERO --}}
                        <div class="text-center">

                            <div class="text-sm text-sky-400 mb-2">
                                Harga Tiket
                            </div>

                            <div class="text-5xl font-extrabold tracking-tight text-sky-600">

                                @if ($destination->entry_fee)
                                    Rp {{ number_format($destination->entry_fee, 0, ',', '.') }}
                                @elseif($destination->price_range_min && $destination->price_range_max)
                                    Rp {{ number_format($destination->price_range_min, 0, ',', '.') }}
                                @else
                                    Gratis
                                @endif

                            </div>

                            <div class="mt-2">

                                @if ($destination->entry_fee)
                                    <span class="px-4 py-1 text-xs font-semibold rounded-full bg-sky-100 text-sky-600">
                                        Tiket Masuk
                                    </span>
                                @elseif($destination->price_range_min)
                                    <span class="px-4 py-1 text-xs font-semibold rounded-full bg-sky-100 text-sky-600">
                                        Mulai dari
                                    </span>
                                @else
                                    <span
                                        class="px-4 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-600">
                                        Gratis
                                    </span>
                                @endif

                            </div>

                        </div>


                        {{-- CTA --}}
                        <a href="https://www.google.com/maps/search/?api=1&query={{ $destination->latitude }},{{ $destination->longitude }}"
                            target="_blank"
                            class="group flex items-center justify-center gap-3 w-full py-4 rounded-xl
                       text-white font-semibold
                       bg-gradient-to-r from-indigo-600 to-indigo-500
                       hover:from-indigo-700 hover:to-indigo-600
                       transition shadow-lg hover:shadow-xl">

                            <x-icon name="map" class="w-5 h-5 group-hover:scale-110 transition" />

                            Buka di Google Maps

                        </a>


                        {{-- INFO LIST --}}
                        <div class="grid gap-3 text-sm">

                            {{-- CATEGORY --}}
                            <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50">

                                <div class="flex items-center gap-3">

                                    <div class="p-2 bg-indigo-100 text-indigo-600 rounded-lg">
                                        <x-icon name="tag" class="w-4 h-4" />
                                    </div>

                                    <span class="text-gray-500">
                                        Kategori
                                    </span>

                                </div>

                                <span class="font-semibold text-gray-700">
                                    {{ $destination->category?->name ?? '-' }}
                                </span>

                            </div>


                            {{-- HOURS --}}
                            @php

                                $days = [
                                    'Monday' => 'Senin',
                                    'Tuesday' => 'Selasa',
                                    'Wednesday' => 'Rabu',
                                    'Thursday' => 'Kamis',
                                    'Friday' => 'Jumat',
                                    'Saturday' => 'Sabtu',
                                    'Sunday' => 'Minggu',
                                ];

                                $today = $days[now()->format('l')];

                                $hoursRaw = str_replace('\n', "\n", $destination->operating_hours ?? '');
                                $rows = collect(explode("\n", $hoursRaw))->filter();

                                $isOpen = false;

                            @endphp


                            <div class="p-4 rounded-xl bg-gray-50 space-y-4">

                                {{-- HEADER --}}
                                <div class="flex items-center justify-between">

                                    <div class="flex items-center gap-3">

                                        <div class="p-2 bg-indigo-100 text-indigo-600 rounded-lg">
                                            <x-icon name="clock" class="w-4 h-4" />
                                        </div>

                                        <span class="text-gray-600 font-medium">
                                            Jam Buka
                                        </span>

                                    </div>
                                </div>


                                {{-- HOURS LIST --}}
                                <div class="text-sm space-y-1">

                                    @forelse ($rows as $row)
                                        @php
                                            [$day, $time] = array_pad(explode(':', $row, 2), 2, '');
                                            $day = trim($day);
                                            $time = trim($time);

                                            $isToday = $day === $today;
                                        @endphp

                                        <div
                                            class="flex justify-between px-2 py-1 rounded-lg {{ $isToday ? 'bg-white shadow-sm font-semibold' : 'text-gray-600' }}">

                                            <span>
                                                {{ $day }}
                                            </span>

                                            <span>
                                                {{ $time }}
                                            </span>

                                        </div>

                                    @empty

                                        <div class="text-gray-400">
                                            Belum diatur
                                        </div>
                                    @endforelse

                                </div>
                            </div>
                        </div>


                        {{-- FOOTNOTE --}}
                        <div class="text-center text-xs text-gray-400">
                            Informasi dapat berubah sewaktu-waktu
                        </div>

                    </div>

                </div>

            </div>


            {{-- NEARBY DESTINATION --}}
            <div class="bg-white rounded-3xl shadow-sm p-8">

                <h3 class="text-xl font-bold mb-4">
                    Destinasi Terdekat
                </h3>

                <div class="space-y-4">

                    @foreach ($nearby ?? [] as $place)
                        <a href="{{ route('destination.show', $place->slug) }}"
                            class="flex gap-3 items-center hover:bg-gray-50 p-2 rounded-xl">

                            <img src="{{ asset('storage/' . $place->thumbnail) }}" class="w-16 h-16 rounded-lg object-cover">

                            <div>

                                <div class="font-semibold">
                                    {{ $place->name }}
                                </div>

                                <div class="text-xs text-gray-500">
                                    {{ $place->address }}
                                </div>

                            </div>

                        </a>
                    @endforeach

                </div>

            </div>
        </div>

    </div>


    {{-- LEAFLET MAP --}}
    @push('scripts')
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {

                let map = L.map('map').setView([
                    {{ $destination->latitude }},
                    {{ $destination->longitude }}
                ], 13)

                L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                    zoom: 13,
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                    attribution: 'Map data &copy; <a href="https://www.google.com/maps/">Google Maps</a>'
                }).addTo(map)

                L.marker([
                    {{ $destination->latitude }},
                    {{ $destination->longitude }}
                ]).addTo(map)

            })
        </script>

        <script>
            function airbnbGallery() {

                return {

                    show: false,
                    current: 0,

                    images: @json($destination->images->map(function ($image) {
                        return Storage::url($image->url);
                    })->values()),

                    open(index) {
                        this.current = index
                        this.show = true
                        document.body.classList.add('overflow-hidden')
                    },

                    close() {
                        this.show = false
                        document.body.classList.remove('overflow-hidden')
                    },

                    next() {
                        this.current = (this.current + 1) % this.images.length
                    },

                    prev() {
                        this.current = (this.current - 1 + this.images.length) % this.images.length
                    },

                    init() {

                        window.addEventListener('keydown', (e) => {

                            if (!this.show) return

                            if (e.key === 'ArrowRight') this.next()

                            if (e.key === 'ArrowLeft') this.prev()

                            if (e.key === 'Escape') this.close()

                        })

                    }

                }

            }
        </script>
    @endpush
</div>
