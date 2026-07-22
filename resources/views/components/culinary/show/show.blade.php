
@if($culinary)
    <div class="min-h-screen bg-gray-50 mt-20">
        <!-- Breadcrumb -->
        <div class="bg-white border-b">
            <div class="max-w-7xl mx-auto px-6 py-4">
                <nav class="flex items-center gap-2 text-sm">
                    <a href="{{ route('home') }}" class="text-gray-500 hover:text-orange-600 transition-colors">Beranda</a>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <a href="{{ route('culinary.index') }}" class="text-gray-500 hover:text-orange-600 transition-colors">Kuliner</a>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-gray-900 font-medium">{{ $culinary->name }}</span>
                </nav>
            </div>
        </div>

        <!-- Image Gallery Section -->
        <div class="bg-white">
            <div class="max-w-7xl mx-auto px-6 py-6">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                    <!-- Main Hero Image -->
                    <div class="relative h-[400px] lg:h-[600px]">
                        <img src="/storage/{{ $culinary->image ?: 'https://via.placeholder.com/1200x800' }}" 
                             alt="{{ $culinary->name }}"
                             class="w-full h-full object-cover">
                        
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

                        <!-- Category Badge -->
                        <div class="absolute top-6 left-6">
                            <span class="bg-orange-500 text-white text-sm font-semibold px-4 py-2 rounded-full shadow-lg">
                                {{ ucfirst($culinary->category) }}
                            </span>
                        </div>

                        <!-- Rating Badge -->
                        @if($culinary->rating)
                            <div class="absolute top-6 right-6 bg-yellow-50 px-3 py-2 rounded-xl flex items-center gap-2 shadow-lg">
                                <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <span class="text-lg font-bold text-gray-800">{{ number_format($culinary->rating, 1) }}</span>
                            </div>
                        @endif

                        <!-- Bottom Info Overlay -->
                        <div class="absolute bottom-0 left-0 right-0 p-6 lg:p-8">
                            <h1 class="text-4xl lg:text-5xl font-bold text-white mb-2 drop-shadow-lg">{{ $culinary->name }}</h1>
                            <div class="flex items-center gap-4">
                                <span class="text-2xl font-bold text-orange-400">Rp {{ number_format($culinary->price ?? 0, 0, ',', '.') }}</span>
                                <span class="text-white/80">•</span>
                                <span class="text-white/80">{{ ucfirst($culinary->category) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-4xl mx-auto px-6 py-8">
            <!-- Description Card -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Tentang Kuliner Ini</h2>
                </div>
                
                <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                    {{ $culinary->description ?? 'Nikmati cita rasa khas dari makanan tradisional ini yang menggugah selera. Dibuat dengan bahan-bahan berkualitas dan resep turun-temurun yang telah teruji waktu.' }}
                </div>

                <!-- Info Tags -->
                <div class="flex flex-wrap gap-3 mt-8 pt-8 border-t">
                    <div class="flex items-center gap-2 bg-gray-100 px-4 py-2 rounded-full">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm font-medium text-gray-700">Harga Terjangkau</span>
                    </div>
                    <div class="flex items-center gap-2 bg-gray-100 px-4 py-2 rounded-full">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm font-medium text-gray-700">Tersedia Setiap Hari</span>
                    </div>
                    <div class="flex items-center gap-2 bg-gray-100 px-4 py-2 rounded-full">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="text-sm font-medium text-gray-700">Khas Daerah</span>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-8 text-center">
                <a href="{{ route('culinary.index') }}" 
                   class="inline-flex items-center gap-2 px-6 py-3 bg-white hover:bg-gray-50 text-gray-700 font-medium rounded-xl shadow-sm border transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Jelajah Kuliner
                </a>
            </div>
        </div>
    </div>
@else
    <!-- Not Found State -->
    <div class="min-h-screen bg-gray-50 flex items-center justify-center mt-20">
        <div class="text-center">
            <div class="bg-gray-100 p-6 rounded-full inline-block mb-4">
                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332-.477 4.5-1.253M13 14H7m6 0v-3H7m6 0v3z"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Kuliner Tidak Ditemukan</h1>
            <p class="text-gray-600 mb-6">Maaf, kuliner yang Anda cari tidak tersedia.</p>
            <a href="{{ route('culinary.index') }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar Kuliner
            </a>
        </div>
    </div>
@endif