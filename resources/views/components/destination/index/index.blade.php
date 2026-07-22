<div class="min-h-screen bg-gray-50 mt-20">

    {{-- HERO --}}
    <section class="relative py-24 overflow-hidden">

        <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-sky-500 opacity-90"></div>

        {{-- soft blur circle --}}
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>

        <div class="relative max-w-4xl mx-auto px-6 text-center text-white">

            <h1 class="text-4xl md:text-5xl font-bold tracking-tight mb-4">
                Explore Sawahlunto
            </h1>

            <p class="text-lg text-white/90 mb-10">
                Temukan destinasi wisata terbaik di kota warisan dunia
            </p>

            {{-- SEARCH --}}
            <div class="bg-white rounded-2xl shadow-xl flex items-center overflow-hidden">

                <input type="text" wire:model.live="search" placeholder="Cari destinasi wisata..."
                    class="flex-1 px-6 py-4 text-gray-700 outline-none">

                <button class="px-6 py-4 bg-indigo-600 text-white font-medium hover:bg-indigo-700 transition">

                    Cari

                </button>

            </div>

        </div>

    </section>



    {{-- DESTINATION GRID --}}
    <section class="max-w-7xl mx-auto px-6 py-16">

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">

            @forelse($this->destination as $destination)
                <a href="{{ route('destination.show', $destination->slug) }}" class="group">

                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition">

                        {{-- IMAGE --}}
                        <div class="relative h-60 overflow-hidden">

                            <img src="{{ asset('storage/' . $destination->cover) }}" alt="{{ $destination->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500">

                            {{-- PRICE --}}
                            <div class="absolute top-4 right-4">

                                <span
                                    class="px-3 py-1 text-xs font-semibold bg-white/90 backdrop-blur rounded-full shadow-sm">

                                    @if ($destination->entry_fee)
                                        Rp {{ number_format($destination->entry_fee, 0, ',', '.') }}
                                    @elseif ($destination->price_range_min)
                                        Mulai Rp {{ number_format($destination->price_range_min, 0, ',', '.') }}
                                    @else
                                        Gratis
                                    @endif

                                </span>

                            </div>

                        </div>


                        {{-- CONTENT --}}
                        <div class="p-6">

                            <div class="flex items-center justify-between mb-2">

                                <h2 class="text-lg font-semibold text-gray-900 group-hover:text-indigo-600 transition">

                                    {{ $destination->name }}

                                </h2>

                                <span class="text-xs text-gray-400">

                                    {{ $destination->category?->name }}

                                </span>

                            </div>


                            <p class="text-sm text-gray-500 line-clamp-2">

                                {{ Str::limit($destination->description, 120) }}

                            </p>


                            <div class="mt-4 text-sm text-indigo-600 font-medium group-hover:translate-x-1 transition">

                                Lihat detail →

                            </div>

                        </div>

                    </div>

                </a>

            @empty

                <div class="col-span-3 text-center py-24">

                    <div class="text-6xl mb-6">
                        🏝️
                    </div>

                    <h3 class="text-xl font-semibold text-gray-700 mb-2">
                        Destinasi tidak ditemukan
                    </h3>

                    <p class="text-gray-500">
                        Coba gunakan kata kunci lain
                    </p>

                </div>
            @endforelse

        </div>



        {{-- PAGINATION --}}
        <div class="mt-20 flex justify-center">

            <div class="bg-white px-6 py-3 rounded-xl shadow-sm">

                {{ $this->destination->links() }}

            </div>

        </div>

    </section>

</div>