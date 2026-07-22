<div class="space-y-4">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">Daftar Kuliner</h1>
            <span class="text-sm text-gray-500">Kelola data kuliner wisata</span>
        </div>
        <flux:modal.trigger name="create-culinary">
            <flux:button variant="primary" color="green" icon="plus">
                Tambah
            </flux:button>
        </flux:modal.trigger>
    </div>

    <flux:separator />

    <div class="flex items-center gap-2">
        <flux:input placeholder="Cari kuliner..." wire:model.live="search" />
        <flux:select placeholder="Filter kategori..." wire:model.live="categoryFilter">
            <flux:select.option value="">Semua Kategori</flux:select.option>
            @foreach ($categories as $category)
                <flux:select.option value="{{ $category }}">{{ $category }}</flux:select.option>
            @endforeach
        </flux:select>
    </div>
    <div>
        <flux:table :paginate="$this->culinaries">
            <flux:table.columns>
                <flux:table.column>No</flux:table.column>
                <flux:table.column>Nama</flux:table.column>
                <flux:table.column>Kategori</flux:table.column>
                <flux:table.column>Deskripsi</flux:table.column>
                <flux:table.column>Harga</flux:table.column>
                @role('editor')
                    <flux:table.column>Publikasi</flux:table.column>
                @endrole
                <flux:table.column>Aksi</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @forelse($this->culinaries as $culinary)
                    <flux:table.row>
                        <flux:table.cell>{{ $this->culinaries->firstItem() + $loop->index }}</flux:table.cell>
                        <flux:table.cell>
                            <div class="flex items-center gap-2">
                                <flux:avatar :src="asset('storage/' . $culinary->image)" />

                                <div class="flex flex-col">
                                    {{ $culinary->name }}
                                    <div class="flex items-center gap-1">
                                        @if ($culinary->rating)
                                            @for ($i = 0; $i < $culinary->rating; $i++)
                                                <flux:icon.star variant="solid" class="w-4 h-4 text-yellow-500" />
                                            @endfor
                                        @else
                                            -
                                        @endif
                                    </div>
                                </div>

                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:badge color="green" size="sm">{{ $culinary->category ?? 'Tidak Ada Kategori' }}
                            </flux:badge>
                        </flux:table.cell>
                        <flux:table.cell class="whitespace-normal">{{ $culinary->description }}</flux:table.cell>
                        <flux:table.cell>
                            {{ 'Rp ' . number_format($culinary->price, 0, ',', '.') }}
                        </flux:table.cell>
                        @role('editor')
                            <flux:table.cell>
                                <flux:button variant="ghost" color="{{ $culinary->is_active ? 'green' : 'gray' }}"
                                    wire:click="toggleStatus({{ $culinary->id }})">
                                    {{ $culinary->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </flux:button>
                            </flux:table.cell>
                        @endrole
                        <flux:table.cell>
                            @if (auth()->user()->hasRole('editor') || (auth()->user()->hasRole('admin') && !$culinary->is_active))
                                <flux:dropdown>
                                    <flux:button variant="primary" color="green" icon="ellipsis-horizontal" />
                                    <flux:menu>
                                        <flux:menu.item icon="pencil" wire:click="edit({{ $culinary->id }})">
                                            Edit
                                        </flux:menu.item>
                                        <flux:menu.item icon="trash"
                                            wire:click="deleteConfirmation({{ $culinary->id }})">
                                            Delete
                                        </flux:menu.item>
                                    </flux:menu>
                                </flux:dropdown>
                            @endif
                        </flux:table.cell>
                    </flux:table.row>
                @empty
                    <flux:table.row>
                        <flux:table.cell colspan="4" class="text-center">
                            Belum ada data kuliner
                        </flux:table.cell>
                    </flux:table.row>
                @endforelse
            </flux:table.rows>
        </flux:table>
    </div>

    <flux:modal name="create-culinary" class="w-1/2" variant="flyout" :dismissible="false" @close="resetForm()">
        <flux:heading size="lg">
            {{ $selectedCulinary ? 'Edit' : 'Tambah' }} Kuliner
        </flux:heading>
        <flux:separator class="my-4" />
        <form wire:submit="{{ $selectedCulinary ? 'update' : 'save' }}" class="space-y-4">
            <flux:input label="Nama" wire:model="name" />
            <flux:select label="Kategori" wire:model="category">
                <flux:select.option value="">Pilih kategori</flux:select.option>
                <flux:select.option value="Makanan Berat">Makanan Berat</flux:select.option>
                <flux:select.option value="Makanan Ringan">Makanan Ringan</flux:select.option>
                <flux:select.option value="Jajanan">Jajanan</flux:select.option>
                <flux:select.option value="Minuman">Minuman</flux:select.option>
                <flux:select.option value="Kue Tradisional">Kue Tradisional</flux:select.option>
                <flux:select.option value="Makanan Modern">Makanan Modern</flux:select.option>
                <flux:select.option value="Lainnya">Lainnya</flux:select.option>
            </flux:select>
            <flux:input label="Harga" wire:model="price" />
            <flux:input label="Rating" wire:model="rating" />
            <flux:textarea label="Deskripsi" wire:model="description" />
            <flux:input label="Gambar" wire:model="image" type="file" />
            {{-- <flux:checkbox label="Aktif" wire:model="is_active" /> --}}

            <flux:separator class="my-4" />

            <div class="flex justify-end">
                <flux:button type="submit" variant="primary" color="green" icon="save">
                    {{ $selectedCulinary ? 'Update' : 'Create' }}
                </flux:button>
            </div>
        </form>
    </flux:modal>

    <flux:modal name="delete-culinary" class="w-1/2">
        <flux:heading size="lg">
            Hapus Kuliner
        </flux:heading>

        <div class="mt-4">
            Apakah Anda yakin ingin menghapus kuliner ini?
        </div>

        <div class="mt-4 flex justify-end">
            <flux:button variant="ghost" wire:click="$dispatch('close-modal', 'delete-culinary')">
                Batal
            </flux:button>
            <flux:button variant="danger" wire:click="delete">
                Hapus
            </flux:button>
        </div>
    </flux:modal>
</div>
