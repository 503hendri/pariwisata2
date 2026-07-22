<?php

use App\Models\Culinary;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

new #[Layout('layouts.guest')] class extends Component
{
    public $search = '';
    public $type = '';
    
    #[Computed]
    public function culinaries()
    {
        return Culinary::where('name', 'like', '%' . $this->search . '%')->when($this->type, function($query) {
            return $query->where('type', $this->type);
        })->get();
    }

};