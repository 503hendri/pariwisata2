<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">{{ $news ? 'Edit Berita' : 'Berita' }}</h1>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $news ? 'Edit berita yang ada' : 'Tambah berita baru' }}</span>
        </div>
    </div>

    <flux:separator class="my-4" />

    <form wire:submit="submit">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <flux:input label="Judul" placeholder="Masukkan judul berita" wire:model.live.debounce.300ms="title" />

                @error('title')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Konten Berita
                    </label>

                    <div
                        x-data="{ content: @entangle('content').live, ...setupEditor() }"
                        x-init="() => init($refs.editor)"
                        wire:ignore
                        class="border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden">

                        <template x-if="isLoaded()">
                            <div class="flex flex-wrap items-center gap-1 p-2 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
                                <button type="button"
                                    @click="toggleBold()"
                                    :class="isActive('bold', {}, updatedAt) ? 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900' : 'bg-zinc-200 dark:bg-zinc-700 hover:bg-zinc-300'"
                                    class="flex items-center px-3 py-1 rounded-lg shadow-xs cursor-pointer transition-colors"
                                    title="Bold">
                                    B
                                </button>
                                <button type="button"
                                    @click="toggleItalic()"
                                    :class="isActive('italic', {}, updatedAt) ? 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900' : 'bg-zinc-200 dark:bg-zinc-700 hover:bg-zinc-300'"
                                    class="flex items-center px-3 py-1 rounded-lg shadow-xs cursor-pointer transition-colors italic">
                                    I
                                </button>
                                <button type="button"
                                    @click="toggleUnderline()"
                                    :class="isActive('underline', {}, updatedAt) ? 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900' : 'bg-zinc-200 dark:bg-zinc-700 hover:bg-zinc-300'"
                                    class="flex items-center px-3 py-1 rounded-lg shadow-xs cursor-pointer transition-colors underline">
                                    U
                                </button>
                                <button type="button"
                                    @click="toggleStrike()"
                                    :class="isActive('strike', {}, updatedAt) ? 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900' : 'bg-zinc-200 dark:bg-zinc-700 hover:bg-zinc-300'"
                                    class="flex items-center px-3 py-1 rounded-lg shadow-xs cursor-pointer transition-colors line-through">
                                    S
                                </button>
                                <button type="button"
                                    @click="toggleHighlight()"
                                    :class="isActive('highlight', {}, updatedAt) ? 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900' : 'bg-zinc-200 dark:bg-zinc-700 hover:bg-zinc-300'"
                                    class="flex items-center px-3 py-1 rounded-lg shadow-xs cursor-pointer transition-colors"
                                    title="Highlight">
                                    H
                                </button>

                                <span class="w-px h-6 bg-zinc-300 dark:bg-zinc-600 mx-1"></span>

                                <button type="button" class="flex items-center px-3 py-1 bg-zinc-200 dark:bg-zinc-700 rounded-lg shadow-xs cursor-pointer hover:bg-zinc-300 transition-colors font-bold text-sm"
                                    @click="toggleHeading({ level: 1 })"
                                    :class="isActive('heading', { level: 1 }, updatedAt) ? '!bg-zinc-900 !text-white dark:!bg-white dark:!text-zinc-900' : ''">
                                    H1
                                </button>
                                <button type="button" class="flex items-center px-3 py-1 bg-zinc-200 dark:bg-zinc-700 rounded-lg shadow-xs cursor-pointer hover:bg-zinc-300 transition-colors font-bold text-sm"
                                    @click="toggleHeading({ level: 2 })"
                                    :class="isActive('heading', { level: 2 }, updatedAt) ? '!bg-zinc-900 !text-white dark:!bg-white dark:!text-zinc-900' : ''">
                                    H2
                                </button>
                                <button type="button" class="flex items-center px-3 py-1 bg-zinc-200 dark:bg-zinc-700 rounded-lg shadow-xs cursor-pointer hover:bg-zinc-300 transition-colors font-bold text-sm"
                                    @click="toggleHeading({ level: 3 })"
                                    :class="isActive('heading', { level: 3 }, updatedAt) ? '!bg-zinc-900 !text-white dark:!bg-white dark:!text-zinc-900' : ''">
                                    H3
                                </button>
                                <button type="button" class="flex items-center px-3 py-1 bg-zinc-200 dark:bg-zinc-700 rounded-lg shadow-xs cursor-pointer hover:bg-zinc-300 transition-colors font-bold text-sm"
                                    @click="toggleHeading({ level: 4 })"
                                    :class="isActive('heading', { level: 4 }, updatedAt) ? '!bg-zinc-900 !text-white dark:!bg-white dark:!text-zinc-900' : ''">
                                    H4
                                </button>
                                <button type="button" class="flex items-center px-3 py-1 bg-zinc-200 dark:bg-zinc-700 rounded-lg shadow-xs cursor-pointer hover:bg-zinc-300 transition-colors text-sm"
                                    @click="setParagraph()"
                                    :class="isActive('paragraph', {}, updatedAt) ? '!bg-zinc-900 !text-white dark:!bg-white dark:!text-zinc-900' : ''">
                                    P
                                </button>

                                <span class="w-px h-6 bg-zinc-300 dark:bg-zinc-600 mx-1"></span>

                                <button type="button"
                                    @click="setAlign('left')"
                                    :class="isActive({ textAlign: 'left' }, updatedAt) ? 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900' : 'bg-zinc-200 dark:bg-zinc-700 hover:bg-zinc-300'"
                                    class="flex items-center px-3 py-1 rounded-lg shadow-xs cursor-pointer transition-colors">
                                    L
                                </button>
                                <button type="button"
                                    @click="setAlign('center')"
                                    :class="isActive({ textAlign: 'center' }, updatedAt) ? 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900' : 'bg-zinc-200 dark:bg-zinc-700 hover:bg-zinc-300'"
                                    class="flex items-center px-3 py-1 rounded-lg shadow-xs cursor-pointer transition-colors">
                                    C
                                </button>
                                <button type="button"
                                    @click="setAlign('right')"
                                    :class="isActive({ textAlign: 'right' }, updatedAt) ? 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900' : 'bg-zinc-200 dark:bg-zinc-700 hover:bg-zinc-300'"
                                    class="flex items-center px-3 py-1 rounded-lg shadow-xs cursor-pointer transition-colors">
                                    R
                                </button>
                                <button type="button"
                                    @click="setAlign('justify')"
                                    :class="isActive({ textAlign: 'justify' }, updatedAt) ? 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900' : 'bg-zinc-200 dark:bg-zinc-700 hover:bg-zinc-300'"
                                    class="flex items-center px-3 py-1 rounded-lg shadow-xs cursor-pointer transition-colors">
                                    J
                                </button>

                                <span class="w-px h-6 bg-zinc-300 dark:bg-zinc-600 mx-1"></span>

                                <button type="button"
                                    @click="toggleBulletList()"
                                    :class="isActive('bulletList', {}, updatedAt) ? 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900' : 'bg-zinc-200 dark:bg-zinc-700 hover:bg-zinc-300'"
                                    class="flex items-center px-3 py-1 rounded-lg shadow-xs cursor-pointer transition-colors">
                                    •
                                </button>
                                <button type="button"
                                    @click="toggleOrderedList()"
                                    :class="isActive('orderedList', {}, updatedAt) ? 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900' : 'bg-zinc-200 dark:bg-zinc-700 hover:bg-zinc-300'"
                                    class="flex items-center px-3 py-1 rounded-lg shadow-xs cursor-pointer transition-colors">
                                    1.
                                </button>
                                <button type="button"
                                    @click="toggleBlockquote()"
                                    :class="isActive('blockquote', {}, updatedAt) ? 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900' : 'bg-zinc-200 dark:bg-zinc-700 hover:bg-zinc-300'"
                                    class="flex items-center px-3 py-1 rounded-lg shadow-xs cursor-pointer transition-colors">
                                    "
                                </button>
                                <button type="button"
                                    @click="toggleCodeBlock()"
                                    :class="isActive('codeBlock', {}, updatedAt) ? 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900' : 'bg-zinc-200 dark:bg-zinc-700 hover:bg-zinc-300'"
                                    class="flex items-center px-3 py-1 rounded-lg shadow-xs cursor-pointer transition-colors font-mono text-xs">
                                    &lt;/&gt;
                                </button>

                                <span class="w-px h-6 bg-zinc-300 dark:bg-zinc-600 mx-1"></span>

                                <button type="button"
                                    @click="undo()"
                                    class="flex items-center px-3 py-1 bg-zinc-200 dark:bg-zinc-700 rounded-lg shadow-xs cursor-pointer hover:bg-zinc-300 transition-colors">
                                    Undo
                                </button>
                                <button type="button"
                                    @click="redo()"
                                    class="flex items-center px-3 py-1 bg-zinc-200 dark:bg-zinc-700 rounded-lg shadow-xs cursor-pointer hover:bg-zinc-300 transition-colors">
                                    Redo
                                </button>

                                <span class="w-px h-6 bg-zinc-300 dark:bg-zinc-600 mx-1"></span>

                                <button type="button"
                                    @click="document.getElementById('tiptap-image-input').click()"
                                    class="flex items-center px-3 py-1 bg-zinc-200 dark:bg-zinc-700 rounded-lg shadow-xs cursor-pointer hover:bg-zinc-300 transition-colors"
                                    title="Upload gambar ke konten">
                                    📷 Upload
                                </button>
                                <button type="button"
                                    @click="addImage()"
                                    class="flex items-center px-3 py-1 bg-zinc-200 dark:bg-zinc-700 rounded-lg shadow-xs cursor-pointer hover:bg-zinc-300 transition-colors"
                                    title="Sisipkan gambar dari URL">
                                    URL
                                </button>
                                <button type="button"
                                    @click="setLink()"
                                    :class="isActive('link', {}, updatedAt) ? 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900' : 'bg-zinc-200 dark:bg-zinc-700 hover:bg-zinc-300'"
                                    class="flex items-center px-3 py-1 rounded-lg shadow-xs cursor-pointer transition-colors"
                                    title="Link">
                                    🔗
                                </button>
                            </div>
                        </template>

                        <div x-ref="editor" class="min-h-[300px] bg-white dark:bg-zinc-900"></div>
                    </div>

                    <input type="file" id="tiptap-image-input" class="hidden" accept="image/*"
                        @change="
                            const file = $event.target.files[0];
                            if (!file) return;
                            const alpineData = Alpine.$data($el.closest('.space-y-6').querySelector('[x-data]'));
                            $wire.upload('inlineImage', file,
                                () => {
                                    $wire.call('uploadInlineImage').then((url) => {
                                        if (url && alpineData && typeof alpineData.insertImageUrl === 'function') {
                                            alpineData.insertImageUrl(url);
                                        }
                                    });
                                }
                            );
                            $event.target.value = '';
                        "
                    />

                    @error('content')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-6">
                <div class="p-4 bg-zinc-50 dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700">
                    <h3 class="text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-4">
                        Pengaturan Publikasi
                    </h3>

                    <div class="space-y-4">
                        <flux:checkbox label="Publikasikan sekarang" wire:model="is_published" />

                        <div class="text-xs text-zinc-500 dark:text-zinc-400">
                            @if($is_published)
                                <span class="text-green-600">✓ Berita akan langsung dipublikasikan</span>
                            @else
                                <span>Simpan sebagai draft terlebih dahulu</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-zinc-50 dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700">
                    <h3 class="text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-4">
                        Gambar Utama
                    </h3>

                    <flux:input type="file" accept="image/*" wire:model="image" class="mb-3" />

                    <div class="relative group">
                        <div class="w-full aspect-video rounded-lg border-2 border-dashed border-zinc-300 dark:border-zinc-600 overflow-hidden bg-zinc-100 dark:bg-zinc-900 transition-all duration-200 group-hover:border-blue-400">
                            @if ($imagePreview)
                                <img src="{{ $imagePreview }}" alt="Preview" class="w-full h-full object-cover transition-transform duration-200 group-hover:scale-105" />
                            @else
                                <div class="flex flex-col items-center justify-center h-full text-zinc-400 dark:text-zinc-500">
                                    <flux:icon.camera class="w-12 h-12 mb-2" />
                                    <span class="text-xs">Preview gambar</span>
                                </div>
                            @endif

                            <div wire:loading.flex wire:target="image" class="absolute inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm">
                                <flux:icon.loading class="w-8 h-8 text-white animate-spin" />
                            </div>
                        </div>
                    </div>

                    @error('image')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror

                    <p class="mt-2 text-xs text-zinc-500 dark:text-zinc-400">
                        Format: JPG, PNG, GIF, SVG. Maks: 2MB
                    </p>
                </div>

                <div class="p-4 bg-zinc-50 dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700">
                    <h3 class="text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-3">
                        Slug URL
                    </h3>

                    @if($title)
                        <code class="text-xs bg-zinc-200 dark:bg-zinc-700 px-2 py-1 rounded block break-all">
                            /news/{{ Str::slug($title) }}
                        </code>
                        @if($news)
                            <p class="text-xs text-zinc-500 mt-1">Slug saat ini: <span class="font-mono">{{ $news->slug }}</span></p>
                        @endif
                    @else
                        <span class="text-xs text-zinc-400">Slug akan dibuat otomatis dari judul</span>
                    @endif
                </div>

                <div class="p-4 bg-zinc-50 dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700">
                    <h3 class="text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-3">
                        Tags
                    </h3>

                    <flux:input wire:model.live.debounce.500ms="tagInput" placeholder="Ketik tag lalu tunggu..." class="mb-3" />

                    @if (! empty($selectedTags))
                        <div class="flex flex-wrap gap-2">
                            @foreach (\App\Models\Tag::whereIn('id', $selectedTags)->get() as $tag)
                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded-full text-xs font-medium">
                                    #{{ $tag->name }}
                                    <button type="button" wire:click="removeTag({{ $tag->id }})" class="text-blue-500 hover:text-blue-700 font-bold">×</button>
                                </span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-zinc-400">Belum ada tag. Ketik tag baru.</p>
                    @endif
                </div>
            </div>
        </div>

        <flux:separator class="my-6" />

        <div class="flex items-center justify-between">
            <flux:button href="{{ route('admin.news') }}" wire:navigate variant="outline" icon="x-mark">
                Batal
            </flux:button>

            <flux:button wire:loading.attr="disabled" variant="primary" color="blue" type="submit">
                {{ $news ? 'Perbarui' : 'Simpan' }}
            </flux:button>
        </div>
    </form>
</div>
