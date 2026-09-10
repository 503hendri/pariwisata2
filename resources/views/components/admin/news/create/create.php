<?php

use App\Models\News;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public ?News $news = null;

    #[Validate('required')]
    public $title = '';

    public $slug = '';

    #[Validate('required')]
    public $content = '';

    public $image;

    public $imagePreview;

    public $is_published = false;

    #[Validate('nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120')]
    public $inlineImage;

    public $tagInput = '';

    public $selectedTags = [];

    public function updatedTagInput()
    {
        if ($this->tagInput && strlen($this->tagInput) >= 2) {
            $tag = Tag::firstOrCreate(['slug' => Str::slug($this->tagInput)], ['name' => $this->tagInput]);
            if (! in_array($tag->id, $this->selectedTags)) {
                $this->selectedTags[] = $tag->id;
            }
            $this->tagInput = '';
        }
    }

    public function removeTag($tagId)
    {
        $this->selectedTags = array_filter($this->selectedTags, fn ($id) => $id != $tagId);
    }

    public function mount($slug = null)
    {
        if ($slug) {
            $this->news = News::where('slug', $slug)->firstOrFail();
            $this->title = $this->news->title;
            $this->slug = $this->news->slug;
            $this->content = $this->news->content;
            $this->is_published = (bool) $this->news->is_published;
            $this->selectedTags = $this->news->tags->pluck('id')->toArray();

            if ($this->news->image) {
                $this->imagePreview = asset('storage/'.$this->news->image);
            }
        }
    }

    public function updatedImage()
    {
        $this->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($this->image instanceof TemporaryUploadedFile) {
            $this->imagePreview = $this->image->temporaryUrl();
        }
    }

    public function uploadInlineImage()
    {
        $this->validateOnly('inlineImage');

        $path = $this->inlineImage->store('news/content', 'public');
        $url = asset('storage/'.$path);

        $this->inlineImage = null;

        return $url;
    }

    public function submit()
    {
        if ($this->news) {
            $this->update();
        } else {
            $this->save();
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $baseSlug = Str::slug($this->title);
        $slug = $baseSlug;
        $counter = 1;
        while (News::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        $imagePath = null;
        if ($this->image instanceof TemporaryUploadedFile) {
            $imagePath = $this->image->store('news', 'public');
        }

        $news = News::create([
            'title' => $this->title,
            'slug' => $slug,
            'content' => $this->content,
            'image' => $imagePath,
            'is_published' => $this->is_published,
            'created_by' => auth()->user()->id,
        ]);

        if (! empty($this->selectedTags)) {
            $news->tags()->sync($this->selectedTags);
        }

        $this->redirect(route('admin.news'), navigate: true);

        Flux::toast(
            heading: $this->is_published ? 'Berita Dipublikasikan' : 'Berita Disimpan',
            text: $this->is_published
                ? 'Berita telah berhasil dipublikasikan.'
                : 'Berita telah berhasil disimpan sebagai draft.',
            variant: 'success',
        );
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable',
        ]);

        if ($this->image instanceof TemporaryUploadedFile) {
            $this->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        }

        $baseSlug = Str::slug($this->title);
        $slug = $baseSlug;
        $counter = 1;
        while (News::where('slug', $slug)->where('id', '!=', $this->news->id)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        $imagePath = $this->news->image;
        if ($this->image instanceof TemporaryUploadedFile) {
            if ($this->news->image && Storage::disk('public')->exists($this->news->image)) {
                Storage::disk('public')->delete($this->news->image);
            }
            $imagePath = $this->image->store('news', 'public');
        }

        $this->news->update([
            'title' => $this->title,
            'slug' => $slug,
            'content' => $this->content,
            'image' => $imagePath,
            'is_published' => $this->is_published,
        ]);

        $this->news->tags()->sync($this->selectedTags);

        $this->redirect(route('admin.news'), navigate: true);

        Flux::toast(
            heading: 'Berita Diperbarui',
            text: 'Berita telah berhasil diperbarui.',
            variant: 'success',
        );
    }
};
