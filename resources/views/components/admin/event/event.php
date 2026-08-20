<?php

use App\Models\Event;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

new class extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $search = '';

    public $tahun = '';

    public ?Event $event = null;

    #[Validate('required|string|max:255')]
    public $name = '';

    #[Validate('nullable|string')]
    public $description = '';

    #[Validate('required|date|date_format:Y-m-d|before_or_equal:date_end|required_with:date_end')]
    public $date_start = null;

    #[Validate('required|date|date_format:Y-m-d|after_or_equal:date_start|required_with:date_start')]
    public $date_end = null;

    // #[Validate('nullable|date_format:H:i')]
    // public $time_start = '';

    // #[Validate('nullable|date_format:H:i|after_or_equal:time_start')]
    // public $time_end = '';

    #[Validate('required|string')]
    public $location = '';

    #[Validate('nullable|numeric|min:-90|max:90')]
    public $latitude = 0;

    #[Validate('nullable|numeric|min:-180|max:180')]
    public $longitude = 0;

    #[Validate('nullable|numeric|min:0')]
    public $ticket_price = '';

    #[Validate('nullable|image|max:20480')]
    public $cover = '';

    #[Validate('nullable|string')]
    public $organizer = '';

    #[Validate('nullable|string')]
    public $contact_phone = '';

    #[Validate('nullable|string')]
    public $website = '';

    #[Computed]
    public function events()
    {
        return Event::where('name', 'like', '%'.$this->search.'%')
            ->when($this->tahun, function ($query) {
                $query->whereYear('date_start', $this->tahun);
            })
            ->paginate(10);
    }

    public function save()
    {
        $this->validate();

        Event::create([
            'name' => $this->name,
            'slug' => str()->slug($this->name),
            'description' => $this->description,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'time_start' => '00:00:00',
            'time_end' => '00:00:00',
            'location' => $this->location,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'ticket_price' => $this->ticket_price,
            'is_free' => $this->ticket_price == 0 ? true : false,
            'cover' => $this->cover ? $this->cover->store('events', 'public') : null,
            'organizer' => $this->organizer,
            'contact_phone' => $this->contact_phone,
            'website' => $this->website,
        ]);

        $this->modal('create-event')->close();

        Flux::toast(
            heading: 'Berhasil',
            text: 'Event berhasil ditambahkan',
            variant: 'success',
        );
    }

    public function update()
    {
        $this->validate();
        
        $this->event->update([
            'name' => $this->name,
            'slug' => str()->slug($this->name),
            'description' => $this->description,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'time_start' => '00:00:00',
            'time_end' => '00:00:00',
            'location' => $this->location,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'ticket_price' => $this->ticket_price,
            'is_free' => $this->ticket_price == 0 ? true : false,
            'cover' => $this->cover ? $this->cover->store('events', 'public') : $this->event->cover,
            'organizer' => $this->organizer,
            'contact_phone' => $this->contact_phone,
            'website' => $this->website,
        ]);

        $this->modal('create-event')->close();

        Flux::toast(
            heading: 'Berhasil',
            text: 'Event berhasil diupdate',
            variant: 'success',
        );
    }

    public function delete()
    {
        $this->event->delete();

        $this->modal('delete-event')->close();

        Flux::toast(
            heading: 'Berhasil',
            text: 'Event berhasil dihapus',
            variant: 'success',
        );
    }

    public function edit($id)
    {
        $this->event = Event::find($id);
        $this->event_id = $this->event->id;
        $this->name = $this->event->name;
        $this->description = $this->event->description;
        $this->date_start = $this->event->date_start;
        $this->date_end = $this->event->date_end;
        $this->location = $this->event->location;
        $this->latitude = $this->event->latitude;
        $this->longitude = $this->event->longitude;
        $this->ticket_price = $this->event->ticket_price;
        $this->cover = $this->event->cover;
        $this->organizer = $this->event->organizer;
        $this->contact_phone = $this->event->contact_phone;
        $this->website = $this->event->website;
        $this->modal('create-event')->show();
    }

    public function deleteConfirm($id)
    {
        $this->event = Event::find($id);
        $this->modal('delete-event')->show();
    }

    public function clearForm()
    {
        $this->reset([
            'event',
            'name',
            'description',
            'date_start',
            'date_end',
            'location',
            'latitude',
            'longitude',
            'ticket_price',
            'cover',
            'organizer',
            'contact_phone',
            'website',
        ]);
    }

    public function togglePublish($id)
    {
        $event = Event::find($id);
        $event->is_published = !$event->is_published;
        $event->save();

        Flux::toast(
            heading: 'Berhasil',
            text: 'Status publikasi event berhasil diubah',
            variant: 'success',
        );
    }
};
