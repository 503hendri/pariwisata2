<div class="min-h-screen bg-white dark:bg-zinc-950 mt-20">

    {{-- HERO --}}
    <section class="relative py-20 md:py-28 bg-[#1C1C1C] overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ Storage::url('images/hero.jpg') }}" alt=""
                 class="w-full h-full object-cover opacity-25"
                 onerror="this.style.display='none'">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#1C1C1C] via-[#1C1C1C]/70 to-[#1C1C1C]/40"></div>

        <div class="relative max-w-5xl mx-auto px-6 text-center">
            <div class="flex flex-col items-center">
                <span class="uppercase text-[#C6A75E] text-xs md:text-sm font-semibold tracking-[0.3em]">Destinasi</span>
                <div class="w-12 h-0.5 bg-[#C6A75E] mt-3"></div>
            </div>

            <h1 class="mt-6 heading-font text-4xl md:text-6xl font-bold text-white tracking-tight">
                Jelajahi Sawahlunto
            </h1>

            <p class="mt-4 text-base md:text-lg text-white/70 max-w-2xl mx-auto">
                Temukan destinasi wisata terbaik di kota warisan dunia
            </p>

            {{-- SEARCH --}}
            <div class="mt-10 max-w-xl mx-auto">
                <div class="flex items-center gap-2 bg-white dark:bg-zinc-900 rounded-full shadow-lg p-2 pl-5 border border-transparent focus-within:border-[#C6A75E] transition-colors">
                    <svg class="w-5 h-5 text-zinc-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                    </svg>
                    <input type="text" wire:model.live.debounce.400ms="search" placeholder="Cari destinasi wisata..."
                           class="flex-1 py-3 bg-transparent text-zinc-800 dark:text-white placeholder-zinc-400 outline-none">
                </div>
            </div>
        </div>
    </section>

    {{-- DESTINATION GRID --}}
    <section class="max-w-7xl mx-auto px-6 py-16 md:py-20">
        <div class="flex items-baseline justify-between gap-4 mb-8 md:mb-10">
            <p class="text-sm text-zinc-500 dark:text-zinc-400">
                Menampilkan
                <span class="font-semibold text-[#1C1C1C] dark:text-white">{{ $this->destination->total() }}</span>
                destinasi
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            @forelse($this->destination as $destination)
                @php
                    $price = $destination->entry_fee
                        ? 'IDR ' . number_format($destination->entry_fee / 1000, 0) . 'k'
                        : ($destination->price_range_min
                            ? 'Mulai IDR ' . number_format($destination->price_range_min / 1000, 0) . 'k'
                            : 'Gratis');
                    $url = route('destination.show', $destination->slug);
                @endphp

                <article class="group relative flex flex-col bg-white dark:bg-zinc-900 rounded-3xl border border-zinc-100 dark:border-zinc-800 hover:border-[#C6A75E]/40 transition-colors duration-300">
                    <a href="{{ $url }}" class="absolute inset-0 z-0 rounded-3xl" aria-label="Lihat detail {{ $destination->name }}"></a>

                    <div class="relative z-10 aspect-[4/3] overflow-hidden rounded-t-3xl pointer-events-none">
                        <img src="{{ asset('storage/' . $destination->cover) }}" alt="{{ $destination->name }}"
                             class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.03]"
                             onerror="this.onerror=null; this.src='{{ Storage::url('images/no-image.jpg') }}'">

                        <div class="absolute top-3 right-3 flex items-center gap-1 text-white text-xs font-semibold drop-shadow-[0_1px_3px_rgba(0,0,0,0.6)]">
                            <svg class="w-3.5 h-3.5 text-[#C6A75E]" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <span>{{ number_format((float) $destination->rating, 1) }}</span>
                            @if($destination->review_count > 0)
                                <span class="font-normal text-white/70">({{ $destination->review_count }})</span>
                            @endif
                        </div>
                    </div>

                    <div class="relative z-10 flex flex-col flex-grow p-5 md:p-6 pointer-events-none">
                        <div class="w-10 h-0.5 bg-[#C6A75E] rounded-full"></div>

                        <div class="mt-4 flex items-baseline justify-between gap-3">
                            <span class="text-[11px] font-semibold uppercase tracking-[0.22em] text-zinc-400">
                                {{ $destination->category?->name ?? 'Wisata' }}
                            </span>
                            <span class="text-sm font-bold text-[#1F4D3B] dark:text-[#C6A75E] whitespace-nowrap">{{ $price }}</span>
                        </div>

                        <h2 class="mt-2 heading-font text-xl font-bold text-[#1C1C1C] dark:text-white leading-snug line-clamp-2">
                            {{ $destination->name }}
                        </h2>

                        <p class="mt-3 text-sm text-zinc-500 dark:text-zinc-400 leading-relaxed line-clamp-2">
                            {{ \Illuminate\Support\Str::limit(strip_tags($destination->description ?? ''), 120) }}
                        </p>

                        @if($destination->address)
                            <p class="mt-4 text-xs text-zinc-400 dark:text-zinc-500 line-clamp-1">{{ $destination->address }}</p>
                        @endif

                        <div class="mt-auto pt-5 flex items-center justify-between gap-4 border-t border-zinc-100 dark:border-zinc-800 pointer-events-auto">
                            <a href="{{ $url }}" class="text-xs font-semibold text-[#1C1C1C] dark:text-white hover:text-[#C6A75E] transition-colors">
                                Lihat Detail
                            </a>

                            <span class="w-8 h-8 flex items-center justify-center rounded-full border border-zinc-200 dark:border-zinc-700 text-[#1C1C1C] dark:text-white group-hover:bg-[#C6A75E] group-hover:border-[#C6A75E] group-hover:text-white transition-colors duration-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </span>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full">
                    <x-ds.empty-state
                        title="Destinasi Tidak Ditemukan"
                        description="Coba gunakan kata kunci lain atau reset pencarian Anda."
                        icon="magnifying-glass"
                    />
                </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if($this->destination->hasPages())
            <div class="mt-16 flex justify-center">
                {{ $this->destination->links() }}
            </div>
        @endif
    </section>

</div>
