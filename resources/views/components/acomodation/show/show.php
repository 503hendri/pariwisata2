<?php

use App\Models\Accomodation;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public ?Accomodation $accommodation;

    public function mount($slug)
    {
        $this->accommodation = Accomodation::where('slug', $slug)->first();
    }
};
