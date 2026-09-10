<?php

use App\Models\Comment;
use App\Models\News;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public ?News $news;

    #[Validate('required|string|min:3')]
    public $commentName = '';

    #[Validate('required|email')]
    public $commentEmail = '';

    #[Validate('required|string|min:3|max:2000')]
    public $commentContent = '';

    public function mount($slug)
    {
        $this->news = News::with(['tags', 'creator'])->where('slug', $slug)->firstOrFail();

        if (! $this->news->is_published && ! auth()->check()) {
            abort(404);
        }

        if (auth()->check()) {
            $user = auth()->user();
            $this->commentName = $user->name;
            $this->commentEmail = $user->email;
        }
    }

    public function submitComment()
    {
        $this->validateOnly('commentName');
        $this->validateOnly('commentEmail');
        $this->validateOnly('commentContent');

        Comment::create([
            'news_id' => $this->news->id,
            'user_id' => auth()->id(),
            'name' => $this->commentName,
            'email' => $this->commentEmail,
            'content' => $this->commentContent,
        ]);

        $this->commentContent = '';

        $this->dispatch('comment-submitted');
    }

    #[Computed]
    public function relatedNews()
    {
        $tagIds = $this->news->tags->pluck('id');

        $related = News::with('creator')
            ->where('is_published', true)
            ->where('id', '!=', $this->news->id);

        if ($tagIds->isNotEmpty()) {
            $related->whereHas('tags', fn ($q) => $q->whereIn('tags.id', $tagIds));
        }

        $items = $related->latest()->take(3)->get();

        if ($items->count() < 3) {
            $fallback = News::with('creator')
                ->where('is_published', true)
                ->where('id', '!=', $this->news->id)
                ->whereNotIn('id', $items->pluck('id'))
                ->latest()
                ->take(3 - $items->count())
                ->get();

            $items = $items->concat($fallback);
        }

        return $items;
    }

    #[Computed]
    public function prevNews()
    {
        return News::where('is_published', true)
            ->where('id', '<', $this->news->id)
            ->latest('id')
            ->first();
    }

    #[Computed]
    public function nextNews()
    {
        return News::where('is_published', true)
            ->where('id', '>', $this->news->id)
            ->oldest('id')
            ->first();
    }

    #[Computed]
    public function readTime()
    {
        $words = str_word_count(strip_tags($this->news->content ?? ''));

        return max(1, (int) ceil($words / 200));
    }

    #[Computed]
    public function approvedComments()
    {
        return $this->news->approvedComments()->latest()->get();
    }
};
