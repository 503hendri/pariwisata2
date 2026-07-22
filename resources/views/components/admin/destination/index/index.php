<?php

use App\Models\Destination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public ?Destination $selectedDestination = null;

    #[Validate('image')]
    public $image = null;

    public $search = '';

    public $filter = '';

    public function updatedImage()
    {
        $this->validate();

        $image = $this->selectedDestination->images()->create([
            'url' => $this->image->store('destinations/'.$this->selectedDestination->id, 'public'),
        ]);

        Flux::toast(
            heading: 'Gambar destinasi berhasil diupdate',
            text: 'Gambar destinasi telah berhasil diupdate.',
            variant: 'success',
        );
    }

    #[Computed]
    public function destinations()
    {
        return Destination::where('name', 'like', '%'.$this->search.'%')->paginate(10);
    }

    public function deleteConfirmation($id)
    {
        $this->selectedDestination = Destination::find($id);
        if ($this->selectedDestination) {
            $this->modal('delete-destination')->show();
        }
    }

    public function delete()
    {
        if ($this->selectedDestination) {
            $this->selectedDestination->delete();
            $this->modal('delete-destination')->close();

            Flux::toast(
                heading: 'Destinasi berhasil dihapus',
                text: 'Destinasi telah berhasil dihapus.',
                variant: 'success',
            );
        }
    }

    public function deleteImage($id)
    {
        $image = $this->selectedDestination->images()->find($id);
        if ($image) {
            Storage::disk('public')->delete($image->url);
            $image->delete();

            Flux::toast(
                heading: 'Gambar destinasi berhasil dihapus',
                text: 'Gambar destinasi telah berhasil dihapus.',
                variant: 'success',
            );
        }
    }

    public function openGallery($id)
    {
        $this->selectedDestination = Destination::find($id);
        if ($this->selectedDestination) {
            $this->modal('gallery-destination')->show();
        }
    }

    public function togglePublish($id)
    {
        $destination = Destination::find($id);
        if ($destination) {
            $destination->is_published = ! $destination->is_published;
            $destination->save();

            Flux::toast(
                heading: 'Status destinasi berhasil diubah',
                text: 'Status destinasi telah berhasil diubah.',
                variant: 'success',
            );
        }
    }
};
