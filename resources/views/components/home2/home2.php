<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\WebsiteProfile;
use App\Models\Destination;
use App\Models\News;
use App\Models\Event;
use App\Models\Culinary;
use App\Models\Accomodation;
use App\Services\WeatherService;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;

new #[Layout('layouts.guest')]
class extends Component
{
    public int $currentSlide = 0;

    public $weather;

    public $weatherIcon;

    public $weatherCondition;

    public function mount()
    {
        $this->weather = WeatherService::current();
        $this->weatherIcon = WeatherService::icon($this->weather['weathercode']);
        $this->weatherCondition = WeatherService::condition($this->weather['weathercode']);
    }

    #[Computed]
    public function profile()
    {
        return WebsiteProfile::first();
    }

    #[Computed]
    public function coverSlides(): array
    {
        $slides = [];

        $profile = WebsiteProfile::first();

        if ($profile?->cover) {
            $slides[] = Storage::url($profile->cover);
        }

        $destinationCovers = Destination::whereNotNull('cover')
            ->orderBy('updated_at', 'desc')
            ->limit(4)
            ->pluck('cover')
            ->filter()
            ->all();

        foreach ($destinationCovers as $cover) {
            $url = Storage::url($cover);

            if (! in_array($url, $slides, true)) {
                $slides[] = $url;
            }
        }

        return array_values($slides);
    }

    public function nextSlide(): void
    {
        $slideCount = count($this->coverSlides());

        if ($slideCount < 2) {
            return;
        }

        $this->currentSlide = ($this->currentSlide + 1) % $slideCount;
    }

    public function prevSlide(): void
    {
        $slideCount = count($this->coverSlides());

        if ($slideCount < 2) {
            return;
        }

        $this->currentSlide = ($this->currentSlide - 1 + $slideCount) % $slideCount;
    }

    public function goToSlide(int $index): void
    {
        if (isset($this->coverSlides()[$index])) {
            $this->currentSlide = $index;
        }
    }

    #[Computed]
    public function destinations()
    {
        return Destination::where('is_published', 1)->where('is_popular', 1)->get();
    }

    #[Computed]
    public function news()
    {
        return News::where('is_published', true)->latest()->limit(10)->get();
    }

    #[Computed]
    public function events()
    {
        return Event::where('date_start', '>=', now())
            ->whereYear('date_start', now()->year)
            ->orderBy('date_start')
            ->get();
    }

    #[Computed]
    public function culinaries()
    {
        return Culinary::latest()->limit(3)->get();
    }

    #[Computed]
    public function accomodations()
    {
        return Accomodation::latest()->limit(3)->get();
    }

    public function viewDestination($slug = null)
    {
        return redirect()->route('destination.show', $slug);
    }
};
