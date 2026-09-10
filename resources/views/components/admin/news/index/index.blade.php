<div>
    <div class="flex items-center justify-between">
        <div class="space-y-1">
            <h1 class="text-2xl font-bold">Berita</h1>
            <p class="text-gray-500">Daftar berita</p>
        </div>
        <div class="flex items-center gap-2">
            @if ($this->pendingComments->count() > 0)
                <flux:button icon="chat-bubble-left-right" variant="outline" color="amber"
                    x-on:click="$flux.modal('news-pending-comments').show()">
                    {{ $this->pendingComments->count() }} Komentar Menunggu
                </flux:button>
            @endif
            <flux:button href="{{ route('admin.news.create') }}" icon="plus" variant="primary" color="green" wire:navigate>
                Tambah Berita
            </flux:button>
        </div>
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

    <flux:modal name="news-comments" class="w-full max-w-3xl" :dismissible="false">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold">Komentar - {{ $this->selectedNews?->title }}</h2>
                <flux:button variant="ghost" icon="x-mark" x-on:click="$flux.modal('news-comments').close()" />
            </div>

            @if ($this->selectedNews?->comments?->count() > 0)
                <div class="space-y-4 max-h-[60vh] overflow-y-auto">
                    @foreach ($this->selectedNews->comments as $comment)
                        <div class="p-4 bg-gray-50 dark:bg-zinc-800 rounded-xl border border-gray-200 dark:border-zinc-700">
                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    <span class="font-bold text-gray-900 dark:text-white">{{ $comment->name ?? $comment->user->name }}</span>
                                    @if ($comment->email)
                                        <span class="text-xs text-gray-500 ml-1">({{ $comment->email }})</span>
                                    @endif
                                    <span class="text-xs text-gray-400 ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <span class="text-xs px-2 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-100 rounded-full">Menunggu</span>
                            </div>
                            <p class="text-sm text-gray-700 dark:text-gray-300 mb-4 leading-relaxed">{{ $comment->content }}</p>
                            <div class="flex gap-2">
                                <flux:button wire:click="approveComment({{ $comment->id }})" icon="check" variant="primary" color="green" size="sm">Setujui</flux:button>
                                <flux:button wire:click="rejectComment({{ $comment->id }})" icon="x-mark" variant="primary" color="red" size="sm">Tolak</flux:button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 dark:text-gray-400 text-center py-8">Belum ada komentar menunggu persetujuan.</p>
            @endif
        </div>
    </flux:modal>

    @if ($this->pendingComments->count() > 0)
        <flux:modal name="news-pending-comments" class="w-full max-w-3xl" :dismissible="false">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold">Komentar Menunggu Persetujuan ({{ $this->pendingComments->count() }})</h2>
                    <flux:button variant="ghost" icon="x-mark" x-on:click="$flux.modal('news-pending-comments').close()" />
                </div>
                <div class="space-y-4 max-h-[60vh] overflow-y-auto">
                    @foreach ($this->pendingComments as $comment)
                        <div class="p-4 bg-gray-50 dark:bg-zinc-800 rounded-xl border border-gray-200 dark:border-zinc-700">
                            <div class="flex items-center justify-between mb-2">
                                <div>
                                    <span class="font-bold text-gray-900 dark:text-white">{{ $comment->name ?? $comment->user->name }}</span>
                                    @if ($comment->email)
                                        <span class="text-xs text-gray-500 ml-1">({{ $comment->email }})</span>
                                    @endif
                                    <span class="text-xs text-gray-400 ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <span class="text-xs px-2 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-100 rounded-full">Menunggu</span>
                            </div>
                            <a href="{{ route('news.show', $comment->news->slug) }}" class="text-xs text-blue-600 dark:text-blue-400 hover:underline block mb-2">{{ $comment->news->title }}</a>
                            <p class="text-sm text-gray-700 dark:text-gray-300 mb-4 leading-relaxed">{{ $comment->content }}</p>
                            <div class="flex gap-2">
                                <flux:button wire:click="approveComment({{ $comment->id }})" icon="check" variant="primary" color="green" size="sm">Setujui</flux:button>
                                <flux:button wire:click="rejectComment({{ $comment->id }})" icon="x-mark" variant="primary" color="red" size="sm">Tolak</flux:button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </flux:modal>
    @endif

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
