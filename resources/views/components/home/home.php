<?php

use App\Models\Culinary;
use App\Models\Destination;
use App\Models\Event;
use App\Models\Accomodation;
use App\Models\News;
use App\Models\WebsiteProfile;
use App\Services\WeatherService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public ?WebsiteProfile $websiteProfile = null;

    public string $heroImage = '';

    public $weather;

    public $weatherIcon;

    public $weatherCondition;

    public int $currentSlide = 0;

    #[Computed]
    public function destinations()
    {
        return Destination::where('is_published', 1)->where('is_popular', 1)->get();
    }

    #[Computed]
    public function events()
    {
        return Event::where('is_published', true)->where('date_start', '>=', now())->orderBy('date_start')->get();
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

    #[Computed]
    public function news()
    {
        return News::where('is_published', true)->latest()->limit(10)->get();
    }

    public function mount()
    {
        $this->websiteProfile = WebsiteProfile::first();
        $this->heroImage = Storage::disk('public')->exists('images/hero.jpg') ? Storage::disk('public')->url('images/hero.jpg') : 'https://picsum.photos/id/1015/1200/630';
        $this->weather = WeatherService::current();
        $this->weatherIcon = WeatherService::icon($this->weather['weathercode']);
        $this->weatherCondition = WeatherService::condition($this->weather['weathercode']);
    }

    public function viewDestination($slug)
    {
        return redirect()->route('destination.show', $slug);
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
};
