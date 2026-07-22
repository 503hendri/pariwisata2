@if ($accommodation)
    <div class="min-h-screen bg-gray-50 mt-20">
        <!-- Breadcrumb -->
        <div class="bg-white border-b">
            <div class="max-w-7xl mx-auto px-6 py-4">
                <nav class="flex items-center gap-2 text-sm">
                    <a href="{{ route('home') }}" class="text-gray-500 hover:text-blue-600 transition-colors">Beranda</a>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <a href="{{ route('acomodation.index') }}"
                        class="text-gray-500 hover:text-blue-600 transition-colors">Penginapan</a>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-gray-900 font-medium">{{ $accommodation->name }}</span>
                </nav>
            </div>
        </div>

        <!-- Image Gallery Section -->
        <div class="bg-white">
            <div class="max-w-7xl mx-auto px-6 py-6">
                @php
                    $images = $accommodation->images->map(fn($img) => $img->image)->toArray();
                    $thumbnail = $accommodation->thumbnail;
                    $allImages = array_filter(array_merge([$thumbnail], $images));
                    $allImages = !empty($allImages) ? $allImages : ['https://via.placeholder.com/800x600'];
                @endphp

                <!-- Beautiful Static Image Gallery with Click to View -->
                <div class="space-y-4" x-data="{
                    currentImageIndex: 0,
                    images: @js($allImages),
                    showImage(index) {
                        this.currentImageIndex = index;
                    }
                }">
                    <!-- Main Hero Image -->
                    <div class="relative rounded-2xl overflow-hidden shadow-xl">
                        @if (!empty($allImages))
                            <img :src="'/storage/' + images[currentImageIndex + 1]"
                                :alt="'{{ $accommodation->name }} - ' + (currentImageIndex)"
                                class="w-full h-[400px] lg:h-[500px] object-cover transition-opacity duration-300">

                            <!-- Featured Badge -->
                            @if ($accommodation->is_featured)
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="bg-yellow-500 text-white text-sm font-semibold px-3 py-1 rounded-full shadow-lg flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                            </path>
                                        </svg>
                                        Unggulan
                                    </span>
                                </div>
                            @endif

                            <!-- Image Counter -->
                            @if (count($allImages) > 1)
                                <div
                                    class="absolute bottom-4 left-4 bg-black/50 text-white px-3 py-1 rounded-full text-sm backdrop-blur-sm">
                                    <span x-text="currentImageIndex + 1"></span> / <span">{{ count($allImages) }}</span>
                                </div>
                            @endif

                            <!-- View All Photos Button -->
                            @if (count($allImages) > 1)
                                <button
                                    class="absolute bottom-4 right-4 bg-white/90 hover:bg-white text-gray-800 px-4 py-2 rounded-lg text-sm font-medium shadow-lg backdrop-blur-sm transition-colors">
                                    <span class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        Lihat Semua Foto
                                    </span>
                                </button>
                            @endif
                        @else
                            <!-- Placeholder Image -->
                            <div class="w-full h-[400px] lg:h-[500px] bg-gray-200 flex items-center justify-center">
                                <div class="text-center">
                                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <p class="text-gray-500">Belum ada foto</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Thumbnail Gallery -->
                    @if (count($allImages) > 1)
                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3">
                            @foreach (array_slice($allImages, 0, 6) as $index => $image)
                                <div class="relative group cursor-pointer overflow-hidden rounded-lg {{ $index === 0 ? 'ring-2 ring-blue-500' : '' }}"
                                    @click="showImage({{ $index }})">
                                    <img src="/storage/{{ $image }}"
                                        alt="{{ $accommodation->name }} - {{ $index + 1 }}"
                                        class="w-full h-24 md:h-32 lg:h-40 object-cover transition-transform duration-300 group-hover:scale-110">

                                    <!-- Active Indicator -->
                                    <div x-show="currentImageIndex === {{ $index }}"
                                        class="absolute inset-0 bg-blue-500/20 border-2 border-blue-500 rounded-lg">
                                    </div>

                                    <!-- Overlay on Hover -->
                                    <div
                                        class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7">
                                            </path>
                                        </svg>
                                    </div>

                                    <!-- Photo Number -->
                                    <div
                                        class="absolute top-2 right-2 bg-black/50 text-white text-xs px-2 py-1 rounded-full">
                                        {{ $index + 1 }}
                                    </div>
                                </div>
                            @endforeach

                            <!-- More Photos Indicator -->
                            @if (count($allImages) > 6)
                                <div
                                    class="relative cursor-pointer overflow-hidden rounded-lg bg-gray-900 flex items-center justify-center group">
                                    <div class="text-center text-white">
                                        <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <p class="text-sm font-semibold">+{{ count($allImages) - 6 }}</p>
                                        <p class="text-xs opacity-75">Foto Lainnya</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-6 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column - Main Info -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Header Card -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <div class="flex items-center gap-3 mb-2">
                                    <h1 class="text-3xl font-bold text-gray-900">{{ $accommodation->name }}</h1>
                                    @if ($accommodation->is_featured)
                                        <span
                                            class="bg-yellow-100 text-yellow-800 text-sm font-semibold px-3 py-1 rounded-full flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                </path>
                                            </svg>
                                            Unggulan
                                        </span>
                                    @endif
                                </div>
                                <div class="flex items-center gap-2 text-gray-600">
                                    <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2 py-1 rounded">
                                        {{ ucfirst($accommodation->type) }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        {{ $accommodation->address }}
                                    </span>
                                </div>
                            </div>
                            <div class="text-center bg-yellow-50 px-4 py-2 rounded-xl">
                                <div class="flex items-center gap-1 justify-center">
                                    <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <span
                                        class="text-2xl font-bold text-gray-900">{{ number_format($accommodation->rating ?? 0, 1) }}</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Rating</p>
                            </div>
                        </div>

                        <!-- Quick Info Tags -->
                        <div class="flex flex-wrap gap-2 mt-4 pt-4 border-t">
                            <span
                                class="flex items-center gap-1 text-sm text-gray-600 bg-gray-100 px-3 py-1 rounded-full">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                Harga Terbaik
                            </span>
                            <span
                                class="flex items-center gap-1 text-sm text-gray-600 bg-gray-100 px-3 py-1 rounded-full">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Tersedia
                            </span>
                            <span
                                class="flex items-center gap-1 text-sm text-gray-600 bg-gray-100 px-3 py-1 rounded-full">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Reservasi 24 Jam
                            </span>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Tentang Penginapan
                        </h2>
                        <p class="text-gray-600 leading-relaxed">
                            {{ $accommodation->description ?? 'Belum ada deskripsi untuk penginapan ini.' }}</p>
                    </div>

                    <!-- Location Map -->
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Lokasi
                        </h2>
                        <div class="bg-gray-100 rounded-xl h-64 flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0121 18.382V7.618a1 1 0 01-.553-.894L15 7m0 13V7">
                                    </path>
                                </svg>
                                <p class="text-gray-500">{{ $accommodation->address }}</p>
                                @if ($accommodation->latitude && $accommodation->longitude)
                                    <p class="text-sm text-gray-400 mt-1">{{ $accommodation->latitude }},
                                        {{ $accommodation->longitude }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Booking Card -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24 space-y-4">
                        <!-- Price Card -->
                        <div class="bg-white rounded-2xl shadow-lg p-6">
                            <div class="mb-4">
                                <p class="text-sm text-gray-500">Harga per malam mulai dari</p>
                                <div class="flex items-baseline gap-2">
                                    <span class="text-3xl font-bold text-blue-600">Rp
                                        {{ number_format($accommodation->price_range ?? 0, 0, ',', '.') }}</span>
                                    <span class="text-gray-500">/malam</span>
                                </div>
                            </div>

                            <!-- Contact Buttons -->
                            <div class="space-y-3">
                                @if ($accommodation->whatsapp)
                                    <a href="https://wa.me/{{ $accommodation->whatsapp }}?text=Halo, saya tertarik dengan {{ $accommodation->name }}"
                                        target="_blank"
                                        class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-4 rounded-xl flex items-center justify-center gap-2 transition-colors">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.13 1.58 5.929L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                        </svg>
                                        Chat WhatsApp
                                    </a>
                                @endif

                                @if ($accommodation->phone)
                                    <a href="tel:{{ $accommodation->phone }}"
                                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-xl flex items-center justify-center gap-2 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                            </path>
                                        </svg>
                                        Hubungi Telepon
                                    </a>
                                @endif

                                @if ($accommodation->website)
                                    <a href="{{ $accommodation->website }}" target="_blank"
                                        class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 px-4 rounded-xl flex items-center justify-center gap-2 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
                                            </path>
                                        </svg>
                                        Kunjungi Website
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Quick Info Card -->
                        <div class="bg-white rounded-2xl shadow-sm p-6">
                            <h3 class="font-semibold text-gray-900 mb-4">Informasi Kontak</h3>
                            <div class="space-y-3">
                                @if ($accommodation->phone)
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Telepon</p>
                                            <p class="font-medium text-gray-900">{{ $accommodation->phone }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if ($accommodation->whatsapp)
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-green-600" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.13 1.58 5.929L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">WhatsApp</p>
                                            <p class="font-medium text-gray-900">{{ $accommodation->whatsapp }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if ($accommodation->website)
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Website</p>
                                            <p class="font-medium text-gray-900 truncate max-w-[200px]">
                                                {{ Str::limit($accommodation->website, 30) }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <!-- Not Found State -->
    <div class="min-h-screen bg-gray-50 flex items-center justify-center mt-20">
        <div class="text-center">
            <div class="bg-gray-100 p-6 rounded-full inline-block mb-4">
                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                    </path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Penginapan Tidak Ditemukan</h1>
            <p class="text-gray-600 mb-6">Maaf, penginapan yang Anda cari tidak tersedia.</p>
            <a href="{{ route('acomodation.index') }}"
                class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar Penginapan
            </a>
        </div>
    </div>
@endif
