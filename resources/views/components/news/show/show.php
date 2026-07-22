<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\News;

new #[Layout('layouts.guest')] class extends Component
{
    public ?News $news;

    public function mount($slug)
    {
        $this->news = News::where('slug', $slug)->firstOrFail();
    }
};
