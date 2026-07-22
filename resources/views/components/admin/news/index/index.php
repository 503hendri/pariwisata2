<?php

use App\Models\News;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

new class extends Component
{
    use WithFileUploads;
    use WithPagination;

    public string $search = '';

    public ?News $selectedNews = null;

    #[Computed]
    public function news()
    {
        return News::where('title', 'like', '%' . $this->search . '%')->paginate(10);
    }

    public function confirmDelete()
    {
        $this->modal('news-delete-confirmation')->show();
    }

    public function delete()
    {
        if ($this->selectedNews) {
            $this->selectedNews->delete();
            $this->modal('news-delete-confirmation')->close();
            $this->selectedNews = null;

            Flux::toast(
                heading: 'Deleted',
                text: 'Berita telah berhasil dihapus.',
                variant: 'success',
            );
        }
    }

    public function togglePublish($id)
    {
        $news = News::find($id);
        if ($news) {
            $news->is_published = !$news->is_published;
            $news->save();

            Flux::toast(
                heading: 'Updated',
                text: 'Status publikasi berita telah diperbarui.',
                variant: 'success',
            );
        }
    }

    public function show($id)
    {
        $this->selectedNews = News::find($id);
        $this->modal('news-show')->show();
    }
};
