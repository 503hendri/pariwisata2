<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Models\News as NewsModel;

new #[Layout('layouts.guest')] class extends Component
{
    #[Computed]
    public function news()
    {
        return NewsModel::where('is_published', true)->latest()->paginate(6);
    }
};
