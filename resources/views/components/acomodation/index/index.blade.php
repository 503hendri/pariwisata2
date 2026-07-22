<div class="min-h-screen bg-gray-50 mt-20">
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                    Temukan Penginapan Terbaik
                </h1>
                <p class="text-blue-100 text-lg max-w-2xl mx-auto">
                    Jelajahi berbagai pilihan hotel, resort, villa, dan penginapan dengan harga terbaik untuk liburan
                    Anda
                </p>
            </div>

            <!-- Search Bar -->
            <div class="mt-8 max-w-2xl mx-auto">
                <div class="bg-white rounded-xl shadow-lg p-2 flex items-center gap-2">
                    <div class="flex-1 flex items-center gap-3 px-4">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" placeholder="Cari hotel, villa, atau penginapan..."
                            class="w-full py-3 outline-none text-gray-700" wire:model.live.debounce.300ms="search">
                    </div>
                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                        Cari
                    </button>
                </div>
            </div>

            <!-- Filter Tags -->
            <div class="mt-6 flex flex-wrap justify-center gap-2">
                <button
                    class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-full text-sm font-medium transition-colors duration-200 backdrop-blur-sm">
                    Semua
                </button>
                <button
                    class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-full text-sm font-medium transition-colors duration-200 backdrop-blur-sm">
                    Hotel
                </button>
                <button
                    class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-full text-sm font-medium transition-colors duration-200 backdrop-blur-sm">
                    Resort
                </button>
                <button
                    class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-full text-sm font-medium transition-colors duration-200 backdrop-blur-sm">
                    Villa
                </button>
                <button
                    class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-full text-sm font-medium transition-colors duration-200 backdrop-blur-sm">
                    Homestay
                </button>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="max-w-7xl mx-auto px-6 py-12">
        <!-- Section Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Rekomendasi Penginapan</h2>
                <p class="text-gray-600 mt-1">{{ count($this->accommodations) }} penginapan ditemukan</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-500">Urutkan:</span>
                <select wire:model.live.debounce.300ms="sort"
                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    <option value="popular">Paling Populer</option>
                    <option value="price_low">Harga Terendah</option>
                    <option value="price_high">Harga Tertinggi</option>
                    <option value="rating">Rating Tertinggi</option>
                </select>
            </div>
        </div>

        <!-- Accommodation Grid -->
        <div wire:loading.class="opacity-50"
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($this->accommodations as $index => $accommodation)
                <div
                    class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                    <!-- Image Carousel -->
                    <div class="relative h-48 overflow-hidden" x-data="{
                        currentImage: 0,
                        images: @js($accommodation->images ?? ['https://via.placeholder.com/400x300']),
                        nextImage() { this.currentImage = (this.currentImage + 1) % this.images.length; },
                        prevImage() { this.currentImage = (this.currentImage - 1 + this.images.length) % this.images.length; },
                        goToImage(index) { this.currentImage = index; }
                    }">
                        <div class="relative h-full">
                            <template x-for="(image, imgIndex) in images" :key="imgIndex">
                                <img :src="'/storage/' + image.image"
                                    :alt="'{{ $accommodation->name }} - ' + (imgIndex + 1)"
                                    x-show="currentImage === imgIndex"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 transform scale-105"
                                    x-transition:enter-end="opacity-100 transform scale-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100 transform scale-100"
                                    x-transition:leave-end="opacity-0 transform scale-95"
                                    class="absolute inset-0 w-full h-full object-cover">
                            </template>

                            <!-- Navigation Arrows -->
                            <button @click="prevImage()" x-show="images.length > 1"
                                class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 rounded-full p-1.5 shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <button @click="nextImage()" x-show="images.length > 1"
                                class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 rounded-full p-1.5 shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>

                            <!-- Image Indicators -->
                            <div x-show="images.length > 1"
                                class="absolute bottom-2 left-1/2 -translate-x-1/2 flex gap-1">
                                <template x-for="(image, imgIndex) in images" :key="imgIndex">
                                    <button @click="goToImage(imgIndex)"
                                        class="w-1.5 h-1.5 rounded-full transition-all duration-200"
                                        :class="currentImage === imgIndex ? 'bg-white w-4' : 'bg-white/50'"></button>
                                </template>
                            </div>

                            <!-- Badge -->
                            @if ($accommodation->is_featured)
                                <div class="absolute top-3 left-3">
                                    <span
                                        class="bg-yellow-500 text-white text-xs font-semibold px-2 py-1 rounded-full shadow-lg flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        Unggulan
                                    </span>
                                </div>
                            @endif

                            <!-- Type Badge -->
                            <div class="absolute top-3 {{ $accommodation->is_featured ? 'right-3' : 'left-3' }}">
                                <span
                                    class="bg-white/90 text-gray-800 text-xs font-semibold px-2 py-1 rounded-full shadow backdrop-blur-sm">
                                    {{ ucfirst($accommodation->type) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-4">
                        <!-- Title & Rating -->
                        <div class="flex items-start justify-between mb-2">
                            <h3
                                class="font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-200 line-clamp-1">
                                {{ $accommodation->name }}
                            </h3>
                            <div class="flex items-center gap-0.5 bg-yellow-50 px-1.5 py-0.5 rounded">
                                <svg class="w-3.5 h-3.5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <span
                                    class="text-xs font-semibold text-gray-700">{{ number_format($accommodation->rating ?? 0, 1) }}</span>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="flex items-center gap-1 text-sm text-gray-500 mb-3">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="line-clamp-1">{{ $accommodation->address }}</span>
                        </div>

                        <!-- Price & CTA -->
                        <div class="flex items-end justify-between">
                            <div>
                                <p class="text-xs text-gray-500">Mulai dari</p>
                                <p class="text-lg font-bold text-blue-600">
                                    Rp {{ number_format($accommodation->price_range ?? 0, 0, ',', '.') }}
                                    <span class="text-xs font-normal text-gray-500">/malam</span>
                                </p>
                            </div>
                            <a href="{{ route('acomodation.show', $accommodation->slug) }}" wire:navigate
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                                Lihat
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="col-span-full">
                    <div class="text-center py-16 px-8 bg-white rounded-2xl shadow-sm">
                        <div class="relative inline-block mb-6">
                            <div class="absolute inset-0 bg-blue-100 rounded-full animate-ping opacity-20"></div>
                            <div
                                class="relative bg-gradient-to-br from-blue-500 to-blue-600 p-4 rounded-full shadow-lg">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Penginapan /
                            {{ $this->search ? 'yang sesuai dengan pencarian' : '' }}</h3>
                        <p class="text-gray-600 mb-6 max-w-md mx-auto">
                            Saat ini belum ada penginapan yang tersedia. Silakan coba lagi nanti atau hubungi kami untuk
                            informasi lebih lanjut.
                        </p>
                        <button wire:click="$refresh"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                            Refresh
                        </button>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if (method_exists($this->accommodations, 'links'))
            <div class="mt-8">
                {{ $this->accommodations->links() }}
            </div>
        @endif
    </div>
</div>
