<?php

use App\Models\Destination;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public ?Destination $destination = null;

    #[Validate('required')]
    public $name;

    #[Validate('required')]
    public $description;

    #[Validate('required|image')]
    public $thumbnail;

    public $thumbnailPreview;

    #[Validate('required|image')]
    public $cover;

    public $coverPreview;

    #[Validate('required|string|max:255')]
    public $address;

    #[Validate('required|string|max:255')]
    public $latitude;

    #[Validate('required|string|max:255')]
    public $longitude;

    #[Validate('required|numeric|min:0|max:5')]
    public $rating = 5;

    #[Validate('nullable|numeric|min:0')]
    public $entry_fee;
    
    #[Validate('nullable|numeric|min:0')]
    public $price_range_min;
    
    #[Validate('nullable|numeric|min:0')]
    public $price_range_max;

    #[Validate('nullable|string')]
    public $operating_hours;

    #[Validate('nullable|string')]
    public $phone;
    
    #[Validate('nullable|string')]
    public $website;
    
    #[Validate('nullable|string')]
    public $whatsapp;
    
    #[Validate('nullable|string')]
    public $instagram;

    #[Validate('nullable|string')]
    public $facebook;

    #[Validate('nullable|string')]
    public $tiktok;

    #[Validate('nullable|boolean')]
    public $is_popular = true;

    #[Validate('nullable|boolean')]
    public $is_published = false;

    public function updatedThumbnail()
    {
        $this->thumbnailPreview = $this->thumbnail->temporaryUrl();
    }

    public function updatedCover()
    {
        $this->coverPreview = $this->cover->temporaryUrl();
    }

    public function save()
    {
        $this->validate();

        $destination = Destination::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'thumbnail' => $this->thumbnail->store('destinations/thumbnails', 'public'),
            'cover' => $this->cover->store('destinations/covers', 'public'),
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'rating' => $this->rating,
            'entry_fee' => $this->entry_fee,
            'price_range_min' => $this->price_range_min,
            'price_range_max' => $this->price_range_max,
            'operating_hours' => $this->operating_hours,
            'phone' => $this->phone,
            'website' => $this->website,
            'whatsapp' => $this->whatsapp,
            'instagram' => $this->instagram,
            'facebook' => $this->facebook,
            'tiktok' => $this->tiktok,
            'is_popular' => $this->is_popular,
            'is_published' => $this->is_published,
        ]);

        $this->redirect(route('admin.destinations.index'), navigate: true);

        Flux::toast(
            heading: 'Destinasi berhasil dibuat',
            text: 'Destinasi telah berhasil dibuat.',
            variant: 'success',
        );
    }

    public function update()
    {
        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'rating' => $this->rating,
            'entry_fee' => $this->entry_fee,
            'price_range_min' => $this->price_range_min,
            'price_range_max' => $this->price_range_max,
            'operating_hours' => $this->operating_hours,
            'phone' => $this->phone,
            'website' => $this->website,
            'whatsapp' => $this->whatsapp,
            'instagram' => $this->instagram,
            'facebook' => $this->facebook,
            'tiktok' => $this->tiktok,
            'is_popular' => $this->is_popular,
            'is_published' => $this->is_published,
        ];

        // Thumbnail
        if ($this->thumbnail instanceof TemporaryUploadedFile) {
            $newThumbnail = $this->thumbnail->store('destinations/thumbnails', 'public');

            if ($this->destination->thumbnail && Storage::disk('public')->exists($this->destination->thumbnail)) {
                Storage::disk('public')->delete($this->destination->thumbnail);
            }

            $data['thumbnail'] = $newThumbnail;
        }

        // Cover
        if ($this->cover instanceof TemporaryUploadedFile) {
            $newCover = $this->cover->store('destinations/covers', 'public');

            if ($this->destination->cover && Storage::disk('public')->exists($this->destination->cover)) {
                Storage::disk('public')->delete($this->destination->cover);
            }

            $data['cover'] = $newCover;
        }

        $this->destination->update($data);

        $this->redirect(route('admin.destinations.index'), navigate: true);

        Flux::toast(
            heading: 'Destinasi berhasil diupdate',
            text: 'Destinasi telah berhasil diupdate.',
            variant: 'success',
        );
    }

    public function clear()
    {
        $this->reset();
    }

    public function mount($destinationId = null)
    {
        if ($destinationId) {
            $this->destination = Destination::find($destinationId);
            $this->fill($this->destination->toArray());
            $this->destination->thumbnail ? $this->thumbnailPreview = asset('storage/'.$this->destination->thumbnail) : null;
            $this->destination->cover ? $this->coverPreview = asset('storage/'.$this->destination->cover) : null;
        }
    }
};
