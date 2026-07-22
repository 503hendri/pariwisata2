<?php

use App\Models\Accomodation;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    #[Computed]
    public function accomodations()
    {
        // return array_map(function ($index) {
        //     return [
        //         'name' => "Hotel Grand $index",
        //         'images' => [
        //             'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2e/7a/04/e7/caption.jpg?w=1400&h=-1&s=1',
        //             'https://cf.bstatic.com/xdata/images/hotel/max1024x768/422139650.jpg?k=00823e95b9bff97a22a49c53e498f601ee37417926ffd5645914aa95756f94e5&o=',
        //             'https://cf.bstatic.com/xdata/images/hotel/max1024x768/380084306.jpg?k=f93ad1146e42c916660a6ac29c549fe8b6f1913b0782894c07db191e04af7753&o=',
        //         ],
        //         'price' => 500000 * $index,
        //         'rating' => 4.5 + ($index * 0.5),
        //         'reviews' => 120 + ($index * 10),
        //     ];
        // }, range(1, 4));
        return Accomodation::where('is_active', true)->orderBy('rating', 'desc')->take(4)->get();
    }
};
