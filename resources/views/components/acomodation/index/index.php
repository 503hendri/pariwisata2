<?php

use App\Models\Accomodation;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts.guest')] class extends Component
{
    use WithPagination;
    
    public $sort = 'popular';
    public $search = '';
    
    #[Computed]
    public function accommodations()
    {
        $query = Accomodation::query();
        
        switch ($this->sort) {
            case 'popular':
                $query->orderBy('rating', 'desc');
                break;
            case 'price_low':
                $query->orderBy('price_range', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price_range', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
        }

        if (!empty($this->search)) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }
        
        return $query->paginate(10);
    }
};
