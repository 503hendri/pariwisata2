<?php

use App\Models\Culinary;
use Flux\Flux;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

new class extends Component
{
    use WithFileUploads;
    use WithPagination;

    public ?Culinary $selectedCulinary = null;

    public $search = '';

    public $categoryFilter = '';

    public $categories = [
        'Makanan Berat',
        'Makanan Ringan',
        'Jajanan',
        'Minuman',
        'Kue Tradisional',
        'Makanan Modern',
        'Lainnya',
    ];

    #[Validate('required|string|max:255')]
    public $name = '';

    #[Validate('required|string|max:255')]
    public $category = '';

    #[Validate('required|numeric')]
    public $price = '';

    #[Validate('required|numeric')]
    public $rating = '';

    #[Validate('required|string')]
    public $description = '';

    #[Validate('nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048')]
    public $image = '';

    // #[Validate('required|boolean|in:0,1')]
    public $is_active = false;

    #[Computed]
    public function culinaries()
    {
        $query = Culinary::where('name', 'like', '%'.$this->search.'%');

        if ($this->categoryFilter) {
            $query->where('category', $this->categoryFilter);
        }

        return $query->paginate(10);
    }

    public function save()
    {
        $this->validate();

        $culinary = new Culinary;
        $culinary->name = $this->name;
        $culinary->slug = str()->slug($this->name);
        $culinary->category = $this->category;
        $culinary->price = $this->price;
        $culinary->rating = $this->rating;
        $culinary->description = $this->description;
        if ($this->image) {
            $culinary->image = $this->image->store('culinaries', 'public');
        }
        $culinary->is_active = $this->is_active;
        $culinary->save();

        Flux::toast(
            heading: 'Culinary saved successfully',
            text: 'The culinary has been saved.',
            variant: 'success',
        );

        $this->modal('create-culinary')->close();
    }

    public function edit($id)
    {
        $this->selectedCulinary = Culinary::find($id);
        $this->name = $this->selectedCulinary->name;
        $this->category = $this->selectedCulinary->category;
        $this->price = $this->selectedCulinary->price;
        $this->rating = $this->selectedCulinary->rating;
        $this->description = $this->selectedCulinary->description;
        $this->is_active = $this->selectedCulinary->is_active;
        $this->modal('create-culinary')->show();
    }

    public function update()
    {
        if ($this->image) {
            $this->validate();
        } else {
            $this->validate([
                'name' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'price' => 'required|numeric',
                'rating' => 'required|numeric',
                'description' => 'required|string',
                'is_active' => 'required|boolean|in:0,1',
            ]);
        }

        $this->selectedCulinary->name = $this->name;
        $this->selectedCulinary->slug = str()->slug($this->name);
        $this->selectedCulinary->category = $this->category;
        $this->selectedCulinary->price = $this->price;
        $this->selectedCulinary->rating = $this->rating;
        $this->selectedCulinary->description = $this->description;

        if ($this->image instanceof TemporaryUploadedFile) {
            $newImage = $this->image->store('culinaries', 'public');
            if ($this->selectedCulinary->image && Storage::disk('public')->exists($this->selectedCulinary->image)) {
                Storage::disk('public')->delete($this->selectedCulinary->image);
            }

            $this->selectedCulinary->image = $newImage;
        } else {
            $this->selectedCulinary->image = $this->image->store('culinaries', 'public');
        }

        $this->selectedCulinary->is_active = $this->is_active;
        $this->selectedCulinary->save();

        Flux::toast(
            heading: 'Culinary updated successfully',
            text: 'The culinary has been updated.',
            variant: 'success',
        );

        $this->modal('create-culinary')->close();
    }

    public function deleteConfirmation($id)
    {
        $this->selectedCulinary = Culinary::find($id);
        $this->modal('delete-culinary')->show();
    }

    public function delete()
    {
        $this->selectedCulinary->delete();

        Flux::toast(
            heading: 'Culinary deleted successfully',
            text: 'The culinary has been deleted.',
            variant: 'success',
        );

        $this->modal('delete-culinary')->close();
    }

    public function resetForm()
    {
        $this->reset();
        $this->resetValidation();
    }
};
