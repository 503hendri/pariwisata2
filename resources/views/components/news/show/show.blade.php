<div class="min-h-screen bg-[#F8F6F1] dark:bg-[#1C1C1C] pb-20">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('news.index') }}" class="flex items-center gap-2 text-[#1C1C1C] dark:text-white hover:text-[#C6A75E] transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                <span class="font-medium">Kembali ke Berita</span>
            </a>
            <div class="flex items-center gap-3">
                <button onclick="window.print()" class="p-2 rounded-lg hover:bg-white/70 dark:hover:bg-white/5 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                </button>
            </div>
        </div>

        <article class="bg-white dark:bg-[#1F1F1F] rounded-2xl shadow-xl overflow-hidden">
            <!-- HERO SECTION -->
            <div class="relative">
                @if ($this->news->image)
                    <img src="{{ asset('storage/' . $this->news->image) }}" alt="{{ $this->news->title }}" class="w-full h-[400px] object-cover">
                @else
                    <div class="w-full h-[400px] bg-gradient-to-br from-[#C6A75E]/10 to-[#1C1C1C]/10 flex items-center justify-center">
                        <svg class="w-24 h-24 text-[#1C1C1C]/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                
                <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                    <div class="flex flex-wrap items-center gap-3 mb-4">
                        @foreach ($this->news->tags as $tag)
                            <span class="px-3 py-1 rounded-full bg-white/20 backdrop-blur-md border border-white/20 text-xs font-semibold uppercase tracking-wider">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                        @if ($this->news->tags->isEmpty())
                            <span class="px-3 py-1 rounded-full bg-[#C6A75E] text-[#1C1C1C] text-xs font-bold uppercase tracking-wider">
                                Berita
                            </span>
                        @endif
                    </div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold leading-tight mb-4">
                        {{ $this->news->title }}
                    </h1>
                    <div class="flex flex-wrap items-center gap-4 text-sm md:text-base text-white/90">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span>{{ $this->news->creator->name ?? 'Admin' }}</span>
                        </div>
                        <div class="w-1 h-1 bg-white/40 rounded-full"></div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ $this->news->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="w-1 h-1 bg-white/40 rounded-full"></div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ $this->readTime }} menit baca</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="p-6 md:p-10">
                <!-- SHARE BAR -->
                <div class="flex items-center gap-3 mb-8 pb-6 border-b border-gray-200 dark:border-white/10">
                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-300 mr-2">Bagikan:</span>
                    <a href="https://wa.me/?text={{ urlencode($this->news->title . ' ' . url()->current()) }}" target="_blank" class="w-10 h-10 rounded-lg bg-[#25D366] flex items-center justify-center text-white hover:bg-[#20bd5a] transition-colors" title="WhatsApp">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="w-10 h-10 rounded-lg bg-[#1877F2] flex items-center justify-center text-white hover:bg-[#166fe5] transition-colors" title="Facebook">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($this->news->title) }}" target="_blank" class="w-10 h-10 rounded-lg bg-black flex items-center justify-center text-white hover:bg-gray-800 transition-colors" title="X (Twitter)">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>
                    <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($this->news->title) }}" target="_blank" class="w-10 h-10 rounded-lg bg-[#0088cc] flex items-center justify-center text-white hover:bg-[#0077b5] transition-colors" title="Telegram">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                        </svg>
                    </a>
                    <button onclick="navigator.clipboard.writeText('{{ url()->current() }}')" class="w-10 h-10 rounded-lg bg-gray-200 dark:bg-white/10 flex items-center justify-center text-gray-700 dark:text-white hover:bg-gray-300 dark:hover:bg-white/20 transition-colors" title="Copy Link">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                        </svg>
                    </button>
                </div>

                <!-- AUTHOR BOX -->
                {{-- <div class="flex items-start gap-4 mb-8 p-6 bg-[#F8F6F1] dark:bg-[#262626] rounded-2xl">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-[#C6A75E] to-[#A68A4D] flex items-center justify-center text-white font-bold text-2xl flex-shrink-0">
                        {{ strtoupper(substr($this->news->creator->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-[#1C1C1C] dark:text-white mb-1">Ditulis oleh {{ $this->news->creator->name ?? 'Admin' }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ $this->news->created_at->diffForHumans() }}</p>
                        <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                            Penulis berita ini adalah bagian dari tim jurnalistik Sawahlunto Tourism yang berkomitmen menyajikan informasi terkini seputar destinasi wisata dan warisan budaya di Kota Sawahlunto.
                        </p>
                    </div>
                </div> --}}

                <!-- CONTENT TYPOGRAPHY -->
                <div class="prose prose-lg prose-slate dark:prose-invert max-w-none prose-headings:font-serif prose-headings:font-bold prose-p:font-serif prose-p:text-[#1C1C1C] dark:prose-p:text-[#E5E5E5] prose-a:text-[#1C1C1C] dark:prose-a:text-[#C6A75E] prose-a:underline hover:prose-a:text-[#C6A75E]">
                    {!! $this->news->content !!}
                </div>

                <!-- TAGS -->
                @if ($this->news->tags->isNotEmpty())
                    <div class="mt-10 pt-6 border-t border-gray-200 dark:border-white/10">
                        <h3 class="text-lg font-bold text-[#1C1C1C] dark:text-white mb-4">Topik Terkait:</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($this->news->tags as $tag)
                                <a href="#" class="px-4 py-2 rounded-lg bg-[#F8F6F1] dark:bg-[#262626] text-[#1C1C1C] dark:text-white text-sm font-medium hover:bg-[#C6A75E]/10 dark:hover:bg-[#C6A75E]/20 transition-colors">
                                    #{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </article>

        <!-- RELATED NEWS -->
        @if ($this->relatedNews->isNotEmpty())
            <div class="mt-16">
                <h2 class="text-3xl font-serif font-bold text-[#1C1C1C] dark:text-white mb-8 pb-4 border-b-2 border-[#C6A75E]">
                    Berita Terkait
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($this->relatedNews as $related)
                        <a href="{{ route('news.show', $related->slug) }}" class="group block">
                            <div class="overflow-hidden rounded-2xl mb-4">
                                @if ($related->image)
                                    <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-48 bg-gradient-to-br from-gray-200 to-gray-300 dark:from-slate-800 dark:to-slate-900 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-400 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <span class="text-xs font-bold uppercase tracking-wider text-[#C6A75E] mb-2 block">
                                {{ $related->created_at->format('M d, Y') }}
                            </span>
                            <h3 class="text-lg font-serif font-bold text-[#1C1C1C] dark:text-white leading-snug mb-2 group-hover:text-[#C6A75E] transition-colors">
                                {{ $related->title }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">
                                {{ Str::limit(strip_tags($related->content), 120) }}
                            </p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- PREV/NEXT NAVIGATION -->
        @if ($this->prevNews || $this->nextNews)
            <div class="mt-16 flex justify-between items-center bg-white dark:bg-[#1F1F1F] p-6 rounded-2xl shadow-lg">
                @if ($this->prevNews)
                    <a href="{{ route('news.show', $this->prevNews->slug) }}" class="flex items-center gap-3 group">
                        <svg class="w-6 h-6 text-[#C6A75E] transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        <div class="text-left">
                            <span class="block text-xs text-gray-500 dark:text-gray-400 uppercase">Sebelumnya</span>
                            <span class="text-sm font-bold text-[#1C1C1C] dark:text-white group-hover:text-[#C6A75E] transition-colors">{{ Str::limit($this->prevNews->title, 30) }}</span>
                        </div>
                    </a>
                @endif
                
                @if ($this->nextNews)
                    <a href="{{ route('news.show', $this->nextNews->slug) }}" class="flex items-center gap-3 ml-auto group text-right">
                        <div class="text-left">
                            <span class="block text-xs text-gray-500 dark:text-gray-400 uppercase">Selanjutnya</span>
                            <span class="text-sm font-bold text-[#1C1C1C] dark:text-white group-hover:text-[#C6A75E] transition-colors">{{ Str::limit($this->nextNews->title, 30) }}</span>
                        </div>
                        <svg class="w-6 h-6 text-[#C6A75E] transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @endif
            </div>
        @endif

        <!-- COMMENTS SECTION -->
        <div class="mt-16">
            <h2 class="text-3xl font-serif font-bold text-[#1C1C1C] dark:text-white mb-8 pb-4 border-b-2 border-[#C6A75E]">
                Komentar ({{ $this->approvedComments->count() }})
            </h2>

            <!-- COMMENT FORM -->
            <div class="bg-white dark:bg-[#1F1F1F] p-6 rounded-2xl shadow-lg mb-10">
                <h3 class="text-xl font-bold text-[#1C1C1C] dark:text-white mb-6">Tulis Komentar</h3>
                <form wire:submit="submitComment" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nama <span class="text-red-500">*</span></label>
                            <input type="text" wire:model="commentName" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-[#262626] text-[#1C1C1C] dark:text-white focus:ring-2 focus:ring-[#C6A75E] focus:border-transparent outline-none transition-all">
                            @error('commentName') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email <span class="text-red-500">*</span></label>
                            <input type="email" wire:model="commentEmail" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-[#262626] text-[#1C1C1C] dark:text-white focus:ring-2 focus:ring-[#C6A75E] focus:border-transparent outline-none transition-all">
                            @error('commentEmail') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Komentar <span class="text-red-500">*</span></label>
                        <textarea wire:model="commentContent" rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-[#262626] text-[#1C1C1C] dark:text-white focus:ring-2 focus:ring-[#C6A75E] focus:border-transparent outline-none transition-all resize-none"></textarea>
                        @error('commentContent') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="px-8 py-3 bg-[#1C1C1C] dark:bg-[#C6A75E] text-white dark:text-[#1C1C1C] rounded-xl font-bold hover:bg-[#262626] dark:hover:bg-[#D0A457] transition-all transform hover:scale-105 shadow-lg">
                        Kirim Komentar
                    </button>
                </form>
            </div>

            <!-- COMMENTS LIST -->
            <div class="space-y-6">
                @foreach ($this->approvedComments as $comment)
                    <div class="bg-white dark:bg-[#1F1F1F] p-6 rounded-2xl shadow-lg">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#C6A75E] to-[#A68A4D] flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                                {{ strtoupper(substr($comment->name ?? $comment->user->name, 0, 1)) }}
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="font-bold text-[#1C1C1C] dark:text-white">{{ $comment->name ?? $comment->user->name }}</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-3">{{ $comment->content }}</p>
                                @if ($comment->replies->isNotEmpty())
                                    <div class="ml-16 space-y-4">
                                        @foreach ($comment->replies as $reply)
                                            <div class="bg-gray-50 dark:bg-[#262626] p-4 rounded-xl">
                                                <div class="flex items-center gap-2 mb-1">
                                                    <span class="font-bold text-[#1C1C1C] dark:text-white text-sm">{{ $reply->name ?? $reply->user->name }}</span>
                                                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ $reply->created_at->diffForHumans() }}</span>
                                                </div>
                                                <p class="text-sm text-gray-700 dark:text-gray-300">{{ $reply->content }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('comment-submitted', function() {
                const toast = document.createElement('div');
                toast.className = 'fixed bottom-6 right-6 bg-[#1F4D3B] text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3 animate-fade-in-up z-50';
                toast.innerHTML = `
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span class="font-medium">Komentar berhasil dikirim! Akan muncul setelah diapprove admin.</span>
                `;
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 4000);
            });
        </script>
    @endpush
</div>
