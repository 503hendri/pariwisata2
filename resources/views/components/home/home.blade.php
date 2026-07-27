<div>
    <!-- HERO SECTION -->
    {{-- <section id="hero" class="hero-bg h-screen w-full flex items-center relative"
        style="background-image: 
        linear-gradient(to bottom, rgba(28, 28, 28, 0.25), rgba(28, 28, 28, 0.55)),
        url('{{ Storage::disk('public')->url($websiteProfile->cover) }}');">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-[#1C1C1C]/90"></div>

        <div class="max-w-7xl mx-auto px-6 pt-20 relative z-10">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 bg-white/90 px-5 py-2 rounded-3xl text-sm mb-6">
                    <span class="w-3 h-3 bg-[#C6A75E] rounded-full animate-pulse"></span>
                    UNESCO World Heritage 2019
                </div>

                <h1 class="heading-font text-2xl md:text-4xl lg:text-5xl leading-none font-bold text-white tracking-tighter mb-6"
                    data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
                    {{ $websiteProfile->tagline }}
                </h1>

                <p class="text-white/90 text-lg md:text-xl lg:text-2xl max-w-md mb-10" data-aos="fade-left"
                    data-aos-duration="1000" data-aos-delay="700">
                    {{ $websiteProfile->description }}
                </p>

                <div class="flex flex-wrap gap-4">
                    <a href="#destinations"
                        onclick="document.getElementById('destinations').scrollIntoView({ behavior: 'smooth' })"
                        class="px-6 py-3 md:px-10 md:py-5 bg-[#C6A75E] hover:bg-white text-[#1C1C1C] font-semibold text-sm md:text-lg rounded-3xl transition-all hover:scale-105">
                        Jelajahi Destinasi
                    </a>
                    <a href="#plan"
                        class="px-6 py-3 md:px-10 md:py-5 border-2 border-white text-white hover:bg-white hover:text-[#1C1C1C] font-semibold text-sm md:text-lg rounded-3xl transition-all">
                        Rencanakan Perjalanan
                    </a>
                </div>

                <div class="grid grid-cols-3 gap-8 mt-20">
                    <div>
                        <div id="stat1" class="stat-number text-5xl font-semibold text-white">20+</div>
                        <div class="text-white/70 text-sm tracking-widest">DESTINASI</div>
                    </div>
                    <div>
                        <div id="stat2" class="stat-number text-5xl font-semibold text-white">100+</div>
                        <div class="text-white/70 text-sm tracking-widest">SITUS BERSEJARAH</div>
                    </div>
                    <div>
                        <div id="stat3" class="stat-number text-5xl font-semibold text-white">15K+</div>
                        <div class="text-white/70 text-sm tracking-widest">PENGUNJUNG/TAHUN</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="hidden md:block">
            <div
                class="absolute bottom-14 right-14 z-40
            bg-gradient-to-b from-[#111]/90 to-[#000]/80 backdrop-blur-lg
            w-64 h-20 rounded-full border border-[#C6A75E]/30
            shadow-2xl shadow-[#C6A75E]/10 hover:shadow-[#C6A75E]/40 transition-all duration-600
            flex items-center justify-center gap-5 px-8">

                <img src="{{ Storage::url('images/unesco.png') }}" alt="UNESCO"
                    class="h-11 w-11 object-contain rounded-full ring-1 ring-[#C6A75E]/40 ring-offset-2 ring-offset-black/50">

                <div class="text-white/95 text-sm font-medium leading-tight text-left">
                    <div class="font-semibold">Ombilin Coal Mining Heritage</div>
                    <div class="text-[#C6A75E]/90 text-xs uppercase tracking-widest mt-1">
                        UNESCO World Heritage
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <section id="hero" wire:poll.6500ms="nextSlide"
        class="relative h-screen flex items-center justify-center text-center overflow-hidden bg-[#111]">
        <div
            class="absolute left-[-5%] top-16 w-72 h-72 rounded-full bg-[#C6A75E]/20 blur-3xl animate-float-slow opacity-70">
        </div>
        <div class="absolute right-0 top-1/3 w-96 h-96 rounded-full bg-white/10 blur-3xl animate-pulse opacity-60"></div>

        <div class="absolute inset-0 z-0">
            @foreach ($this->coverSlides as $index => $slide)
                <div wire:key="hero-slide-{{ $index }}"
                    class="hero-slide absolute inset-0 transition-all duration-1000 ease-in-out {{ $this->currentSlide === $index ? 'opacity-100 scale-100 z-0' : 'opacity-0 scale-105 z-[-1]' }}">
                    <img src="{{ $slide }}" alt="Slide Background"
                        class="absolute inset-0 w-full h-full object-cover object-center" />
                    <div class="absolute inset-0 bg-black/30"></div>
                </div>
            @endforeach

            @if (count($this->coverSlides) === 0)
                <div class="absolute inset-0 bg-[#111]"></div>
            @endif
        </div>

        <div class="absolute inset-0 bg-gradient-to-br from-transparent via-transparent to-[#1C1C1C]/90 z-10"></div>

        <div class="container mx-auto px-4 relative z-20">
            <div
                class="mx-auto max-w-6xl rounded-[2rem] border border-white/10 bg-black/50 p-10 shadow-2xl backdrop-blur-xl opacity-90">
                <div
                    class="mb-6 inline-flex items-center rounded-full bg-[#C6A75E]/15 px-4 py-2 text-sm font-semibold text-[#C6A75E] shadow-sm animate-pulse">
                    <span class="block h-2.5 w-2.5 rounded-full bg-[#C6A75E] mr-3"></span>
                    Eksplorasi tempat terbaik di Sawahlunto
                </div>

                <h1
                    class="text-4xl md:text-6xl font-bold text-white leading-tight tracking-tight opacity-0 animate-fade-in-up">
                    {{ $this->profile?->tagline ?? 'Selamat Datang di Sawahlunto Tourism' }}
                </h1>

                <p class="text-base md:text-xl text-gray-200 mt-6 mb-10 opacity-0 animate-fade-in-up delay-200">
                    {{ $this->profile?->description ?? 'Temukan keindahan dan budaya Indonesia, mulai dari destinasi alam hingga kuliner lokal yang memikat.' }}
                </p>

                <div class="flex flex-col items-center justify-center gap-4 sm:flex-row sm:justify-center">
                    <a href="{{ route('home') }}" wire:navigate
                        class="inline-flex items-center justify-center rounded-full bg-[#C6A75E] px-8 py-3 text-lg font-semibold text-white shadow-xl transition duration-300 hover:bg-[#bfa662] opacity-0 animate-fade-in-up delay-300">
                        Jelajahi Sekarang
                    </a>
                </div>

                @if (count($this->coverSlides) > 1)
                    <div class="mt-10 flex flex-col items-center justify-center gap-3">
                        <div class="flex items-center gap-2">
                            <button type="button" wire:click="prevSlide"
                                class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white shadow-lg transition hover:bg-white/20">
                                ‹
                            </button>

                            <div class="flex items-center gap-2">
                                @foreach ($this->coverSlides as $index => $slide)
                                    <button type="button" wire:click="goToSlide({{ $index }})"
                                        class="h-2.5 w-2.5 rounded-full transition-colors duration-300 {{ $this->currentSlide === $index ? 'bg-[#C6A75E]' : 'bg-white/50 hover:bg-white' }}"></button>
                                @endforeach
                            </div>

                            <button type="button" wire:click="nextSlide"
                                class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white shadow-lg transition hover:bg-white/20">
                                ›
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- FEATURED DESTINATIONS -->
    <section wire:ignore id="destinations" class="py-16 md:py-20 w-full bg-gradient-to-b from-white to-[#F8F6F1]/50"
        data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-4">
                <div>
                    <span class="uppercase text-[#C6A75E] text-sm font-semibold tracking-[0.3em] block mb-2">Destinasi
                        Unggulan</span>
                    <h2 class="heading-font text-3xl md:text-5xl font-bold text-[#1C1C1C]">
                        Temukan Keajaiban Sawahlunto
                    </h2>
                </div>
                <a href="{{ route('destination.index') }}"
                    class="text-[#C6A75E] hover:text-[#1C1C1C] flex items-center gap-2 text-sm md:text-base font-medium transition-colors group">
                    Lihat Semua
                    <span class="text-xl group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>

            <!-- Swiper Container -->
            <div class="relative overflow-hidden">
                {{-- @endphp --}}
                @include('components.cards.destination', ['destinations' => $this->destinations])
            </div>
        </div>
    </section>

    <!-- NEWS -->
    <section wire:ignore id="news" class="py-16 md:py-20 w-full bg-gradient-to-b from-white to-[#F8F6F1]/50" data-aos="fade-up"
        data-aos-duration="1000" data-aos-delay="500">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10">
                <div>
                    <span
                        class="uppercase text-[#C6A75E] text-sm font-semibold tracking-[0.3em] block mb-2">Berita</span>
                    <h2 class="heading-font text-3xl md:text-5xl font-bold text-[#1C1C1C]">
                        Berita Terkini
                    </h2>
                </div>
                <a href="{{ route('news.index') }}" wire:navigate
                    class="text-[#C6A75E] hover:text-[#1C1C1C] flex items-center gap-2 text-sm md:text-base font-medium transition-colors group mt-4 md:mt-0">
                    Lihat Semua
                    <span class="text-xl group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>

            <!-- News Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($this->news as $newsItem)
                <article
                    class="group relative bg-[#FBFBFA] rounded-2xl p-4 transition-all duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)] hover:bg-white hover:shadow-[0_30px_100px_rgba(0,0,0,0.08)] flex flex-col border border-gray-200/60 hover:border-transparent">

                    <!-- Image Wrapper dengan Asymmetric Corner & Pop-out Effect -->
                    <div class="relative h-60 w-full overflow-hidden rounded-xl bg-gray-100">
                        @if($newsItem->image)
                        <img src="{{ Storage::url($newsItem->image) }}" alt="{{ $newsItem->title }}"
                            class="w-full h-full object-cover grayscale-[30%] contrast-[1.1] group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700 ease-out">
                        @else
                        <div class="w-full h-full flex flex-col items-center justify-center gap-2 rounded-xl bg-gradient-to-br from-slate-200 via-slate-300 to-slate-100 dark:from-slate-800 dark:via-slate-900 dark:to-slate-800 text-gray-400 dark:text-gray-300 shadow-inner">
                            <flux:icon name="image-off" class="w-8 h-8" />
                            <span class="text-sm">No Image Available</span>
                        </div>
                        @endif

                        <!-- Badge Kategori / Tanggal yang Kontras & Clean -->
                        <div class="absolute top-3 left-3 bg-[#1C1C1C] text-white px-3 py-1 rounded-lg shadow-sm">
                            <span class="text-[10px] font-black uppercase tracking-widest block">
                                {{ $newsItem->created_at->format('d . M . y') }}
                            </span>
                        </div>
                    </div>

                    <!-- Content Area -->
                    <div class="pt-6 px-2 flex flex-col flex-grow">

                        <!-- Tagline Kecil / Sub-info -->
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#C6A75E] animate-pulse"></span>
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Latest
                                Update</span>
                        </div>

                        <!-- Judul Bold & Punches (No boring links, full title interaction) -->
                        <h3
                            class="heading-font text-xl font-black text-[#1C1C1C] line-clamp-2 group-hover:text-[#C6A75E] transition-colors duration-300 tracking-tight leading-snug mb-3">
                            {{ $newsItem->title }}
                        </h3>

                        <!-- Deskripsi dengan Spacing Lega -->
                        <p class="text-gray-500 text-sm line-clamp-2 leading-relaxed mb-6 font-medium">
                            {{ strip_tags($newsItem->content) }}
                        </p>

                        <!-- Bottom Action: Gak pakai panah jadul, pakai pill-button yang melayang -->
                        <div class="mt-auto pt-4 border-t border-gray-100/80 flex items-center justify-between">
                            <span
                                class="text-xs font-black uppercase tracking-wider text-gray-400 group-hover:text-[#1C1C1C] transition-colors">
                                {{ $newsItem->created_at->diffForHumans() }}
                            </span>

                            <a href="{{ route('news.show', $newsItem->slug) }}" wire:navigate
                                class="px-4 py-2 bg-[#C6A75E] text-white text-xs font-semibold rounded-full hover:bg-[#1C1C1C] transition-colors">
                                Selengkapnya..
                            </a>
                        </div>
                    </div>
                </article>
                @empty
                <div class="col-span-full text-center py-16">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-[#F8F6F1] rounded-full mb-6">
                        <svg class="w-10 h-10 text-[#C6A75E]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <h3 class="heading-font text-2xl font-bold text-[#1C1C1C] mb-2">Belum Ada Berita</h3>
                    <p class="text-gray-500">Berita terkini akan segera tersedia untuk Anda.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- WHY VISIT -->
    <section wire:ignore id="why" class="py-24 bg-[#1C1C1C] text-white" data-aos="fade-up" data-aos-duration="1000"
        data-aos-delay="500">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div>
                    <span class="text-[#C6A75E] uppercase tracking-widest text-sm">Mengapa Harus ke Sawahlunto?</span>
                    <h2 class="heading-font text-5xl font-bold mt-4 leading-tight">Kota Tambang yang Kini Menjadi
                        Destinasi Warisan Dunia</h2>
                    <p class="mt-8 text-gray-300 max-w-md">
                        Dari terowongan gelap era kolonial hingga danau biru yang memukau, Sawahlunto menawarkan
                        pengalaman tak terlupakan yang menggabungkan sejarah, alam, dan budaya Minangkabau.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div
                        class="group relative bg-gradient-to-br from-white/10 to-transparent backdrop-blur-md rounded-[2rem] p-8 border border-white/10 hover:border-[#C6A75E]/50 transition-all duration-500 overflow-hidden">
                        <div
                            class="absolute top-0 right-0 p-4 opacity-5 text-8xl font-bold text-white group-hover:opacity-10 transition-opacity">
                            01</div>
                        <div
                            class="w-12 h-12 mb-8 flex items-center justify-center rounded-xl bg-[#C6A75E]/20 text-[#C6A75E]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-white text-xl tracking-tight uppercase">Kota Warisan <span
                                class="text-[#C6A75E]">UNESCO</span></h4>
                        <p class="text-gray-400 mt-4 text-sm leading-relaxed font-light">
                            Diakui UNESCO sejak 2019 sebagai bukti otentik pertukaran budaya Timur dan Barat di jantung
                            Sumatera.
                        </p>
                    </div>

                    <div
                        class="group relative bg-gradient-to-br from-white/10 to-transparent backdrop-blur-md rounded-[2rem] p-8 border border-white/10 hover:border-[#C6A75E]/50 transition-all duration-500 overflow-hidden">
                        <div
                            class="absolute top-0 right-0 p-4 opacity-5 text-8xl font-bold text-white group-hover:opacity-10 transition-opacity">
                            02</div>
                        <div
                            class="w-12 h-12 mb-8 flex items-center justify-center rounded-xl bg-[#C6A75E]/20 text-[#C6A75E]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-white text-xl tracking-tight uppercase">Jejak <span
                                class="text-[#C6A75E]">Tambang</span></h4>
                        <p class="text-gray-400 mt-4 text-sm leading-relaxed font-light">
                            Telusuri lorong waktu dan rasakan langsung denyut kehidupan para pekerja tambang era
                            kolonial.
                        </p>
                    </div>

                    <div
                        class="group relative bg-gradient-to-br from-white/10 to-transparent backdrop-blur-md rounded-[2rem] p-8 border border-white/10 hover:border-[#C6A75E]/50 transition-all duration-500 overflow-hidden">
                        <div
                            class="absolute top-0 right-0 p-4 opacity-5 text-8xl font-bold text-white group-hover:opacity-10 transition-opacity">
                            03</div>
                        <div
                            class="w-12 h-12 mb-8 flex items-center justify-center rounded-xl bg-[#C6A75E]/20 text-[#C6A75E]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-white text-xl tracking-tight uppercase">Bentang <span
                                class="text-[#C6A75E]">Alam</span></h4>
                        <p class="text-gray-400 mt-4 text-sm leading-relaxed font-light">
                            Harmoni antara danau biru pasca-tambang, bukit hijau, dan kabut tropis yang menyelimuti
                            kota.
                        </p>
                    </div>

                    <div
                        class="group relative bg-gradient-to-br from-white/10 to-transparent backdrop-blur-md rounded-[2rem] p-8 border border-white/10 hover:border-[#C6A75E]/50 transition-all duration-500 overflow-hidden">
                        <div
                            class="absolute top-0 right-0 p-4 opacity-5 text-8xl font-bold text-white group-hover:opacity-10 transition-opacity">
                            04</div>
                        <div
                            class="w-12 h-12 mb-8 flex items-center justify-center rounded-xl bg-[#C6A75E]/20 text-[#C6A75E]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-white text-xl tracking-tight uppercase">Denyut <span
                                class="text-[#C6A75E]">Budaya</span></h4>
                        <p class="text-gray-400 mt-4 text-sm leading-relaxed font-light">
                            Kemeriahan tahunan SIMFes dan Songket Carnival yang menghidupkan tradisi di ruang-ruang
                            publik.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- EVENTS -->
    <section wire:ignore id="events" class="py-24 bg-white" data-aos="fade-up" data-aos-duration="1000"
        data-aos-delay="500">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center mb-12">
                <h2 class="heading-font text-5xl font-bold">Event &amp; Festival</h2>
                {{-- <a href="#" class="flex items-center gap-2 text-[#C6A75E]">Lihat Kalender Lengkap →</a> --}}
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Event Card -->
                @forelse($this->events as $event)
                <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden">
                    <div class="h-64 bg-gray-200">
                        <img src="{{ Storage::url($event->cover, 'events') }}" alt="{{ $event->name }}"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="p-8">
                        <div class="text-[#C6A75E] text-xs font-medium">{{ $event->date_start }} -
                            {{ $event->date_end }}
                        </div>
                        <h4 class="heading-font text-2xl mt-2">{{ $event->name }}</h4>
                        <p class="text-sm text-gray-600 mt-4">{{ $event->description }}</p>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <p class="text-gray-500">Tidak ada event yang tersedia saat ini.</p>
                </div>
                @endforelse

            </div>
        </div>
    </section>

    <!-- CULINARY -->
    <section wire:ignore id="culinary" class="py-24 bg-[#1F4D3B] text-white" data-aos="fade-up" data-aos-duration="1000"
        data-aos-delay="500">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12">
                <span class="uppercase text-[#C6A75E]">Rasa Sawahlunto</span>
                <h2 class="heading-font text-5xl font-bold mt-3">Kuliner Warisan Minang</h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach ($this->culinaries as $culinary)
                <div class="group relative rounded-3xl overflow-hidden h-80"
                    wire:key="culinary-{{ $culinary->id }}" wire:lazy>
                    <img src="{{ asset('storage/' . $culinary->image) }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform"
                        alt="{{ $culinary->name }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <div class="text-[#C6A75E] text-xs">{{ $culinary->category }}</div>
                        <div class="text-3xl heading-font">{{ $culinary->name }}</div>
                    </div>
                </div>
                @endforeach
                {{-- <div class="group relative rounded-3xl overflow-hidden h-80">
                    <img src="https://picsum.photos/id/431/600/800"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform" alt="Sate">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <div class="text-[#C6A75E] text-xs">Street Food</div>
                        <div class="text-3xl heading-font">Sate Padang</div>
                    </div>
                </div>
                <div class="group relative rounded-3xl overflow-hidden h-80">
                    <img src="https://picsum.photos/id/669/600/800"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform" alt="Gulai">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <div class="text-[#C6A75E] text-xs">Traditional</div>
                        <div class="text-3xl heading-font">Gulai Ikan</div>
                    </div>
                </div> --}}
                <div
                    class="group relative rounded-3xl overflow-hidden h-80 bg-[#C6A75E] flex items-center justify-center text-center p-10">
                    <div>
                        <div class="text-4xl">🍽️</div>
                        <div class="mt-6 text-[#1C1C1C] font-medium">Temukan lebih banyak rasa lokal di pasar dan
                            warung tradisional</div>
                        <a href="{{ route('culinary.index') }}" wire:navigate
                            class="mt-8 inline-block px-8 py-4 bg-white rounded-3xl text-sm font-semibold text-[#1C1C1C]">Cari
                            Kuliner →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section wire:ignore id="accommodation" class="py-28 bg-gray-50" data-aos="fade-up" data-aos-duration="1000">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center mb-12">
                <h2 class="heading-font text-5xl font-bold">Penginapan</h2>
                <a href="{{ route('acomodation.index') }}" class="flex items-center gap-2 text-[#C6A75E]"
                    wire:navigate>
                    Lihat Semua
                    →</a>
            </div>

            <livewire:cards.accomodations lazy />
        </div>
    </section>

    <!-- PLAN YOUR TRIP -->
    <section wire:ignore id="plan"
        class="py-28 bg-gradient-to-br from-slate-50 via-white to-orange-50/30 relative overflow-hidden">

        <!-- Background Decorations -->
        <div
            class="absolute top-0 left-0 w-96 h-96 bg-[#1F4D3B]/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2">
        </div>
        <div
            class="absolute bottom-0 right-0 w-96 h-96 bg-orange-500/5 rounded-full blur-3xl translate-x-1/2 translate-y-1/2">
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">

            {{-- SECTION TITLE --}}
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div
                    class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-sm px-4 py-2 rounded-full shadow-sm border border-gray-200/50 mb-6">
                    <svg class="w-4 h-4 text-[#1F4D3B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 7m0 13V7" />
                    </svg>
                    <span class="text-sm font-medium text-gray-600">Perencanaan Perjalanan</span>
                </div>

                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight">
                    Rencanakan Perjalanan <span class="text-[#1F4D3B]">Anda</span>
                </h2>

                <p class="mt-4 text-gray-500 text-lg max-w-2xl mx-auto">
                    Persiapkan perjalanan terbaik Anda menuju kota warisan dunia Sawahlunto dengan informasi lengkap.
                </p>
            </div>


            <div class="grid lg:grid-cols-2 gap-12 items-start">

                {{-- TRAVEL INFO --}}
                <div class="space-y-6">

                    {{-- Section Header --}}
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 bg-[#1F4D3B] rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Informasi Perjalanan</h3>
                    </div>

                    {{-- HOW TO GET THERE --}}
                    <div
                        class="group flex gap-5 p-6 bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:border-[#1F4D3B]/20 transition-all duration-300 transform hover:-translate-y-1">
                        <div
                            class="w-14 h-14 bg-gradient-to-br from-[#1F4D3B] to-[#2d6b52] text-white rounded-2xl flex items-center justify-center text-2xl shadow-lg shadow-[#1F4D3B]/20 flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
                            ✈️
                        </div>

                        <div>
                            <h4 class="font-bold text-gray-900 flex items-center gap-2">
                                Cara Menuju Sawahlunto
                                <svg class="w-4 h-4 text-[#1F4D3B]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </h4>

                            <p class="text-gray-600 mt-3 leading-relaxed text-sm">
                                Terbang ke <strong class="text-[#1F4D3B]">Bandara Internasional Minangkabau</strong>
                                (Padang) kemudian
                                lanjutkan perjalanan darat sekitar <span
                                    class="bg-orange-100 text-orange-700 px-2 py-0.5 rounded font-semibold">2
                                    jam</span>
                                melalui jalur Padang – Solok – Sawahlunto.
                            </p>

                            <div class="mt-4 flex items-center gap-4 text-xs text-gray-500">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Estimasi 2 jam perjalanan
                                </span>
                            </div>
                        </div>
                    </div>


                    {{-- LOCAL TRANSPORT --}}
                    <div
                        class="group flex gap-5 p-6 bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:border-[#1F4D3B]/20 transition-all duration-300 transform hover:-translate-y-1">
                        <div
                            class="w-14 h-14 bg-gradient-to-br from-orange-500 to-orange-600 text-white rounded-2xl flex items-center justify-center text-2xl shadow-lg shadow-orange-500/20 flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
                            🚗
                        </div>

                        <div>
                            <h4 class="font-bold text-gray-900 flex items-center gap-2">
                                Transportasi Lokal
                                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </h4>

                            <p class="text-gray-600 mt-3 leading-relaxed text-sm">
                                Wisatawan dapat menggunakan <strong>angkot, ojek online</strong>, atau
                                menyewa kendaraan. Shuttle wisata tersedia di beberapa
                                lokasi utama seperti museum dan pusat kota.
                            </p>

                            <div class="mt-4 flex flex-wrap gap-2">
                                <span
                                    class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">Angkot</span>
                                <span
                                    class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">Ojek
                                    Online</span>
                                <span
                                    class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-medium">Shuttle</span>
                            </div>
                        </div>
                    </div>

                    {{-- Additional Tips Card --}}
                    <div
                        class="p-5 bg-gradient-to-r from-[#1F4D3B]/5 to-transparent rounded-2xl border border-[#1F4D3B]/10">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-[#1F4D3B] mt-0.5 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h5 class="font-semibold text-gray-900 text-sm">Tips Perjalanan</h5>
                                <p class="text-gray-600 text-xs mt-1 leading-relaxed">
                                    Bawa pakaian hangat karena suhu di Sawahlunto bisa mencapai 15-25°C. Jangan lupa
                                    membawa kamera untuk mengabadikan momen berharga!
                                </p>
                            </div>
                        </div>
                    </div>

                </div>


                {{-- WEATHER CARD --}}
                <div
                    class="relative overflow-hidden bg-gradient-to-br from-[#1F4D3B] to-[#2d6b52] rounded-3xl shadow-2xl p-8 text-white">

                    {{-- Decorative Elements --}}
                    <div
                        class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-48 h-48 bg-orange-500/20 rounded-full blur-2xl translate-y-1/2 -translate-x-1/2">
                    </div>

                    {{-- Animated Circles --}}
                    <div class="absolute top-10 right-10 w-2 h-2 bg-orange-400 rounded-full animate-pulse"></div>
                    <div class="absolute top-16 right-20 w-1.5 h-1.5 bg-white/50 rounded-full animate-pulse delay-300">
                    </div>

                    {{-- HEADER --}}
                    <div class="flex items-center justify-between mb-8 relative z-10">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center text-3xl shadow-inner">
                                {{ $weatherIcon }}
                            </div>
                            <div>
                                <h4 class="font-bold text-white text-lg">
                                    Cuaca Saat Ini
                                </h4>
                                <span class="text-xs text-white/70">
                                    Sawahlunto, Sumatera Barat
                                </span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-xs text-white/60">Update</div>
                            <div class="text-sm font-medium">{{ now()->format('H:i') }} WIB</div>
                        </div>
                    </div>


                    {{-- TEMPERATURE --}}
                    <div class="flex items-center justify-between mb-8 relative z-10">
                        <div>
                            <div class="text-7xl font-bold text-white leading-none tracking-tight">
                                {{ $weather['temperature'] }}°
                            </div>
                            <div class="text-white/80 mt-2 text-lg">
                                {{ $weatherCondition }}
                            </div>
                        </div>
                        <div class="text-7xl opacity-90 drop-shadow-lg">
                            {{ $weatherIcon }}
                        </div>
                    </div>


                    {{-- WEATHER DETAILS --}}
                    <div class="grid grid-cols-2 gap-4 relative z-10">
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-5 text-center border border-white/10">
                            <div
                                class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-2">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                </svg>
                            </div>
                            <div class="text-xs text-white/60 mb-1">
                                Peluang Hujan
                            </div>
                            <div class="text-2xl font-bold text-white">
                                {{ $weather['rain_probability'] }}%
                            </div>
                        </div>

                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-5 text-center border border-white/10">
                            <div
                                class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-2">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                </svg>
                            </div>
                            <div class="text-xs text-white/60 mb-1">
                                Kelembapan
                            </div>
                            <div class="text-2xl font-bold text-white">
                                {{ $weather['humidity'] }}%
                            </div>
                        </div>
                    </div>


                    {{-- FOOTNOTE --}}
                    <div class="mt-6 flex items-center justify-center gap-2 text-xs text-white/50 relative z-10">
                        <svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Data cuaca diperbarui secara real-time
                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- TESTIMONIALS -->
    <section wire:ignore class="py-24 bg-[#1C1C1C] text-white" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="heading-font text-5xl font-bold">Apa Kata Pengunjung</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white/10 backdrop-blur-xl p-8 rounded-3xl">
                    <div class="flex gap-1 text-[#C6A75E]">★★★★☆</div>
                    <p class="mt-6 italic">"Pengalaman masuk ke Lubang Mbah Suro benar-benar luar biasa. Seperti
                        kembali ke masa kolonial!"</p>
                    <div class="mt-10 flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-300 rounded-full"></div>
                        <div>
                            <div class="font-medium">Sarah Chen</div>
                            <div class="text-xs text-white/60">Singapore • Feb 2026</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white/10 backdrop-blur-xl p-8 rounded-3xl">
                    <div class="flex gap-1 text-[#C6A75E]">★★★★★</div>
                    <p class="mt-6 italic">"Danau Kandi seperti permata biru di tengah hutan. Foto-fotonya langsung
                        viral di Instagram!"</p>
                    <div class="mt-10 flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-300 rounded-full"></div>
                        <div>
                            <div class="font-medium">Marco Rossi</div>
                            <div class="text-xs text-white/60">Italy • Jan 2026</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white/10 backdrop-blur-xl p-8 rounded-3xl">
                    <div class="flex gap-1 text-[#C6A75E]">★★★★☆</div>
                    <p class="mt-6 italic">"Museum Goedang Ransoem sangat edukatif. Staf ramah dan penjelasannya
                        lengkap."</p>
                    <div class="mt-10 flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-300 rounded-full"></div>
                        <div>
                            <div class="font-medium">Ayu Pratiwi</div>
                            <div class="text-xs text-white/60">Jakarta • Des 2025</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT -->
    <section wire:ignore id="contact" class="py-24 bg-white" data-aos="fade-up" data-aos-duration="1000"
        data-aos-delay="500">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-16">
            <div>
                <h2 class="heading-font text-5xl font-bold">Hubungi Kami</h2>
                <p class="mt-6 text-gray-600">Kantor Dinas Pariwisata Kota Sawahlunto siap membantu Anda merencanakan
                    perjalanan impian.</p>

                <div class="mt-12 space-y-6">
                    <div class="flex gap-4">
                        <div>📍</div>
                        <div>
                            <div class="font-medium">
                                {{ $websiteProfile?->address }}
                            </div>
                            {{-- <div class="text-sm text-gray-500">Kode Pos 27411</div> --}}
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div>📞</div>
                        <div>{{ $websiteProfile?->phone }}</div>
                    </div>
                    <div class="flex gap-4">
                        <div>✉️</div>
                        <div>{{ $websiteProfile?->email }}</div>
                    </div>
                </div>

                <!-- Google Maps Embed -->
                <div class="mt-12 h-80 rounded-3xl overflow-hidden shadow-inner">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.9999999999995!2d100.77855!3d-0.68181!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2a3b0b0b0b0b0b%3A0x1234567890abcdef!2sSawahlunto%2C%20West%20Sumatra!5e0!3m2!1sen!2sid!4v1700000000000"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-[#F8F6F1] p-10 rounded-3xl">
                <form id="contact-form" onsubmit="handleSubmit(event)" class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium mb-2">Nama Lengkap</label>
                        <input type="text" id="name" required
                            class="w-full px-6 py-4 rounded-2xl border border-transparent focus:border-[#C6A75E] outline-none bg-white">
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium mb-2">Email</label>
                            <input type="email" id="email" required
                                class="w-full px-6 py-4 rounded-2xl border border-transparent focus:border-[#C6A75E] outline-none bg-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Subjek</label>
                            <input type="text" id="subject" required
                                class="w-full px-6 py-4 rounded-2xl border border-transparent focus:border-[#C6A75E] outline-none bg-white">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Pesan</label>
                        <textarea id="message" rows="5" required
                            class="w-full px-6 py-4 rounded-3xl border border-transparent focus:border-[#C6A75E] outline-none bg-white resize-none"></textarea>
                    </div>
                    <button type="submit"
                        class="w-full py-5 bg-[#1C1C1C] text-white rounded-3xl font-medium hover:bg-[#C6A75E] hover:text-[#1C1C1C] transition-all">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </section>


    <script>
        // Tailwind script already loaded
        function initTailwind() {
            // Nothing needed for CDN
        }

        // Dark mode toggle
        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark')
            const icon = document.getElementById('theme-icon')
            if (document.documentElement.classList.contains('dark')) {
                icon.textContent = '🌙'
                localStorage.theme = 'dark'
            } else {
                icon.textContent = '☀️'
                localStorage.theme = 'light'
            }
        }

        // Auto detect dark mode
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
            document.getElementById('theme-icon').textContent = '🌙'
        }

        // Animate stats
        function animateStats() {
            const stats = [{
                    id: 'stat1',
                    target: 25,
                    suffix: '+'
                },
                {
                    id: 'stat2',
                    target: 120,
                    suffix: '+'
                },
                {
                    id: 'stat3',
                    target: 15000,
                    suffix: '+'
                }
            ]

            stats.forEach(stat => {
                let count = 0
                const increment = Math.ceil(stat.target / 60)
                const el = document.getElementById(stat.id)

                const timer = setInterval(() => {
                    count += increment
                    if (count >= stat.target) {
                        count = stat.target
                        clearInterval(timer)
                    }
                    el.textContent = count.toLocaleString() + stat.suffix
                }, 30)
            })
        }

        // Scroll trigger animation
        function scrollTrigger() {
            const elements = document.querySelectorAll('.scroll-trigger')
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible')
                    }
                })
            }, {
                threshold: 0.15
            })

            elements.forEach(el => observer.observe(el))
        }

        // Leaflet Map
        let map, markers = []

        function initMap() {
            const mapContainer = document.getElementById('map-container')
            map = L.map(mapContainer, {
                center: [-0.6818, 100.7786],
                zoom: 14,
                zoomControl: true
            })

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map)

            // Custom icon
            const goldIcon = L.divIcon({
                className: 'custom-marker',
                html: `<div style="background:#C6A75E;width:32px;height:32px;border-radius:9999px;display:flex;align-items:center;justify-content:center;color:white;font-size:18px;">⛏️</div>`,
                iconSize: [32, 32],
                iconAnchor: [16, 32]
            })

            // Markers
            const locations = [{
                    lat: -0.6805,
                    lng: 100.7772,
                    title: "Lubang Mbah Suro",
                    desc: "Terowongan tambang ikonik",
                    cat: "heritage"
                },
                {
                    lat: -0.6832,
                    lng: 100.7801,
                    title: "Museum Goedang Ransoem",
                    desc: "Museum dapur kolonial",
                    cat: "heritage"
                },
                {
                    lat: -0.6750,
                    lng: 100.7725,
                    title: "Danau Kandi",
                    desc: "Danau biru eksotis",
                    cat: "nature"
                }
            ]

            locations.forEach(loc => {
                const marker = L.marker([loc.lat, loc.lng], {
                        icon: goldIcon
                    })
                    .addTo(map)
                    .bindPopup(`
                        <div class="text-center">
                            <strong>${loc.title}</strong><br>
                            <small>${loc.desc}</small>
                        </div>
                    `)
                marker.cat = loc.cat
                markers.push(marker)
            })
        }

        function filterMap(category) {
            markers.forEach(marker => {
                if (category === 'all') {
                    map.addLayer(marker)
                } else {
                    if (marker.cat === category) {
                        map.addLayer(marker)
                    } else {
                        map.removeLayer(marker)
                    }
                }
            })
        }

        // Form handler
        function handleSubmit(e) {
            e.preventDefault()

            const toast = document.getElementById('toast')
            const toastText = document.getElementById('toast-text')

            toastText.textContent = 'Pesan berhasil terkirim! Terima kasih.'
            toast.classList.remove('hidden')
            toast.style.transform = 'translateY(0)'

            // Reset form
            document.getElementById('contact-form').reset()

            // Hide toast after 4s
            setTimeout(() => {
                toast.style.transform = 'translateY(80px)'
                setTimeout(() => toast.classList.add('hidden'), 400)
            }, 4000)
        }

        // Smooth scroll for all anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                if (this.getAttribute('href') !== '#') {
                    e.preventDefault()
                    const target = document.querySelector(this.getAttribute('href'))
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        })
                    }
                }
            })
        })

        // Initialize everything
        window.onload = function() {
            initTailwind()
            animateStats()
            scrollTrigger()
            initMap()

            // Make all sections have scroll-trigger class for demo
            // document.querySelectorAll('section').forEach((section, i) => {
            //     if (i > 1) section.classList.add('scroll-trigger')
            // })

            console.log('%c✅ Sawahlunto Tourism website siap! Premium international standard.',
                'color:#C6A75E; font-size:13px;')
        }
    </script>
</div>