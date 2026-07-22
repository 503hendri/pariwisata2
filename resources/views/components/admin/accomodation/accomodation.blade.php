<div class="space-y-4">
    <div class="flex justify-between items-center">
        <div class="space-y-1">
            <h1 class="text-2xl font-bold">Penginapan</h1>
            <p class="text-gray-500 text-sm">Data penginapan</p>
        </div>
        <div class="">
            <flux:modal.trigger name="create-accomodation">
                <flux:button variant="primary" icon="plus" color="green">
                    Tambah Penginapan
                </flux:button>
            </flux:modal.trigger>
        </div>
    </div>

    <flux:separator class="my-4" />

    <div class="flex flex-col sm:flex-row items-center justify-end gap-2">
        <flux:input placeholder="Cari penginapan..." wire:model.live.debounce.300ms="search" icon="magnifying-glass"
            class="w-1/3" />
    </div>

    <flux:table :paginate="$this->accomodations" class="border-0 shadow-lg">
        <flux:table.columns>
            <flux:table.column sortable class="w-12">No</flux:table.column>
            <flux:table.column sortable>Informasi Penginapan</flux:table.column>
            <flux:table.column sortable>Lokasi</flux:table.column>
            <flux:table.column sortable>Kontak</flux:table.column>
            <flux:table.column sortable>Rating</flux:table.column>
            <flux:table.column sortable>Status</flux:table.column>
            <flux:table.column sortable>Foto</flux:table.column>
            @role('editor')
                <flux:table.column>Publikasi</flux:table.column>
            @endrole
            <flux:table.column class="w-20">Aksi</flux:table.column>
        </flux:table.columns>
        <flux:table.rows>
            @forelse ($this->accomodations as $accomodation)
                <flux:table.row>
                    <!-- Nomor -->
                    <flux:table.cell class="text-center">
                        <span
                            class="inline-flex items-center justify-center w-8 h-8 bg-gray-100 dark:bg-gray-800 rounded-full text-sm font-medium text-gray-600 dark:text-gray-400">
                            {{ $this->accomodations->firstItem() + $loop->index }}
                        </span>
                    </flux:table.cell>

                    <!-- Informasi Penginapan -->
                    <flux:table.cell class="whitespace-normal">
                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <h4 class="font-semibold text-gray-900 dark:text-gray-100">{{ $accomodation->name }}
                                </h4>
                                <flux:badge :color="$accomodation->is_featured ? 'yellow' : 'blue'" size="sm"
                                    variant="outline">
                                    {{ $accomodation->is_featured ? 'Featured' : ucfirst($accomodation->type) }}
                                </flux:badge>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">
                                {{ Str::limit($accomodation->description, 100) }}
                            </p>
                        </div>
                    </flux:table.cell>

                    <!-- Lokasi -->
                    <flux:table.cell class="whitespace-normal">
                        <div class="space-y-1">
                            <div class="flex items-center gap-1 text-sm">
                                <flux:icon.map-pin variant="solid" color="red" class="w-3 h-3" />
                                <span class="text-gray-600 dark:text-gray-400">{{ $accomodation->address }}</span>
                            </div>
                            @if ($accomodation->price_range)
                                <div class="flex items-center gap-1 text-sm">
                                    <flux:icon.currency-dollar variant="solid" color="green" class="w-3 h-3" />
                                    <span
                                        class="text-gray-600 dark:text-gray-400">{{ $accomodation->price_range }}</span>
                                </div>
                            @endif
                        </div>
                    </flux:table.cell>

                    <!-- Kontak -->
                    <flux:table.cell>
                        <div class="space-y-1">
                            @if ($accomodation->phone)
                                <div class="flex items-center gap-1 text-sm">
                                    <flux:icon.phone variant="solid" color="blue" class="w-3 h-3" />
                                    <a href="tel:{{ $accomodation->phone }}" class="text-blue-600 hover:text-blue-700">
                                        {{ $accomodation->phone }}
                                    </a>
                                </div>
                            @endif
                            @if ($accomodation->whatsapp)
                                <div class="flex items-center gap-1 text-sm">
                                    <flux:icon.chat-bubble-left-right variant="solid" color="green" class="w-3 h-3" />
                                    <a href="https://wa.me/{{ str_replace(['+', '-', ''], '', $accomodation->whatsapp) }}"
                                        target="_blank" class="text-green-600 hover:text-green-700">
                                        {{ $accomodation->whatsapp }}
                                    </a>
                                </div>
                            @endif
                            @if ($accomodation->website)
                                <div class="flex items-center gap-1 text-sm">
                                    <flux:icon.globe-alt color="blue" class="w-3 h-3" />
                                    <a href="{{ $accomodation->website }}" target="_blank"
                                        class="text-blue-600 hover:text-blue-700 truncate max-w-[120px]">
                                        {{ parse_url($accomodation->website, PHP_URL_HOST) }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </flux:table.cell>

                    <!-- Rating -->
                    <flux:table.cell>
                        <div class="flex items-center gap-2">
                            @if ($accomodation->rating)
                                <div class="flex items-center gap-1">
                                    <flux:icon.star variant="solid" color="yellow" class="w-4 h-4" />
                                    <span class="font-medium">{{ number_format($accomodation->rating, 1) }}</span>
                                </div>
                            @else
                                <span class="text-sm text-gray-400">Belum ada rating</span>
                            @endif
                        </div>
                    </flux:table.cell>

                    <!-- Status -->
                    <flux:table.cell>
                        <div class="flex items-center gap-2">
                            <flux:badge :color="$accomodation->is_active ? 'green' : 'gray'" size="sm">
                                {{ $accomodation->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </flux:badge>
                            @if ($accomodation->is_featured)
                                <flux:badge color="yellow" size="sm" variant="outline">
                                    <flux:icon.star variant="solid" class="w-3 h-3" />
                                    Featured
                                </flux:badge>
                            @endif
                        </div>
                    </flux:table.cell>

                    <!-- Foto -->
                    <flux:table.cell>
                        <div class="flex items-center gap-2">
                            @if ($accomodation->images && count($accomodation->images) > 0)
                                <flux:badge color="blue" size="sm">
                                    {{ count($accomodation->images) }} foto
                                </flux:badge>
                            @else
                                <span class="text-sm text-gray-400">Tidak ada foto</span>
                            @endif
                        </div>
                    </flux:table.cell>

                    @role('editor')
                        <!-- Publikasi -->
                        <flux:table.cell>
                            <div class="flex items-center gap-2">
                                <flux:button variant="primary" color="{{ $accomodation->is_active ? 'green' : 'yellow' }}"
                                    icon="{{ $accomodation->is_active ? 'pencil' : 'x-mark' }}" size="sm"
                                    wire:click="toggleStatus({{ $accomodation->id }})">
                                    {{ $accomodation->is_active ? 'Published' : 'Draft' }}
                                </flux:button>
                            </div>
                        </flux:table.cell>
                    @endrole
                    <!-- Aksi -->
                    <flux:table.cell>
                        @if (auth()->user()->hasRole('editor') || (auth()->user()->hasRole('admin') && !$accomodation->is_active))
                            <div class="flex items-center gap-1">
                                {{-- <flux:button variant="ghost" size="sm" icon="eye" color="blue"
                                    wire:click="view({{ $accomodation->id }})" /> --}}
                                <flux:dropdown>
                                    <flux:button variant="ghost" size="sm" icon="ellipsis-vertical"
                                        color="gray" />
                                    <flux:menu>
                                        <flux:menu.item icon="pencil" wire:click="edit({{ $accomodation->id }})">
                                            Edit
                                        </flux:menu.item>
                                        <flux:menu.item icon="camera"
                                            wire:click="manageImages({{ $accomodation->id }})">
                                            Gambar
                                        </flux:menu.item>
                                        <flux:menu.item icon="trash"
                                            wire:click="confirmDelete({{ $accomodation->id }})" variant="danger">
                                            Hapus
                                        </flux:menu.item>
                                    </flux:menu>
                                </flux:dropdown>
                            </div>
                        @else
                            <flux:badge color="gray" size="sm" class="cursor-not-allowed">
                                Sudah dipublikasikan
                            </flux:badge>
                        @endif
                    </flux:table.cell>
                </flux:table.row>
            @empty
                <flux:table.row>
                    <flux:table.cell colspan="7">
                        <div class="text-center py-8">
                            <flux:icon.building-office-2 class="w-12 h-12 mx-auto text-gray-400 mb-3" />
                            <h3 class="text-lg font-medium text-gray-600 dark:text-gray-400 mb-2">
                                Belum Ada Data Penginapan
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-500 mb-4">
                                Mulai tambahkan penginapan pertama Anda untuk melihat data di sini.
                            </p>
                            <flux:modal.trigger name="create-accomodation">
                                <flux:button variant="primary" icon="plus" color="green">
                                    Tambah Penginapan
                                </flux:button>
                            </flux:modal.trigger>
                        </div>
                    </flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>

    <flux:modal name="create-accomodation" class="w-full md:w-1/2" variant="flyout" :dismissible="false"
        @close="$wire.resetForm()">
        <h2 class="text-lg font-semibold">
            {{ $this->selectedAccomodation ? 'Edit' : 'Tambah' }} Penginapan
        </h2>
        <flux:separator class="my-4" />
        <form wire:submit="{{ $this->selectedAccomodation ? 'update' : 'save' }}" class="space-y-4">
            <flux:input wire:model="name" label="Nama" placeholder="Nama penginapan" />
            <flux:textarea wire:model="description" label="Deskripsi" placeholder="Deskripsi penginapan" />
            <flux:select wire:model="type" label="Tipe" placeholder="Pilih tipe penginapan">
                @foreach ($types as $type)
                    <flux:select.option value="{{ $type }}">
                        {{ ucfirst($type) }}
                    </flux:select.option>
                @endforeach
            </flux:select>
            <flux:textarea wire:model="address" label="Alamat" placeholder="Alamat penginapan" />
            <div class="grid grid-cols-2 gap-4">
                <flux:input wire:model="latitude" label="Latitude" placeholder="Latitude" type="number"
                    step="0.000001" />
                <flux:input wire:model="longitude" label="Longitude" placeholder="Longitude" type="number"
                    step="0.000001" />
            </div>
            <flux:input wire:model="price_range" label="Range Harga" type="number" />
            <div class="grid grid-cols-2 gap-4">
                <flux:input wire:model="phone" label="Telepon" placeholder="Telepon" />
                <flux:input wire:model="whatsapp" label="Whatsapp" placeholder="Whatsapp" />
            </div>
            <flux:field>
                <flux:label>Website</flux:label>
                <flux:input.group>
                    <flux:input.group.prefix>
                        https://
                    </flux:input.group.prefix>
                    <flux:input wire:model="website" placeholder="example.com" />
                </flux:input.group>
            </flux:field>
            <div class="flex items-center gap-4">
                <flux:input wire:model="rating" label="Rating" placeholder="Rating" type="number"
                    step="0.1" />
                <flux:checkbox wire:model="is_featured" label="Featured" />
                {{-- <flux:checkbox wire:model="is_active" label="Active" /> --}}
            </div>
            <div class="flex justify-end gap-2">
                <flux:button type="button" variant="outline" color="gray"
                    x-on:click="$flux.modal('create-accomodation').close()">
                    Batal
                </flux:button>
                <flux:button type="submit" variant="primary" color="green" icon="save">
                    {{ $this->selectedAccomodation ? 'Update' : 'Simpan' }}
                </flux:button>
            </div>
        </form>
    </flux:modal>

    @if ($this->selectedAccomodation)
        <flux:modal name="manage-images" class="w-full max-w-4xl">
            <div class="space-y-6">
                <flux:heading size="lg" class="text-center">Kelola Gambar</flux:heading>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4" wire:loading.class="opacity-50"
                    wire:target="image">
                    @forelse ($this->images as $image)
                        <div class="relative">
                            <img src="{{ Storage::url($image->image) }}" alt="{{ $image->caption }}"
                                class="w-full h-48 object-cover rounded-lg">
                            <button wire:click="deleteImage({{ $image->id }})"
                                class="absolute top-2 right-2 p-2 bg-red-500 text-white rounded-full hover:bg-red-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    @empty
                        <div
                            class="border border-dashed border-gray-300 rounded-lg p-8 text-center col-span-2 text-gray-500">
                            <flux:icon.photo class="w-12 h-12 mx-auto mb-4 text-gray-400" />
                            Belum ada gambar
                        </div>
                    @endforelse
                </div>

                <flux:input type="file" label="Tambah Gambar" wire:model.live="image" accept="image/*" />
            </div>
        </flux:modal>
    @endif

    <flux:modal name="confirm-delete" class="w-full max-w-md" @close="resetForm()">
        <div class="space-y-6">
            <flux:heading size="lg" class="text-center">Konfirmasi Hapus</flux:heading>
            <p class="text-center">Apakah Anda yakin ingin menghapus akomodasi ini?</p>
            <div class="flex justify-end gap-2">
                <flux:button type="button" variant="outline" color="gray"
                    x-on:click="$flux.modal('confirm-delete').close()">
                    Batal
                </flux:button>
                <flux:button type="button" variant="primary" color="red" wire:click="delete()">
                    Hapus
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>
