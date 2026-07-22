<div
    class="min-h-screen mt-20 relative overflow-hidden bg-white dark:bg-[#030712] transition-colors duration-500">

    <!-- BACKGROUND -->
    <div class="absolute inset-0 overflow-hidden">

        <!-- LIGHT -->
        <div
            class="absolute top-0 left-0 w-[500px] h-[500px] bg-blue-400/20 blur-[140px] rounded-full dark:hidden">
        </div>

        <div
            class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-cyan-400/20 blur-[140px] rounded-full dark:hidden">
        </div>

        <!-- DARK -->
        <div
            class="hidden dark:block absolute top-0 left-0 w-[500px] h-[500px] bg-cyan-500/10 blur-[140px] rounded-full">
        </div>

        <div
            class="hidden dark:block absolute bottom-0 right-0 w-[500px] h-[500px] bg-blue-600/10 blur-[140px] rounded-full">
        </div>

        <!-- GRID -->
        <div
            class="absolute inset-0 opacity-[0.04] dark:opacity-[0.06]"
            style="
                background-image:
                linear-gradient(to right, currentColor 1px, transparent 1px),
                linear-gradient(to bottom, currentColor 1px, transparent 1px);
                background-size: 60px 60px;">
        </div>

    </div>

    <div class="relative container mx-auto px-4 py-16">
        <!-- HERO -->
        <div
            class="grid lg:grid-cols-2 gap-16 items-center mb-2">

            <!-- LEFT -->
            <div>

                <h1
                    class="text-5xl md:text-5xl font-black leading-[1] tracking-tight text-slate-900 dark:text-white mb-8">

                    Berita terkini
                    <span
                        class="bg-gradient-to-r from-blue-600 via-cyan-500 to-indigo-500 dark:from-cyan-300 dark:via-blue-400 dark:to-indigo-500 bg-clip-text text-transparent">
                        Destinasi Wisata
                    </span>

                    Kota Sawahlunto
                </h1>

                <!-- <p
                    class="text-lg md:text-xl leading-relaxed text-slate-600 dark:text-slate-400 max-w-2xl mb-10">
                    Temukan berita terbaru seputar destinasi wisata di Kota Sawahlunto, mulai dari pembukaan tempat wisata baru, acara budaya, hingga tips perjalanan untuk menjelajahi keindahan kota ini.
                </p> -->

            </div>

            <!-- RIGHT -->
            <div class="relative">

                <div
                    class="absolute -inset-10 bg-gradient-to-r from-blue-500/20 to-cyan-500/20 dark:from-cyan-500/10 dark:to-blue-500/10 blur-[80px] rounded-full">
                </div>

                <div
                    class="relative rounded-[40px] overflow-hidden border border-slate-200 dark:border-white/10 bg-white/70 dark:bg-white/[0.03] backdrop-blur-2xl shadow-2xl">

                    @if ($this->news->first()?->image)

                    <img
                        src="{{ asset('storage/' . $this->news->first()->image) }}"
                        alt="{{ $this->news->first()->title }}"
                        class="w-full h-[500px] object-cover">

                    @endif

                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent">
                    </div>

                    <div
                        class="absolute bottom-0 left-0 right-0 p-8">

                        <div
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-cyan-400 text-black text-xs font-black uppercase tracking-wider mb-5">
                            Featured News
                        </div>

                        <h2
                            class="text-3xl md:text-4xl font-black text-white leading-tight mb-4">
                            {{ $this->news->first()?->title }}
                        </h2>

                        <p
                            class="text-slate-300 line-clamp-2 text-lg">
                            {{ Str::limit(strip_tags($this->news->first()?->content), 140) }}
                        </p>

                    </div>

                </div>
            </div>

        </div>

        <!-- NEWS GRID -->
        <div
            class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

            @foreach ($this->news as $item)

            <a
                href="{{ route('news.show', $item->slug) }}"
                wire:navigate
                class="group relative overflow-hidden rounded-[32px]
                border border-slate-200 dark:border-white/10
                bg-white/80 dark:bg-white/[0.03]
                backdrop-blur-2xl
                hover:-translate-y-3
                hover:shadow-[0_20px_80px_rgba(59,130,246,0.18)]
                dark:hover:shadow-[0_20px_80px_rgba(0,255,255,0.12)]
                transition-all duration-500">

                <!-- IMAGE -->
                <div class="relative overflow-hidden h-64">

                    @if ($item->image)

                    <img
                        src="{{ asset('storage/' . $item->image) }}"
                        alt="{{ $item->title }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

                    @else

                    <div
                        class="w-full h-full bg-gradient-to-br from-slate-200 to-slate-300 dark:from-slate-800 dark:to-slate-900 flex items-center justify-center">

                        <svg
                            class="w-16 h-16 text-slate-400 dark:text-slate-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16">
                            </path>

                        </svg>

                    </div>

                    @endif

                    <!-- OVERLAY -->
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent">
                    </div>

                    <!-- DATE -->
                    <div
                        class="absolute top-5 left-5">

                        <span
                            class="px-4 py-2 rounded-full bg-white/20 backdrop-blur-xl border border-white/20 text-white text-xs font-bold">

                            {{ $item->created_at?->format('d M Y') ?? 'N/A' }}

                        </span>
                    </div>

                </div>

                <!-- CONTENT -->
                <div class="p-7">

                    <!-- CATEGORY -->
                    <div
                        class="inline-flex items-center gap-2 text-sm font-bold uppercase tracking-[0.2em] text-blue-600 dark:text-cyan-300 mb-5">

                        <div
                            class="w-2 h-2 rounded-full bg-blue-600 dark:bg-cyan-300">
                        </div>

                        Travel News
                    </div>

                    <!-- TITLE -->
                    <h2
                        class="text-2xl font-black leading-snug text-slate-900 dark:text-white mb-4 line-clamp-2 group-hover:text-blue-600 dark:group-hover:text-cyan-300 transition-colors duration-300">

                        {{ $item->title }}

                    </h2>

                    <!-- DESC -->
                    <p
                        class="text-slate-600 dark:text-slate-400 leading-relaxed line-clamp-3 mb-8">

                        {{ Str::limit(strip_tags($item->content), 120) }}

                    </p>

                    <!-- FOOTER -->
                    <div
                        class="flex items-center justify-between pt-5 border-t border-slate-200 dark:border-white/10">

                        <div
                            class="inline-flex items-center gap-3 text-blue-600 dark:text-cyan-300 font-bold group-hover:gap-5 transition-all duration-300">

                            <span>Baca Artikel</span>

                            <svg
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2.5"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6">
                                </path>

                            </svg>

                        </div>

                        <div
                            class="w-12 h-12 rounded-2xl
                            bg-slate-100 dark:bg-white/5
                            border border-slate-200 dark:border-white/10
                            flex items-center justify-center
                            group-hover:bg-blue-600 dark:group-hover:bg-cyan-400
                            transition-all duration-300">

                            <svg
                                class="w-5 h-5 text-slate-500 dark:text-slate-300 group-hover:text-white dark:group-hover:text-black"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 4v16m8-8H4">
                                </path>

                            </svg>

                        </div>

                    </div>

                </div>

                <!-- HOVER GLOW -->
                <div
                    class="absolute inset-0 rounded-[32px]
                    border border-blue-500/0 dark:border-cyan-400/0
                    group-hover:border-blue-500/20 dark:group-hover:border-cyan-400/20
                    pointer-events-none transition-all duration-500">
                </div>

            </a>

            @endforeach
        </div>

        <!-- PAGINATION -->
        <div class="mt-24 flex justify-center">

            <div
                class="rounded-3xl border border-slate-200 dark:border-white/10 bg-white/70 dark:bg-white/5 backdrop-blur-2xl p-5 shadow-xl">

                {{ $this->news->links() }}

            </div>

        </div>

    </div>
</div>