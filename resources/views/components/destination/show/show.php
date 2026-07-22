<?php

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Destination;

new #[Layout('layouts.guest')]
class extends Component
{
    public $destination;

    public $nearby;

    public $rating = 5;

    public $comment = '';

    public function mount($slug)
    {
        $this->destination = Destination::where('slug', $slug)->first();
        if (!$this->destination) {
            return redirect()->route('destination.index');
        }
        $this->nearby = Destination::whereNotIn('id', [$this->destination->id])
            ->inRandomOrder()
            ->limit(5)
            ->get();
    }
};
