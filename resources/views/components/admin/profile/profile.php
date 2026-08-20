<?php

use App\Models\WebsiteProfile;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

new #[Layout('layouts.app')] class extends Component
{
    use WithFileUploads;
    
    public ?WebsiteProfile $profile = null;

    // Basic Information
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('nullable|string|max:255')]
    public string $tagline = '';

    #[Validate('nullable|string')]
    public string $description = '';

    // Media Assets
    #[Validate('nullable|image|max:2048')]
    public $logo;

    #[Validate('nullable|image|max:2048')]
    public $favicon;

    #[Validate('nullable|image|max:2048')]
    public $cover;

    // Contact Information
    #[Validate('nullable|string|max:50')]
    public string $phone = '';

    #[Validate('nullable|email|max:255')]
    public string $email = '';

    #[Validate('nullable|string')]
    public string $address = '';

    // Social Media
    #[Validate('nullable|string|max:255')]
    public string $instagram = '';

    #[Validate('nullable|string|max:255')]
    public string $youtube = '';

    #[Validate('nullable|string|max:255')]
    public string $facebook = '';

    #[Validate('nullable|string|max:255')]
    public string $tiktok = '';

    public function mount()
    {
        $this->profile = WebsiteProfile::first();

        if ($this->profile) {
            $this->name = $this->profile->name;
            $this->tagline = $this->profile->tagline ?? '';
            $this->description = $this->profile->description ?? '';
            $this->phone = $this->profile->phone ?? '';
            $this->email = $this->profile->email ?? '';
            $this->address = $this->profile->address ?? '';
            $this->instagram = $this->profile->instagram ?? '';
            $this->youtube = $this->profile->youtube ?? '';
            $this->facebook = $this->profile->facebook ?? '';
            $this->tiktok = $this->profile->tiktok ?? '';
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'tagline' => $this->tagline,
            'description' => $this->description,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'instagram' => $this->instagram,
            'youtube' => $this->youtube,
            'facebook' => $this->facebook,
            'tiktok' => $this->tiktok,
        ];

        // Handle file uploads if needed
        // TODO: Implement file upload logic for logo, favicon, cover
        if ($this->logo instanceof TemporaryUploadedFile) {
            $data['logo'] = $this->logo->store('website/logo', 'public');
        }

        if ($this->favicon instanceof TemporaryUploadedFile) {
            $data['favicon'] = $this->favicon->store('website/favicon', 'public');
        }

        if ($this->cover instanceof TemporaryUploadedFile) {
            $data['cover'] = $this->cover->store('website/cover', 'public');
        }

        if ($this->profile) {
            $this->profile->update($data);
        } else {
            WebsiteProfile::create($data);
        }

        Flux::toast(
            heading: 'Berhasil',
            text: 'Profile website telah berhasil diperbarui.',
            variant: 'success',
        );
    }

    public function resetForm()
    {
        $this->mount();
        Flux::toast(
            heading: 'Berhasil',
            text: 'Form telah direset ke data sebelumnya.',
            variant: 'info',
        );
    }
};
