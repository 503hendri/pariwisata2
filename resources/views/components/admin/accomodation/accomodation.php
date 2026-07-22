<?php

use App\Models\Accomodation;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

new class extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $types = [
        'hotel',
        'resort',
        'guesthouse',
        'villa',
        'homestay',
        'campground',
        'other',
    ];

    public ?Accomodation $selectedAccomodation = null;

    public $search = '';

    #[Validate('required|string|max:100')]
    public $name = '';

    #[Validate('required|string|max:1000')]
    public $description = '';

    #[Validate('required|string|max:25')]
    public $type = '';

    #[Validate('required|string|max:255')]
    public $address = '';

    #[Validate('required|min:-90|max:90')]
    public $latitude = '';

    #[Validate('required|min:-180|max:180')]
    public $longitude = '';

    #[Validate('nullable|numeric')]
    public $price_range = '';

    #[Validate('nullable|string|max:20')]
    public $phone = '';

    #[Validate('nullable|string|max:20')]
    public $whatsapp = '';

    // #[Validate('nullable|url|max:255')]
    public $website = '';

    #[Validate('nullable|numeric|min:0|max:5')]
    public $rating = '';

    #[Validate('nullable|boolean')]
    public $is_featured = false;

    #[Validate('nullable|boolean')]
    public $is_active = false;

    // public $images = [];

    public $image = '';

    #[Computed]
    public function accomodations()
    {
        return Accomodation::latest()->when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })->paginate(10);
    }

    #[Computed]
    public function images()
    {
        return $this->selectedAccomodation?->images()->get();
    }

    public function confirmDelete($id)
    {
        $this->selectedAccomodation = Accomodation::find($id);
        $this->modal('confirm-delete')->show();
    }

    public function edit($id)
    {
        // dd($id);
        try {
            $this->selectedAccomodation = Accomodation::find($id);
            $this->name = $this->selectedAccomodation->name;
            $this->description = $this->selectedAccomodation->description;
            $this->type = $this->selectedAccomodation->type;
            $this->address = $this->selectedAccomodation->address;
            $this->latitude = $this->selectedAccomodation->latitude;
            $this->longitude = $this->selectedAccomodation->longitude;
            $this->price_range = $this->selectedAccomodation->price_range;
            $this->phone = $this->selectedAccomodation->phone;
            $this->whatsapp = $this->selectedAccomodation->whatsapp;
            $this->website = $this->selectedAccomodation->website;
            $this->rating = $this->selectedAccomodation->rating;
            $this->is_featured = $this->selectedAccomodation->is_featured;
            $this->is_active = $this->selectedAccomodation->is_active;
            $this->modal('create-accomodation')->show();
        } catch (Exception $e) {
            Flux::toast(
                heading: 'Error',
                text: 'Terjadi kesalahan: ' . $e->getMessage(),
                variant: 'error',
            );
        }
    }

    public function save()
    {
        $this->validate();

        try {
            Accomodation::create([
                'name' => $this->name,
                'slug' => str()->slug($this->name),
                'description' => $this->description,
                'type' => $this->type,
                'address' => $this->address,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'price_range' => $this->price_range,
                'phone' => $this->phone,
                'whatsapp' => $this->whatsapp,
                'website' => $this->website,
                'rating' => $this->rating,
                'is_featured' => $this->is_featured,
                'is_active' => $this->is_active,
            ]);

            Flux::toast(
                heading: 'Success',
                text: 'Accomodation created successfully',
                variant: 'success',
            );
        } catch (Exception $e) {
            Flux::toast(
                heading: 'Error',
                text: 'Failed to create accomodation: ' . $e->getMessage(),
                variant: 'error',
            );
        }

        $this->modal('create-accomodation')->close();
    }

    public function update()
    {
        $this->validate();

        try {
            Accomodation::find($this->selectedAccomodation->id)->update([
                'name' => $this->name,
                'slug' => str()->slug($this->name),
                'description' => $this->description,
                'type' => $this->type,
                'address' => $this->address,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'price_range' => $this->price_range,
                'phone' => $this->phone,
                'whatsapp' => $this->whatsapp,
                'website' => $this->website,
                'rating' => $this->rating,
                'is_featured' => $this->is_featured,
                'is_active' => $this->is_active,
            ]);

            Flux::toast(
                heading: 'Success',
                text: 'Accomodation updated successfully',
                variant: 'success',
            );
        } catch (Exception $e) {
            Flux::toast(
                heading: 'Error',
                text: 'Failed to update accomodation: ' . $e->getMessage(),
                variant: 'error',
            );
        }

        $this->modal('create-accomodation')->close();
    }

    public function delete()
    {
        try {
            $this->selectedAccomodation->delete();

            Flux::toast(
                heading: 'Success',
                text: 'Accomodation deleted successfully',
                variant: 'success',
            );
        } catch (Exception $e) {
            Flux::toast(
                heading: 'Error',
                text: 'Failed to delete accomodation',
                variant: 'error',
            );
        }

        $this->modal('confirm-delete')->close();
    }

    public function manageImages($id)
    {
        $this->selectedAccomodation = Accomodation::with('images')->find($id);

        $this->modal('manage-images')->show();
    }

    public function updatedImage()
    {
        $this->validate([
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $path = $this->image->store('accomodation-images', 'public');

            $this->selectedAccomodation->images()->create([
                'image' => $path,
            ]);

            Flux::toast(
                heading: 'Success',
                text: 'Image added successfully',
                variant: 'success',
            );
        } catch (Exception $e) {
            Flux::toast(
                heading: 'Error',
                text: 'Failed to add image',
                variant: 'error',
            );
        }
    }

    public function deleteImage($id)
    {
        try {
            $image = $this->selectedAccomodation->images()->find($id);
            $image->delete();

            Flux::toast(
                heading: 'Success',
                text: 'Image deleted successfully',
                variant: 'success',
            );
        } catch (Exception $e) {
            Flux::toast(
                heading: 'Error',
                text: 'Failed to delete image',
                variant: 'error',
            );
        }
    }

    public function resetForm()
    {
        $this->selectedAccomodation = null;
        $this->reset();
    }

    public function toggleStatus($id)
    {
        try {
            $accomodation = Accomodation::find($id);
            $accomodation->is_active = !$accomodation->is_active;
            $accomodation->save();

            Flux::toast(
                heading: 'Success',
                text: 'Status updated successfully',
                variant: 'success',
            );
        } catch (Exception $e) {
            Flux::toast(
                heading: 'Error',
                text: 'Failed to update status',
                variant: 'error',
            );
        }
    }
};
