<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Sawahlunto Tourism - Official Digital Tourism Portal for Sawahlunto, UNESCO World Heritage Ombilin Coal Mining Heritage. Where History Meets Natural Beauty.">
    <meta name="keywords"
        content="Sawahlunto, Tourism, UNESCO, Ombilin, Coal Mining Heritage, West Sumatra, Lubang Mbah Suro, Museum Goedang Ransoem, Danau Kandi">
    <meta property="og:title" content="Sawahlunto Tourism | UNESCO World Heritage">
    <meta property="og:description"
        content="Discover the historic mining city of Sawahlunto, a UNESCO World Heritage Site.">
    <meta property="og:image" content="https://picsum.photos/id/1015/1200/630">
    <meta property="og:url" content="https://sawahluntotourism.sawahluntokota.go.id">

    <title>
        {{ filled($title ?? null) ? $title . ' - ' . config('app.name', 'Laravel') : config('app.name', 'Laravel') }}
    </title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    @vite(['resources/css/app.css', 'resources/css/guest.css', 'resources/js/app.js'])
    @fluxAppearance
</head>

<body class="tail-container bg-[#F8F6F1] text-[#1C1C1C] overflow-x-hidden">
    <nav class="fixed top-0 left-0 right-0 z-50 glass border-b border-white/30" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center gap-x-3">
                <img src="{{ Storage::url('images/sawahlunto_tourism.png') }}" alt="Logo" class="h-10">
                <div class="md:block hidden">
                    <span class="heading-font text-2xl tracking-tight text-[#1C1C1C] dark:text-white">Sawahlunto</span>
                    <span class="text-sm text-[#C6A75E] block -mt-1 tracking-[2px]">TOURISM</span>
                </div>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center gap-x-8 text-sm font-medium">
                <a href="{{ request()->routeIs('home') ? '#destinations' : route('home') }}#destinations"
                    class="nav-link text-[#1C1C1C] dark:text-white hover:text-[#C6A75E] transition-colors">Destinasi</a>
                <a href="{{ request()->routeIs('home') ? '#news' : route('home') }}#news"
                    class="nav-link text-[#1C1C1C] dark:text-white hover:text-[#C6A75E] transition-colors">Berita</a>
                <a href="{{ request()->routeIs('home') ? '#why' : route('home') }}#why"
                    class="nav-link text-[#1C1C1C] dark:text-white hover:text-[#C6A75E] transition-colors">Mengapa
                    Sawahlunto</a>
                {{-- <a href="{{ request()->routeIs('home') ? '#' : route('home') }}map"
                    class="nav-link text-[#1C1C1C] dark:text-white hover:text-[#C6A75E] transition-colors">Peta
                    Interaktif</a> --}}
                <a href="{{ request()->routeIs('home') ? '#events' : route('home') }}#events"
                    class="nav-link text-[#1C1C1C] dark:text-white hover:text-[#C6A75E] transition-colors">Event</a>
                <a href="{{ request()->routeIs('home') ? '#culinary' : route('home') }}#culinary"
                    class="nav-link text-[#1C1C1C] dark:text-white hover:text-[#C6A75E] transition-colors">Kuliner</a>
                <a href="{{ request()->routeIs('home') ? '#accommodation' : route('home') }}#accommodation"
                    class="nav-link text-[#1C1C1C] dark:text-white hover:text-[#C6A75E] transition-colors">Penginapan</a>
                <a href="{{ request()->routeIs('home') ? '#plan' : route('home') }}#plan"
                    class="nav-link text-[#1C1C1C] dark:text-white hover:text-[#C6A75E] transition-colors">Rencanakan
                    Perjalanan</a>
            </div>

            <!-- Right Side -->
            <div class="flex items-center gap-x-4">
                <button onclick="toggleDarkMode()" id="dark-toggle"
                    class="w-10 h-10 flex items-center justify-center rounded-2xl hover:bg-white/70 transition-colors">
                    <span id="theme-icon">☀️</span>
                </button>

                <a href="#contact"
                    class="hidden md:block px-6 py-3 bg-[#1C1C1C] hover:bg-[#C6A75E] text-white hover:text-[#1C1C1C] rounded-3xl text-sm font-semibold transition-all duration-300">
                    Hubungi Kami
                </a>

                <!-- Hamburger -->
                <button class="md:hidden text-[#1C1C1C] focus:outline-none" @click="open = !open">
                    <svg x-show="!open" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            class="md:hidden absolute top-full left-0 right-0 bg-[#F8F6F1]/95 backdrop-blur-lg border-b border-white/30 shadow-xl">
            <div class="px-6 py-8 flex flex-col gap-y-6 text-lg font-medium">
                <a href="#destinations" @click="open = false"
                    class="text-[#1C1C1C] hover:text-[#C6A75E] transition-colors">Destinasi</a>
                <a href="#why" @click="open = false"
                    class="text-[#1C1C1C] hover:text-[#C6A75E] transition-colors">Mengapa Sawahlunto</a>
                <a href="#map" @click="open = false"
                    class="text-[#1C1C1C] hover:text-[#C6A75E] transition-colors">Peta Interaktif</a>
                <a href="#events" @click="open = false"
                    class="text-[#1C1C1C] hover:text-[#C6A75E] transition-colors">Event</a>
                <a href="#culinary" @click="open = false"
                    class="text-[#1C1C1C] hover:text-[#C6A75E] transition-colors">Kuliner</a>
                <a href="#plan" @click="open = false"
                    class="text-[#1C1C1C] hover:text-[#C6A75E] transition-colors">Rencanakan Perjalanan</a>

                <a href="#contact" @click="open = false"
                    class="mt-4 px-8 py-4 bg-[#1C1C1C] hover:bg-[#C6A75E] text-white hover:text-[#1C1C1C] rounded-3xl text-center font-semibold transition-all">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </nav>

    {{ $slot }}

    <!-- FOOTER -->
    {{-- <footer class="bg-[#1C1C1C] text-white/80 py-20">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-12">
            <!-- Brand Section -->
            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-3">
                    <div
                        class="w-8 h-8 bg-[#C6A75E] rounded-2xl flex items-center justify-center text-white font-bold text-lg">
                        S
                    </div>
                    <span class="font-semibold text-4xl tracking-tight">Sawahlunto Tourism</span>
                </div>
                <p class="text-xs mt-6 max-w-xs opacity-80">
                    Portal resmi pariwisata Kota Sawahlunto – Situs Warisan Dunia UNESCO.
                </p>
            </div>

            <!-- Quick Links Section -->
            <div>
                <div class="uppercase text-xs tracking-widest mb-6 text-[#C6A75E]">Quick Links</div>
                <div class="space-y-3 text-sm">
                    <a href="#"
                        class="block text-white hover:text-[#C6A75E] transition-colors duration-300">Destinasi</a>
                    <a href="#"
                        class="block text-white hover:text-[#C6A75E] transition-colors duration-300">Acara</a>
                    <a href="#"
                        class="block text-white hover:text-[#C6A75E] transition-colors duration-300">Kuliner</a>
                    <a href="#"
                        class="block text-white hover:text-[#C6A75E] transition-colors duration-300">Peta</a>
                </div>
            </div>

            <!-- Social Media Section -->
            <div>
                <div class="uppercase text-xs tracking-widest mb-6 text-[#C6A75E]">Ikuti Kami</div>
                <div class="flex gap-6 text-2xl">
                    <a href="#"
                        class="text-white hover:text-[#C6A75E] transition-transform transform hover:scale-125">📸</a>
                    <a href="#"
                        class="text-white hover:text-[#C6A75E] transition-transform transform hover:scale-125">𝕏</a>
                    <a href="#"
                        class="text-white hover:text-[#C6A75E] transition-transform transform hover:scale-125">▶️</a>
                </div>
            </div>

            <!-- Newsletter Section -->
            <div>
                <div class="uppercase text-xs tracking-widest mb-6 text-[#C6A75E]">Newsletter</div>
                <div class="flex">
                    <input type="email" placeholder="Email Anda"
                        class="bg-white/10 text-white px-5 py-4 flex-1 rounded-l-3xl text-sm outline-none focus:ring-2 focus:ring-[#C6A75E] focus:border-transparent transition-all duration-300">
                    <button
                        class="bg-[#C6A75E] text-[#1C1C1C] px-8 py-3 rounded-r-3xl font-medium transition-all duration-300 hover:bg-[#D0A457]">
                        Kirim
                    </button>
                </div>
            </div>
        </div>

        <!-- Footer Bottom Section -->
        <div class="text-center text-xs text-white/40 mt-20 border-t border-white/10 pt-8">
            <p>© 2026 Sawahlunto Tourism • All Rights Reserved • Privacy • Sitemap</p>
        </div>
    </footer> --}}

    <footer class="bg-zinc-900 text-stone-300 pt-16 pb-8 border-t border-zinc-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Social Media Section -->
            <div class="text-center mb-12 pb-12 border-b border-zinc-800">
                <h3 class="text-white font-bold text-xl mb-6">Ikuti Kami di Media Sosial</h3>
                <div class="flex justify-center gap-4">
                    <!-- Facebook -->
                    <a href="{{ \App\Models\WebsiteProfile::first()->facebook_url ?? '#' }}" class="w-12 h-12 rounded-full bg-zinc-800 flex items-center justify-center hover:bg-blue-600 transition duration-300 group">
                        <svg class="w-6 h-6 text-stone-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <!-- Instagram -->
                    <a href="#" class="w-12 h-12 rounded-full bg-zinc-800 flex items-center justify-center hover:bg-pink-600 transition duration-300 group">
                        <svg class="w-6 h-6 text-stone-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    <!-- TikTok -->
                    <a href="#" class="w-12 h-12 rounded-full bg-zinc-800 flex items-center justify-center hover:bg-black border border-zinc-700 hover:border-white transition duration-300 group">
                        <svg class="w-6 h-6 text-stone-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Main Footer Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 mb-12">

                <!-- Column 1: Brand & Social Icons -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-green-700 rounded-lg flex items-center justify-center text-white font-bold text-lg">SL</div>
                        <span class="font-bold text-xl text-white tracking-wide">SAWAHLUNTO</span>
                    </div>
                    <p class="text-stone-400 leading-relaxed text-sm">
                        Portal resmi pariwisata Kota Sawah Lunto. Jelajahi warisan tambang batubara, budaya kolonial, dan kuliner autentik di jantung Sumatera Barat.
                    </p>
                    <div class="flex space-x-3">
                        <!-- Facebook -->
                        <a href="#" class="w-9 h-9 rounded-lg bg-zinc-800 flex items-center justify-center hover:bg-blue-600 transition duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <!-- TikTok -->
                        <a href="#" class="w-9 h-9 rounded-lg bg-zinc-800 flex items-center justify-center hover:bg-black border border-zinc-700 hover:border-white transition duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                            </svg>
                        </a>
                        <!-- Instagram -->
                        <a href="#" class="w-9 h-9 rounded-lg bg-zinc-800 flex items-center justify-center hover:bg-pink-600 transition duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <!-- YouTube -->
                        <a href="#" class="w-9 h-9 rounded-lg bg-zinc-800 flex items-center justify-center hover:bg-red-600 transition duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Column 2: Tourist Services -->
                <div>
                    <h4 class="text-white font-bold text-lg mb-6">Tourist Services</h4>
                    <ul class="space-y-3 text-sm">
                        <li>
                            <a href="#" class="hover:text-green-400 transition flex items-center gap-3 group">
                                <span class="w-8 h-8 rounded-lg bg-zinc-800 flex items-center justify-center group-hover:bg-green-700 transition">
                                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </span>
                                <span class="text-stone-400 group-hover:text-white transition">Tourist Information Center</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-green-400 transition flex items-center gap-3 group">
                                <span class="w-8 h-8 rounded-lg bg-zinc-800 flex items-center justify-center group-hover:bg-green-700 transition">
                                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                </span>
                                <span class="text-stone-400 group-hover:text-white transition">Emergency Services</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-green-400 transition flex items-center gap-3 group">
                                <span class="w-8 h-8 rounded-lg bg-zinc-800 flex items-center justify-center group-hover:bg-green-700 transition">
                                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 7m0 13V7"/>
                                    </svg>
                                </span>
                                <span class="text-stone-400 group-hover:text-white transition">Transportation Guide</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-green-400 transition flex items-center gap-3 group">
                                <span class="w-8 h-8 rounded-lg bg-zinc-800 flex items-center justify-center group-hover:bg-green-700 transition">
                                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
                                    </svg>
                                </span>
                                <span class="text-stone-400 group-hover:text-white transition">Tour Packages</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Column 3: Contact Information -->
                <div>
                    <h4 class="text-white font-bold text-lg mb-6">Contact Information</h4>
                    <ul class="space-y-4 text-sm">
                        <li class="flex items-start gap-3">
                            <span class="w-8 h-8 rounded-lg bg-zinc-800 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </span>
                            <span class="text-stone-400">Jl. Kebun Jati No. 1 Saringan</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-zinc-800 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </span>
                            <span class="text-stone-400">+62 821 8024 6567</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-zinc-800 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            <span class="text-stone-400 text-xs">info@sawahluntotourism.sawahluntokota.go.id</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-8 h-8 rounded-lg bg-zinc-800 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </span>
                            <div class="text-stone-400">
                                <p>Mon - Fri: 8:00 AM - 5:00 PM</p>
                                <p>Sat - Sun: 9:00 AM - 4:00 PM</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-zinc-800 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-stone-500 text-sm">
                        &copy; {{ date('Y') }} <span class="text-green-500 font-semibold">Sawah Lunto Tourism</span>. All rights reserved.
                    </p>
                    <div class="flex gap-6 text-sm text-stone-500">
                        <a href="#" class="hover:text-white transition">Privacy Policy</a>
                        <a href="#" class="hover:text-white transition">Terms of Service</a>
                        <a href="#" class="hover:text-white transition">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Toast Notification -->
    <div id="toast"
        class="hidden fixed bottom-6 right-6 bg-[#1F4D3B] text-white px-8 py-4 rounded-3xl shadow-2xl flex items-center gap-3">
        <span id="toast-text" class="font-medium"></span>
    </div>

    @fluxScripts

    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>

    @stack('scripts')
</body>

</html>
