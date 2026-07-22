<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @forelse ($this->accomodations as $index => $accommodation)
        <div
            class="group bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
            <!-- Image Carousel -->
            <div class="relative h-56 overflow-hidden" x-data="{
                currentImage: 0,
                images: @js($accommodation['images']),
                nextImage() { this.currentImage = (this.currentImage + 1) % this.images.length; },
                prevImage() { this.currentImage = (this.currentImage - 1 + this.images.length) % this.images.length; },
                goToImage(index) { this.currentImage = index; }
            }">
                <!-- Main Image -->
                <div class="relative h-full">
                    <template x-for="(image, imgIndex) in images" :key="imgIndex">
                        <img :src="'{{ asset('storage/') }}/' + image.image" :alt="'{{ $accommodation['name'] }} - ' + (imgIndex + 1)"
                            x-show="currentImage === imgIndex" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-105"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute inset-0 w-full h-full object-cover">
                    </template>

                    <!-- Navigation Arrows -->
                    <button @click="prevImage()" x-show="images.length > 1"
                        class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 rounded-full p-2 shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </button>
                    <button @click="nextImage()" x-show="images.length > 1"
                        class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 rounded-full p-2 shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </button>

                    <!-- Image Indicators -->
                    <div x-show="images.length > 1" class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-1">
                        <template x-for="(image, imgIndex) in images" :key="imgIndex">
                            <button @click="goToImage(imgIndex)"
                                class="w-2 h-2 rounded-full transition-all duration-200"
                                :class="currentImage === imgIndex ? 'bg-white w-6' : 'bg-white/50'"></button>
                        </template>
                    </div>

                    <!-- Badge -->
                    <div class="absolute top-3 right-3">
                        <span class="bg-blue-600 text-white text-xs font-semibold px-2 py-1 rounded-full shadow-lg">
                            {{ $index + 1 }}
                        </span>
                    </div>

                    <!-- Hover Overlay -->
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-5">
                <!-- Title and Rating -->
                <div class="flex items-start justify-between mb-3">
                    <h3
                        class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-200 line-clamp-1">
                        {{ $accommodation['name'] }}
                    </h3>
                    <div class="flex items-center gap-1 bg-yellow-50 px-2 py-1 rounded-lg">
                        <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                        <span
                            class="text-sm font-semibold text-gray-700">{{ number_format($accommodation['rating'] ?: 0, 1) }}</span>
                    </div>
                </div>

                <!-- Price -->
                <div class="mb-3">
                    <p class="text-sm font-normal text-gray-600 mb-1">Harga mulai dari</p>
                    <p class="text-2xl font-bold text-blue-600">
                        Rp {{ number_format($accommodation['price_range'] ?: 0, 0, ',', '.') }}
                        <span class="text-xs font-normal text-gray-500">/malam</span>
                    </p>
                </div>

                <!-- Reviews -->
                {{-- <div class="flex items-center gap-2 text-sm text-gray-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                    </svg>
                    <span>{{ $accommodation['reviews'] }} ulasan</span>
                </div> --}}

                <!-- Action Buttons -->
                <div class="mt-4 flex gap-2">
                    <a href="{{ route('acomodation.show', $accommodation['slug']) }}" wire:navigate
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200 text-sm">
                        Lihat Detail
                    </a>
                    <button
                        class="p-2 border border-gray-300 hover:border-blue-600 hover:text-blue-600 rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full">
            <div class="text-center py-16 px-8 bg-gradient-to-br from-gray-50 to-blue-50 border border-gray-200 rounded-2xl shadow-sm">
                <!-- Animated Icon Container -->
                <div class="relative inline-block mb-6">
                    <div class="absolute inset-0 bg-blue-100 rounded-full animate-ping opacity-20"></div>
                    <div class="relative bg-gradient-to-br from-blue-500 to-blue-600 p-4 rounded-full shadow-lg">
                        <x-icon name="building-office-2" class="w-12 h-12 text-white" />
                    </div>
                </div>
                
                <!-- Main Message -->
                <h3 class="text-xl font-semibold text-gray-800 mb-2">
                    Belum Ada Akomodasi Tersedia
                </h3>
                
                <p class="text-gray-600 mb-6 max-w-md mx-auto">
                    Sepertinya belum ada akomodasi yang cocok dengan kriteria Anda. 
                    Coba ubah filter atau kembali lagi nanti.
                </p>
            </div>
        </div>
    @endforelse

    @placeholder
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @for ($i = 0; $i < 4; $i++)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="h-56 bg-gray-200 animate-pulse"></div>
                    <div class="p-5 space-y-3">
                        <div class="h-6 bg-gray-200 rounded animate-pulse"></div>
                        <div class="h-8 bg-gray-200 rounded w-3/4 animate-pulse"></div>
                        <div class="h-4 bg-gray-200 rounded w-1/2 animate-pulse"></div>
                        <div class="h-10 bg-gray-200 rounded animate-pulse"></div>
                    </div>
                </div>
            @endfor
        </div>
    @endplaceholder
</div>
