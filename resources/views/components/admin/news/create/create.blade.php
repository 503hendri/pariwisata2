<div class="space-y-4">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">Berita</h1>
            <span class="text-sm text-gray-500 dark:text-gray-400">Tambah berita</span>
        </div>
    </div>

    <flux:separator class="my-4" />

    <form wire:submit="save">
        <div class="grid grid-cols-3 md:grid-cols-2 gap-4">
            <flux:input class="" label="Judul" placeholder="Judul" wire:model.live.debounce.300ms="title" />
            <div class="col-span-3">
                <flux:textarea label="Isi" placeholder="Isi" rows="5" wire:model="content" />
            </div>
            <div class="space-y-2">
                <flux:input label="Gambar" type="file" accept="image/*" wire:model="image" />
                <div class="relative group">
                    <div
                        class="w-full h-full aspect-video rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-600 overflow-hidden bg-gray-50 dark:bg-gray-800 transition-all duration-200 group-hover:border-blue-400 group-hover:bg-blue-50 dark:group-hover:bg-blue-900/20">
                        @if ($imagePreview)
                            <img src="{{ $imagePreview }}" alt="Preview"
                                class="w-full h-full object-cover transition-transform duration-200 group-hover:scale-105" />
                        @else
                            <div class="flex items-center justify-center h-full">
                                <flux:icon.camera class="w-8 h-8 text-gray-400 dark:text-gray-500" />
                            </div>
                        @endif
                        <div wire:loading.flex wire:target="image"
                            class="absolute inset-0 flex items-center justify-center bg-black/20 backdrop-blur-sm">
                            <div class="flex items-center justify-center gap-2">
                                <flux:icon.loading class="w-6 h-6 text-white animate-spin" />
                                <span class="text-white">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @error('image')
            <div class="text-red-500 text-sm">{{ $message }}</div>
        @enderror
        <flux:separator class="my-4" />

        <div class="flex justify-end border-2 border-gray-200 dark:border-gray-700 rounded-lg p-4 gap-2">
            <flux:button href="{{ route('admin.news') }}" wire:navigate variant="danger" type="button">
                Batal
            </flux:button>
            <flux:button wire:loading.attr="disabled" variant="primary" color="blue" type="submit">Simpan
            </flux:button>
        </div>
    </form>
</div>
