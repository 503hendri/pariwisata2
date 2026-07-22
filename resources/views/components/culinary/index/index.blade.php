
<div class="min-h-screen bg-gray-50 mt-20">
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-orange-500 via-red-500 to-pink-500 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                    Jelajahi Kuliner Khas
                </h1>
                <p class="text-orange-100 text-lg max-w-2xl mx-auto">
                    Temukan berbagai makanan tradisional dan khas daerah dengan cita rasa yang memukau lidah
                </p>
            </div>

            <!-- Search Bar -->
            <div class="mt-8 max-w-2xl mx-auto">
                <div class="bg-white rounded-xl shadow-lg p-2 flex items-center gap-2">
                    <div class="flex-1 flex items-center gap-3 px-4">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" placeholder="Cari makanan favorit Anda..." 
                               class="w-full py-3 outline-none text-gray-700" wire:model.live.debounce.300ms="search">
                    </div>
                    <button class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                        Cari
                    </button>
                </div>
            </div>

            <!-- Filter Tags -->
            <div class="mt-6 flex flex-wrap justify-center gap-2">
                <button class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-full text-sm font-medium transition-colors duration-200 backdrop-blur-sm">
                    Semua
                </button>
                <button wire:click="$set('category', 'Makanan Berat')" class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-full text-sm font-medium transition-colors duration-200 backdrop-blur-sm">
                    Makanan Berat
                </button>
                <button wire:click="$set('category', 'Makanan Ringan')" class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-full text-sm font-medium transition-colors duration-200 backdrop-blur-sm">
                    Makanan Ringan
                </button>
                <button wire:click="$set('category', 'Minuman')" class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-full text-sm font-medium transition-colors duration-200 backdrop-blur-sm">
                    Minuman
                </button>
                <button wire:click="$set('category', 'Jajanan')" class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-full text-sm font-medium transition-colors duration-200 backdrop-blur-sm">
                    Jajanan
                </button>
                <button wire:click="$set('category', 'Dessert')" class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-full text-sm font-medium transition-colors duration-200 backdrop-blur-sm">
                    Dessert
                </button>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="max-w-7xl mx-auto px-6 py-12">
        <!-- Section Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Rekomendasi Kuliner</h2>
                <p class="text-gray-600 mt-1">{{ count($this->culinaries) }} kuliner ditemukan</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-500">Urutkan:</span>
                <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm bg-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none">
                    <option>Paling Populer</option>
                    <option>Harga Terendah</option>
                    <option>Harga Tertinggi</option>
                    <option>Rating Tertinggi</option>
                </select>
            </div>
        </div>

        <!-- Culinary Grid -->
        <div wire:loading.class="opacity-50" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($this->culinaries as $culinary)
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                    <!-- Image -->
                    <div class="relative h-48 overflow-hidden">
                        <img src="/storage/{{ $culinary->image ?: 'https://via.placeholder.com/400x300' }}" 
                             alt="{{ $culinary->name }}"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        
                        <!-- Category Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="bg-orange-500 text-white text-xs font-semibold px-2 py-1 rounded-full shadow">
                                {{ ucfirst($culinary->category) }}
                            </span>
                        </div>

                        <!-- Rating Badge -->
                        @if($culinary->rating)
                            <div class="absolute top-3 right-3 bg-yellow-50 px-2 py-1 rounded-lg flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <span class="text-xs font-semibold text-gray-700">{{ number_format($culinary->rating, 1) }}</span>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Content -->
                    <div class="p-4">
                        <!-- Title & Price -->
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-bold text-gray-900 group-hover:text-orange-600 transition-colors duration-200 line-clamp-1">
                                {{ $culinary->name }}
                            </h3>
                            <div class="text-right">
                                <p class="text-xs text-gray-500">Mulai dari</p>
                                <p class="text-lg font-bold text-orange-600">
                                    Rp {{ number_format($culinary->price ?? 0, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <p class="text-sm text-gray-600 line-clamp-2 mb-3">
                            {{ $culinary->description ?? 'Nikmati cita rasa khas dari makanan tradisional ini.' }}
                        </p>
                        
                        <!-- CTA Button -->
                        <a href="{{ route('culinary.show', $culinary->slug) }}" wire:navigate
                           class="w-full bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 text-center">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="col-span-full">
                    <div class="text-center py-16 px-8 bg-white rounded-2xl shadow-sm">
                        <div class="relative inline-block mb-6">
                            <div class="absolute inset-0 bg-orange-100 rounded-full animate-ping opacity-20"></div>
                            <div class="relative bg-gradient-to-br from-orange-500 to-red-500 p-4 rounded-full shadow-lg">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332-.477 4.5-1.253M13 14H7m6 0v-3H7m6 0v3z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Kuliner</h3>
                        <p class="text-gray-600 mb-6 max-w-md mx-auto">
                            Saat ini belum ada kuliner yang tersedia. Silakan coba lagi nanti atau hubungi kami untuk informasi lebih lanjut.
                        </p>
                        <button wire:click="$refresh" class="inline-flex items-center gap-2 px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Refresh
                        </button>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if(method_exists($this->culinaries, 'links'))
            <div class="mt-8">
                {{ $this->culinaries->links() }}
            </div>
        @endif
    </div>
</div>