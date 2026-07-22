@props([
    'destinations' => [],
])

@if (count($destinations) > 0)
    <div class="destinations-swiper swiper">
        <div class="swiper-wrapper">
            @foreach ($destinations as $destination)
                <div class="swiper-slide !h-auto p-2"> {{-- Padding kecil agar shadow tidak terpotong --}}
                    <div
                        class="group bg-white rounded-3xl overflow-hidden shadow-[0_10px_40px_-15px_rgba(0,0,0,0.1)] hover:shadow-[0_20px_50px_-15px_rgba(198,167,94,0.3)] h-full flex flex-col transition-all duration-500 hover:-translate-y-2 border border-gray-100">

                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ Storage::url($destination['cover']) }}" alt="{{ $destination['name'] }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                onerror="this.onerror=null; this.src='{{ Storage::url('images/no-image.jpg') }}'">

                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80">
                            </div>

                            <div
                                class="absolute top-4 right-4 backdrop-blur-md bg-white/20 border border-white/30 text-white px-3 py-1.5 rounded-2xl text-xs font-bold flex items-center gap-1.5 shadow-lg">
                                <span class="text-yellow-400 text-sm">★</span> {{ $destination['rating'] }}
                            </div>

                            <div class="absolute bottom-5 left-6 right-6">
                                <span
                                    class="inline-block bg-[#C6A75E] text-white text-[10px] px-3 py-1 rounded-full uppercase tracking-[0.2em] mb-2 shadow-lg">
                                    {{ $destination['category'] }}
                                </span>
                                <h3
                                    class="text-white text-2xl font-bold leading-tight group-hover:text-[#C6A75E] transition-colors duration-300">
                                    {{ $destination['name'] }}
                                </h3>
                            </div>
                        </div>

                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex flex-col">
                                    <span class="text-gray-400 text-[10px] uppercase tracking-wider">Mulai dari</span>
                                    <span class="text-lg font-bold text-[#1F4D3B]">{{ $destination['price'] }}</span>
                                </div>
                                <div class="flex -space-x-2">
                                    {{-- Dekorasi avatar kecil untuk kesan "popular" --}}
                                    <div class="w-7 h-7 rounded-full border-2 border-white bg-gray-200"></div>
                                    <div class="w-7 h-7 rounded-full border-2 border-white bg-gray-300"></div>
                                    <div
                                        class="w-7 h-7 rounded-full border-2 border-white bg-[#C6A75E] flex items-center justify-center text-[8px] text-white">
                                        +5</div>
                                </div>
                            </div>

                            <p class="text-gray-500 text-sm leading-relaxed line-clamp-2 mb-6 flex-grow">
                                {{ $destination['description'] }}
                            </p>

                            <button
                                class="relative overflow-hidden group/btn w-full bg-gray-50 hover:bg-[#C6A75E] text-[#1F4D3B] hover:text-white py-3.5 rounded-2xl font-semibold text-sm transition-all duration-300 flex items-center justify-center gap-2 border border-gray-100 hover:border-[#C6A75E] cursor-pointer"
                                wire:click="viewDestination('{{ $destination['slug'] }}')">
                                <span class="relative z-10 flex items-center gap-2">
                                    <x-icon.eye class="w-4 h-4 transition-transform group-hover/btn:scale-125" />
                                    Lihat Destinasi
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Arrows (custom posisi & style) -->
        <div
            class="swiper-button-prev absolute left-[-20px] md:left-[-40px] top-1/2 -translate-y-1/2 z-10 text-[#C6A75E] text-4xl opacity-80 hover:opacity-100 transition !bg-white/80 !rounded-full !w-12 !h-12 !flex !items-center !justify-center shadow-md">
        </div>
        <div
            class="swiper-button-next absolute right-[-20px] md:right-[-40px] top-1/2 -translate-y-1/2 z-10 text-[#C6A75E] text-4xl opacity-80 hover:opacity-100 transition !bg-white/80 !rounded-full !w-12 !h-12 !flex !items-center !justify-center shadow-md">
        </div>

        <!-- Pagination -->
        <div class="swiper-pagination justify-center"></div>
    </div>
@else
    <div class="text-center text-gray-500 py-10 bg-gray-100 rounded-lg">
        Belum ada destinasi yang tersedia
    </div>
@endif
