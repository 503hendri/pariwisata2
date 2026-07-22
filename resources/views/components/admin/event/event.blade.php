<div class="space-y-4">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">Event</h1>
            <span class="text-sm text-gray-500">Daftar event</span>
        </div>
        <flux:modal.trigger name="create-event">
            <flux:button wire:click="clearForm" variant="primary" icon="plus" color="green">
                Tambah Event
            </flux:button>
        </flux:modal.trigger>
    </div>

    <flux:separator class="my-4" />

    <div class="flex flex-col sm:flex-row items-center justify-end gap-2">
        <flux:input placeholder="Cari event..." wire:model="search" icon="magnifying-glass" />
        <flux:select wire:model="tahun">
            @foreach (range(date('Y'), 2010) as $item)
                <flux:select.option value="{{ $item }}">{{ $item }}</flux:select.option>
            @endforeach
        </flux:select>

    </div>

    <div>
        <flux:table :paginate="$this->events">
            <flux:table.columns>
                <flux:table.column>No</flux:table.column>
                <flux:table.column>Nama</flux:table.column>
                <flux:table.column>Deskripsi</flux:table.column>
                <flux:table.column>Tanggal</flux:table.column>
                <flux:table.column>Tiket</flux:table.column>
                <flux:table.column>Organizer</flux:table.column>
                @role('editor')
                    <flux:table.column>Publikasi</flux:table.column>
                @endrole
                <flux:table.column>Aksi</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @forelse ($this->events as $event)
                    <flux:table.row>
                        <flux:table.cell>{{ $this->events->firstItem() + $loop->index }}</flux:table.cell>
                        <flux:table.cell>
                            {{ $event->name }}
                            <div class="text-xs text-gray-500 flex items-center gap-1">
                                <flux:icon.map-pin class="w-3 h-3" variant="solid" color="red" />
                                {{ $event->location ? $event->location : '' }}
                            </div>
                        </flux:table.cell>
                        <flux:table.cell class="whitespace-normal">
                            {{ \Illuminate\Support\Str::limit($event->description, 50) }}
                        </flux:table.cell>
                        <flux:table.cell>
                            {{ \Carbon\Carbon::parse($event->date_start)->format('d/m/Y') }} -
                            {{ \Carbon\Carbon::parse($event->date_end)->format('d/m/Y') }}
                        </flux:table.cell>
                        <flux:table.cell>
                            {{ $event->ticket_price ? 'Rp ' . number_format($event->ticket_price, 0, ',', '.') : 'Gratis' }}
                        </flux:table.cell>
                        <flux:table.cell class="whitespace-normal">
                            {{ $event->organizer ? $event->organizer : '' }}
                        </flux:table.cell>
                        @role('editor')
                            <flux:table.cell>
                                @if ($event->is_published)
                                    <flux:button wire:click="togglePublish({{ $event->id }})" variant="primary"
                                        color="green" size="sm" icon="check">Published</flux:button>
                                @else
                                    <flux:button wire:click="togglePublish({{ $event->id }})" variant="danger"
                                        size="sm" icon="x-mark">Draft</flux:button>
                                @endif
                            </flux:table.cell>
                        @endrole
                        <flux:table.cell>
                            @if (auth()->user()->hasRole('editor') || (auth()->user()->hasRole('admin') && !$event->is_published))
                                <flux:dropdown>
                                    <flux:button variant="ghost" icon="ellipsis-horizontal" />
                                    <flux:menu>
                                        <flux:menu.item wire:click="edit({{ $event->id }})"
                                            class="flex items-center gap-2">
                                            <flux:icon.pencil class="w-4 h-4" />
                                            Edit
                                        </flux:menu.item>
                                        <flux:menu.item variant="danger"
                                            wire:click="deleteConfirm({{ $event->id }})"
                                            class="flex items-center gap-2">
                                            <flux:icon.trash class="w-4 h-4" />
                                            Delete
                                        </flux:menu.item>
                                    </flux:menu>
                                </flux:dropdown>
                            @endif
                        </flux:table.cell>
                    </flux:table.row>
                @empty
                    <flux:table.row>
                        <flux:table.cell colspan="4" class="text-center">Tidak ada data</flux:table.cell>
                    </flux:table.row>
                @endforelse
            </flux:table.rows>
        </flux:table>
    </div>


    <flux:modal name="create-event" class="w-1/2" variant="flyout" :dismissible="false" @close="clearForm()">
        <div class="space-y-6">
            <div>
                {{-- <pre>{{ $this->event }}</pre> --}}
                <flux:heading size="lg">
                    {{ $this->event ? 'Edit' : 'Tambah' }} Event
                </flux:heading>
                <flux:text class="mt-2">{{ $this->event ? 'Edit' : 'Tambah' }} event baru</flux:text>
            </div>

            <form wire:submit="{{ $this->event ? 'update' : 'save' }}" class="space-y-4">
                <flux:input label="Nama" wire:model="name" />
                <flux:textarea label="Deskripsi" wire:model="description" />
                <div class="grid grid-cols-2 gap-4">
                    <flux:input label="Tanggal Mulai" type="date" wire:model="date_start" />
                    <flux:input label="Tanggal Selesai" type="date" wire:model="date_end" />
                </div>
                <flux:input label="Lokasi" wire:model="location" />
                <div class="grid grid-cols-2 gap-4">
                    <flux:input label="Latitude" type="number" wire:model="latitude" />
                    <flux:input label="Longitude" type="number" wire:model="longitude" />
                </div>
                <flux:input label="Harga Tiket" type="number" wire:model="ticket_price" />
                <div class="flex flex-col space-y-2">
                    <div>
                        <flux:input label="Cover" wire:model="cover" type="file" accept="image/*" />
                    </div>
                    <div wire:loading.remove wire:target="cover">
                        @if ($cover && $cover instanceof \Illuminate\Http\UploadedFile)
                            <img src="{{ $cover->temporaryUrl() }}" alt="Cover" class="w-24 h-24 object-cover">
                        @elseif($event && $event->cover)
                            <img src="{{ asset('storage/' . $event->cover) }}" alt="Cover"
                                class="w-24 h-24 object-cover">
                        @endif
                    </div>
                </div>
                <flux:input label="Penyelenggara" wire:model="organizer" />
                <flux:input label="No. Telepon" wire:model="contact_phone" />
                <flux:input label="Website" wire:model="website" />

                <div class="flex justify-end">
                    <flux:button type="submit" variant="primary" color="green" icon="save">
                        {{ $this->event ? 'Update' : 'Simpan' }}
                    </flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    <flux:modal name="delete-event" class="w-1/2">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">
                    Hapus Event
                </flux:heading>
                <flux:text class="mt-2">Apakah Anda yakin ingin menghapus event ini?</flux:text>
            </div>

            <div class="flex justify-end">
                <flux:button type="button" variant="primary" color="red" icon="trash" wire:click="delete">
                    Hapus
                </flux:button>
            </div>
        </div>
    </flux:modal>

</div>
