<div>
    <div class="flex items-center justify-between">
        <div class="space-y-1">
            <h1 class="text-2xl font-bold">Berita</h1>
            <p class="text-gray-500">Daftar berita</p>
        </div>
        <flux:button href="{{ route('admin.news.create') }}" icon="plus" variant="primary" color="green" wire:navigate>
            Tambah Berita
        </flux:button>
    </div>

    <flux:separator class="my-4" />

    <div class="flex justify-end">
        <div class="w-1/3">
            <flux:input wire:model.live.debounce.300ms="search" placeholder="Cari berita..." icon="magnifying-glass" />
        </div>
    </div>

    <div class="mt-4">
        <flux:table :paginate="$this->news">
            <flux:table.columns class="bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100">
                <flux:table.column>
                    #
                </flux:table.column>
                <flux:table.column>
                    Judul
                </flux:table.column>
                <flux:table.column>
                    Tanggal
                </flux:table.column>
                <flux:table.column>
                    Isi Berita
                </flux:table.column>
                <flux:table.column>
                    Gambar
                </flux:table.column>
                <flux:table.column>
                    Dibuat Oleh
                </flux:table.column>
                <flux:table.column>
                    Publikasi
                </flux:table.column>
                <flux:table.column>
                    Aksi
                </flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @forelse ($this->news as $new)
                    <flux:table.row wire:key="news-{{ $new->id }}">
                        <flux:table.cell>
                            {{ $this->news->firstItem() + $loop->index }}
                        </flux:table.cell>
                        <flux:table.cell>
                            {{ $new->title }}
                        </flux:table.cell>
                        <flux:table.cell>
                            {{ $new->created_at }}
                        </flux:table.cell>
                        <flux:table.cell class="overflow-hidden whitespace-normal">
                            {{ Str::limit($new->content, 100) }}
                        </flux:table.cell>
                        <flux:table.cell>
                            <div class="w-16 h-16">
                                @if ($new->image)
                                    <img src="{{ asset('storage/' . $new->image) }}" alt="{{ $new->title }}"
                                        class="w-full h-full object-cover rounded">
                                @else
                                    <div class="w-full h-full bg-gray-200 rounded flex items-center justify-center">
                                        <flux:icon.photo class="w-8 h-8 text-gray-400" />
                                    </div>
                                @endif
                            </div>
                        </flux:table.cell>
                        <flux:table.cell>
                            {{ $new->creator->name }}
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:button :icon="$new->is_published ? 'check' : 'x-mark'"
                                :color="$new->is_published ? 'green' : 'red'" variant="primary" size="sm"
                                wire:click="togglePublish({{ $new->id }})">
                                {{ $new->is_published ? 'Publish' : 'Draft' }}
                            </flux:button>
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:button icon="magnifying-glass" variant="primary" color="blue"
                                wire:click="show({{ $new->id }})" />
                        </flux:table.cell>
                    </flux:table.row>
                @empty
                    <flux:table.row>
                        <flux:table.cell colspan="8" class="text-center py-4">
                            Tidak ada berita yang ditemukan.
                        </flux:table.cell>
                    </flux:table.row>
                @endforelse
            </flux:table.rows>
        </flux:table>
    </div>

    <flux:modal name="news-show" class="w-1/2 max-w-none" :dismissible="false">
        {{-- <p class="p-6">
            {{ Str::limit(\Faker\Factory::create()->realText(2000), 2000) }}
        </p> --}}

        <div class="p-6 overflow-y-auto max-h-[80vh]">
            <div class="space-y-2">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold">
                        {{ $this->selectedNews?->title }}
                    </h2>
                    <div class="flex items-center gap-2">
                        @if ($this->selectedNews?->is_published && auth()->user()->hasRole('admin'))
                            <flux:badge color="green" class="cursor-not-allowed
                            ">
                                <flux:icon.check class="w-4 h-4" />
                                Sudah Dipublikasikan
                            </flux:badge>
                        @else
                            <flux:button icon="pencil" variant="primary" color="blue" size="sm" tooltip="Edit"
                                href="{{ route('admin.news.create', ['slug' => $this->selectedNews?->slug]) }}"
                                wire:navigate />
                            <flux:button icon="trash" variant="primary" color="red" size="sm" tooltip="Delete"
                                wire:click="confirmDelete()" />
                        @endif
                    </div>
                </div>
                <div class="mt-2">
                    <flux:badge color="blue">
                        <flux:icon.user class="w-4 h-4" />
                        {{ $this->selectedNews?->creator->name }}
                    </flux:badge>
                    <flux:badge color="gray">
                        <flux:icon.calendar class="w-4 h-4" />
                        {{ $this->selectedNews?->created_at->format('d M Y H:i') }}
                    </flux:badge>
                </div>
            </div>
            @if ($this->selectedNews?->image)
                <div class="mt-4">
                    <img src="{{ asset('storage/' . $this->selectedNews?->image) }}"
                        alt="{{ $this->selectedNews?->title }}" class="w-full h-auto rounded">
                </div>
            @endif
            @if ($this->selectedNews?->content)
                <div class="mt-4">
                    {!! $this->selectedNews?->content !!}
                </div>
            @endif
        </div>
    </flux:modal>

    <flux:modal name="news-delete-confirmation" :dismissible="false">
        <div class="p-6">
            <h2 class="text-xl font-semibold mb-4">Konfirmasi Hapus</h2>
            <p>Apakah Anda yakin ingin menghapus berita ini?</p>
            <div class="mt-6 flex justify-end gap-2">
                <flux:button variant="outline" color="gray"
                    x-on:click="$flux.modal('news-delete-confirmation').close()">
                    Batal
                </flux:button>
                <flux:button variant="primary" color="red" wire:click="delete({{ $this->selectedNews?->id }})">
                    Hapus
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>
