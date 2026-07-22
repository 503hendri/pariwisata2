<?php

use App\Models\Destination;
use App\Models\Event;
use App\Models\Accomodation;
use App\Models\Culinary;
use Livewire\Component;
use Livewire\Attributes\Computed;

new class extends Component
{
    #[Computed]
    public function destinations(): int
    {
        return Destination::count();
    }

    #[Computed]
    public function events(): int
    {
        return Event::count();
    }

    #[Computed]
    public function culinary(): int
    {
        return Culinary::count();
    }

    #[Computed]
    public function accommodations(): int
    {
        return Accomodation::count();
    }
};