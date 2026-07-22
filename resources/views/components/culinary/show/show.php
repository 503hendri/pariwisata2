<?php

use App\Models\Culinary;
use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.guest')] class extends Component
{
    public ?Culinary $culinary;

    public function mount($slug)
    {
        $this->culinary = Culinary::where('slug', $slug)->first();
    }
};