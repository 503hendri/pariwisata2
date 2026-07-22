<?php

use App\Models\News;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    #[Validate('required')]
    public $title;

    #[Validate('required|string|max:255|unique:news,slug')]
    public $slug;

    #[Validate('required')]
    public $content;

    #[Validate('nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048')]
    public $image;

    public $imagePreview;

    public function updatedImage()
    {
        $this->imagePreview = $this->image->temporaryUrl();
    }

    public function save()
    {
        $this->slug = Str::slug($this->title);

        $this->validate();

        $news = News::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'image' => $this->image ? $this->image->store('news', 'public') : null,
            'is_published' => false,
            'created_by' => auth()->user()->id,
        ]);

        $this->redirect(route('admin.news'), navigate: true);

        Flux::toast(
            heading: 'Success',
            text: 'Berita telah berhasil dibuat.',
            variant: 'success',
        );
    }
};
