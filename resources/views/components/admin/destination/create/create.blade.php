<div>
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">
            @if ($destination)
                Edit Destinasi
            @else
                Tambah Destinasi
            @endif
        </h1>
        <flux:button href="{{ route('admin.destinations.index') }}" icon="arrow-left" variant="primary" color="blue"
            wire:navigate>
            Kembali
        </flux:button>
    </div>

    <flux:separator class="my-4" />

    <form wire:submit="{{ $destination ? 'update' : 'save' }}" class="space-y-6">
        <!-- Informasi Dasar -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Informasi Dasar
            </h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <flux:input label="Nama Destinasi" wire:model="name" required />
                <flux:textarea label="Deskripsi" wire:model="description" required class="lg:col-span-2" />
            </div>
        </div>

        <!-- Galeri -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                Galeri
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Thumbnail Upload -->
                <div class="space-y-2">
                    <flux:input label="Thumbnail" wire:model="thumbnail" type="file" accept="image/*" />
                    <div class="relative group">
                        <div
                            class="w-full h-full aspect-video rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 overflow-hidden bg-gray-50 dark:bg-gray-800 transition-all duration-200 group-hover:border-blue-400 group-hover:bg-blue-50 dark:group-hover:bg-blue-900/20">
                            @if ($thumbnailPreview)
                                <img src="{{ $thumbnailPreview }}" alt="Thumbnail Preview"
                                    class="w-full h-full object-cover transition-transform duration-200 group-hover:scale-105">
                            @else
                                <div
                                    class="w-full h-full flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                                    <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="text-sm">Thumbnail Preview</span>
                                </div>
                            @endif

                            <div wire:loading wire:target="thumbnail">
                                <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                                    <svg class="animate-spin h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div
                            class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <span class="bg-black/70 text-white text-xs px-2 py-1 rounded">
                                {{ $thumbnailPreview ? 'Update' : 'Upload' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Cover Upload -->
                <div class="space-y-2">
                    <flux:input label="Cover" wire:model="cover" type="file" accept="image/*" />
                    <div class="relative group">
                        <div
                            class="w-full h-full aspect-video rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 overflow-hidden bg-gray-50 dark:bg-gray-800 transition-all duration-200 group-hover:border-green-400 group-hover:bg-green-50 dark:group-hover:bg-green-900/20">
                            @if ($coverPreview)
                                <img src="{{ $coverPreview }}" alt="Cover Preview"
                                    class="w-full h-full object-cover transition-transform duration-200 group-hover:scale-105">
                            @else
                                <div
                                    class="w-full h-full flex flex-col items-center justify-center text-gray-400 dark:text-gray-500">
                                    <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="text-sm">Cover Preview</span>
                                </div>
                            @endif
                        </div>
                        <div
                            class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <span class="bg-black/70 text-white text-xs px-2 py-1 rounded">
                                {{ $coverPreview ? 'Update' : 'Upload' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lokasi -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Lokasi
            </h3>
            <flux:input label="Alamat" wire:model="address" />
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:input label="Latitude" wire:model="latitude" />
                <flux:input label="Longitude" wire:model="longitude" />
            </div>
        </div>

        <!-- Statistik & Harga -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                    </path>
                </svg>
                Statistik & Harga
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <flux:input label="Rating" wire:model="rating" type="number" step="0.01" min="0"
                    max="5" />
                {{-- <flux:input label="Jumlah Review" wire:model="review_count" type="number" min="0" />
                <flux:input label="Jumlah View" wire:model="view_count" type="number" min="0" /> --}}
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <flux:input label="Biaya Masuk" wire:model="entry_fee" type="number" step="0.01"
                    min="0" />
                <flux:input label="Harga Min" wire:model="price_range_min" type="number" step="0.01"
                    min="0" />
                <flux:input label="Harga Max" wire:model="price_range_max" type="number" step="0.01"
                    min="0" />
            </div>
        </div>

        <!-- Kontak & Media Sosial -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                    </path>
                </svg>
                Kontak & Media Sosial
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <flux:input label="Telepon" wire:model="phone" />
                <flux:input label="WhatsApp" wire:model="whatsapp" />
                <flux:input label="Website" wire:model="website" />
                <flux:input label="Instagram" wire:model="instagram" />
                <flux:input label="Facebook" wire:model="facebook" />
                <flux:input label="Tiktok" wire:model="tiktok" />
            </div>
        </div>

        <!-- Pengaturan Tambahan -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                    </path>
                </svg>
                Pengaturan Tambahan
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
                <flux:textarea rows="4" label="Jam Operasional" wire:model="operating_hours"
                    placeholder="Contoh: Senin: 08:00-17:00" />
                <div class="flex flex-col gap-4">
                    <flux:checkbox label="Populer" wire:model="is_popular" />
                    @role('editor')
                        <flux:checkbox label="Publikasi" wire:model="is_published" />
                    @endrole
                </div>
            </div>
        </div>

        <!-- SEO Meta -->
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                    </path>
                </svg>
                SEO Meta
            </h3>
            <div class="grid grid-cols-1 gap-4">
                <flux:input label="Judul Meta" wire:model="meta_title" placeholder="Judul untuk SEO" />
                <flux:input label="Deskripsi Meta" wire:model="meta_description" placeholder="Deskripsi untuk SEO" />
                <flux:input label="Tags Meta" wire:model="meta_tags" placeholder="Tag1, Tag2, Tag3" />
            </div>
        </div>

        <flux:separator class="my-6" />

        <div class="flex items-center justify-between gap-2">
            <flux:button href="{{ route('admin.destinations.index') }}" variant="outline" color="gray"
                icon="x-mark" wire:navigate>
                Batal
            </flux:button>
            <flux:button type="submit" variant="primary" color="green" icon="save">
                @if ($destination)
                    Update
                @else
                    Simpan
                @endif
            </flux:button>
        </div>
    </form>
</div>
