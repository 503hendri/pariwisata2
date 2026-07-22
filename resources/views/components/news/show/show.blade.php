<div class="relative bg-slate-50 dark:bg-slate-950 min-h-screen overflow-hidden py-20">
    <div class="container mx-auto px-4 py-20">
        <div class="max-w-5xl mx-auto">
            <section class="bg-white/90 dark:bg-slate-900/90 border border-slate-200 dark:border-slate-700 shadow-2xl rounded-[2rem] p-8 lg:p-12">
                <div class="mb-8 space-y-4">
                    <div class="flex items-center justify-between text-sm font-medium text-slate-500 dark:text-slate-400">
                        <span class="inline-flex items-center rounded-full bg-slate-100 text-slate-700 dark:text-slate-200 text-sm font-medium px-4 py-2 dark:bg-slate-800 dark:text-slate-200">Latest news</span>
                        <flux:button href="{{ route('news.index') }}" class="text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300" icon="arrow-left">
                            Kembali
                        </flux:button>
                    </div>
                    <h1 class="text-5xl font-semibold tracking-tight text-slate-900 dark:text-white">{{ $this->news->title }}</h1>
                    <p class="text-sm text-slate-500 dark:text-slate-400">{{ $this->news->created_at->format('F j, Y') }}</p>

                    @if ($this->news->image)
                    <img src="{{ asset('storage/' . $this->news->image) }}" alt="{{ $this->news->title }}" class="w-full rounded-lg mb-8">
                    @endif

                    <div class="prose prose-slate dark:prose-invert text-slate-600 dark:text-slate-300 max-w-none">
                        {!! nl2br(e($this->news->content)) !!}
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>