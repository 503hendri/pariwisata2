<div>
    <div class="flex items-center justify-between">
        <div class="space-y-1">
            <h1 class="text-2xl font-bold">Destinasi</h1>
            <p class="text-gray-500">Daftar destinasi wisata</p>
        </div>
        <flux:button href="{{ route('admin.destinations.create') }}" icon="plus" variant="primary" color="green"
            wire:navigate>
            Tambah Destinasi
        </flux:button>
    </div>

    <flux:separator class="my-4" />

    <div class="flex items-center justify-between gap-4 w-full md:w-1/2 md:flex-row flex-col">
        <flux:input wire:model.live.debounce.300ms="search" placeholder="Cari destinasi..." icon="magnifying-glass" />
        <flux:select wire:model.live.debounce.300ms="filter" placeholder="Filter" />
    </div>

    <!-- Table -->
    <div class="mt-4">
        <flux:table :paginate="$this->destinations">
            <flux:table.columns>
                <flux:table.column>#</flux:table.column>
                <flux:table.column>Nama</flux:table.column>
                <flux:table.column>Deskripsi</flux:table.column>
                <flux:table.column>Galeri</flux:table.column>
                @role('editor')
                    <flux:table.column>Publikasi</flux:table.column>
                @endrole
                <flux:table.column>Aksi</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @forelse ($this->destinations as $destination)
                    <flux:table.row wire:key="destination-{{ $destination->id }}">
                        <flux:table.cell>
                            {{ $this->destinations->firstItem() + $loop->index }}
                        </flux:table.cell>
                        <flux:table.cell>
                            <div class="flex items-center gap-3">
                                <flux:avatar
                                    :src="$destination->thumbnail ? Storage::url($destination->thumbnail) : asset('images/default-image.jpg')"
                                    size="lg" />
                                <div class="flex flex-col">
                                    {{ $destination->name }}
                                    <span class="text-xs text-gray-500 whitespace-normal">
                                        {{ $destination->address }}
                                    </span>
                                    <div class="flex items-center gap-2 mt-2">
                                        <flux:badge :color="$destination->is_popular ? 'blue' : 'gray'" size="sm">
                                            {{ $destination->is_popular ? 'Popular' : 'Non Popular' }}
                                        </flux:badge>
                                        <flux:badge :color="$destination->is_published ? 'green' : 'red'"
                                            size="sm">
                                            {{ $destination->is_published ? 'Published' : 'Draft' }}
                                        </flux:badge>
                                    </div>
                                </div>
                            </div>
                        </flux:table.cell>
                        <flux:table.cell class="whitespace-normal">
                            <span class="text-xs text-gray-500">
                                {{ Str::limit($destination->description, 150) }}
                            </span>
                        </flux:table.cell>
                        <flux:table.cell>
                            <div class="flex flex-col items-center">
                                <flux:button icon="photo" variant="ghost" color="blue"
                                    wire:click="openGallery({{ $destination->id }})">
                                    Galeri
                                </flux:button>
                                {{ $destination->images->count() }} foto
                            </div>
                        </flux:table.cell>
                        @role('editor')
                            <flux:table.cell>
                                @if ($destination->is_published)
                                    <flux:button wire:click="togglePublish({{ $destination->id }})" icon="check"
                                        variant="primary" color="green">
                                        Published
                                    </flux:button>
                                @else
                                    <flux:button wire:click="togglePublish({{ $destination->id }})" icon="x-mark"
                                        variant="primary" color="red">
                                        Draft
                                    </flux:button>
                                @endif
                            </flux:table.cell>
                        @endrole
                        <flux:table.cell>
                            @if (auth()->user()->hasRole('editor') || (auth()->user()->hasRole('admin') && !$destination->is_published))
                                <flux:dropdown>
                                    <flux:button icon="ellipsis-horizontal" variant="ghost" color="gray" />
                                    <flux:menu>
                                        <flux:menu.item
                                            href="{{ route('admin.destinations.create', $destination->id) }}"
                                            icon="pencil" color="blue" wire:navigate>
                                            Edit
                                        </flux:menu.item>
                                        <flux:menu.item wire:click="deleteConfirmation({{ $destination->id }})"
                                            icon="trash" variant="danger">
                                            Hapus
                                        </flux:menu.item>
                                    </flux:menu>
                                </flux:dropdown>
                            @else
                                <flux:badge color="gray" size="sm" icon="check" class="cursor-not-allowed">
                                    Sudah Publikasi
                                </flux:badge>
                            @endif
                        </flux:table.cell>
                    </flux:table.row>
                @empty
                    <flux:table.row wire:key="destination-empty">
                        <flux:table.cell colspan="4" class="text-center">Tidak ada data</flux:table.cell>
                    </flux:table.row>
                @endforelse
            </flux:table.rows>
        </flux:table>
    </div>

    <flux:modal name="delete-destination" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Hapus Destinasi</flux:heading>
                <flux:text class="mt-2">Apakah Anda yakin ingin menghapus destinasi ini?</flux:text>
            </div>
            <div class="flex justify-end gap-2">
                <flux:button variant="ghost" x-on:click="$flux.modal('delete-destination').close()">
                    Batal
                </flux:button>
                <flux:button variant="danger" wire:click="delete">
                    Ya, Hapus
                </flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="gallery-destination" class="w-full max-w-4xl">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Galeri Destinasi</flux:heading>
                <flux:text class="mt-2">Daftar gambar destinasi</flux:text>
            </div>
            @if ($selectedDestination && $selectedDestination->images->count() > 0)
                <div class="grid grid-cols-2 gap-4">
                    @foreach ($selectedDestination->images as $image)
                        <div class="border rounded-lg p-2">
                            <img src="{{ Storage::url($image->url) }}" alt="{{ $image->url }}"
                                class="w-full h-auto rounded">
                            <div class="mt-2 flex justify-end">
                                <flux:button wire:click="deleteImage({{ $image->id }})" icon="trash" variant="danger" size="sm">
                                    Hapus
                                </flux:button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-4">
                    <flux:text>Belum ada gambar untuk destinasi ini</flux:text>
                </div>
            @endif

            <div class="mt-4">
                <flux:input wire:model="image" label="Upload Gambar" type="file" accept="image/*" />
            </div>

            <flux:separator />

            <div class="flex justify-end gap-2">
                <flux:button variant="ghost" x-on:click="$flux.modal('gallery-destination').close()">
                    Tutup
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>
