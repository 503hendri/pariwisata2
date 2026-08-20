<div class="container mx-auto py-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Profile Website</h1>
        <p class="text-gray-600 dark:text-gray-400">Kelola informasi profil website Sawahlunto Tourism</p>
    </div>

    <flux:separator class="my-4" />

    <form wire:submit="save" class="space-y-8">
        <!-- Basic Information Section -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-700 p-6">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Informasi Dasar</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:input wire:model="name" label="Nama Website" placeholder="Masukkan nama website" />
                <flux:input wire:model="tagline" label="Tagline" placeholder="Masukkan tagline website" />
            </div>

            <div class="mt-4">
                <flux:textarea wire:model="description" label="Deskripsi" placeholder="Masukkan deskripsi website" rows="3" />
            </div>
        </div>

        <!-- Media Assets Section -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-700 p-6">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Media & Aset</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <flux:input wire:model="logo" label="Logo" type="file" accept="image/*" />
                    <p class="text-xs text-gray-500 mt-1">Rekomendasi: 200x200px, format PNG/SVG</p>
                </div>
                <div>
                    <flux:input wire:model="favicon" label="Favicon" type="file" accept="image/*" />
                    <p class="text-xs text-gray-500 mt-1">Rekomendasi: 32x32px atau 64x64px</p>
                </div>
                <div>
                    <flux:input wire:model="cover" label="Cover Image" type="file" accept="image/*" />
                    <p class="text-xs text-gray-500 mt-1">Rekomendasi: 1920x1080px</p>
                </div>
            </div>
        </div>

        <!-- Contact Information Section -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-700 p-6">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Informasi Kontak</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:input wire:model="phone" label="Nomor Telepon" placeholder="Contoh: +62 821 8024 6567" />
                <flux:input wire:model="email" type="email" label="Email" placeholder="Contoh: info@sawahluntotourism.id" />
            </div>

            <div class="mt-4">
                <flux:textarea wire:model="address" label="Alamat" placeholder="Masukkan alamat lengkap" rows="2" />
            </div>
        </div>

        <!-- Social Media Section -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border border-gray-200 dark:border-zinc-700 p-6">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-8 h-8 bg-pink-100 dark:bg-pink-900/30 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Media Sosial</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:input wire:model="instagram" label="Instagram" placeholder="@username atau URL" />
                <flux:input wire:model="facebook" label="Facebook" placeholder="Username atau URL" />
                <flux:input wire:model="tiktok" label="TikTok" placeholder="@username atau URL" />
                <flux:input wire:model="youtube" label="YouTube" placeholder="Username atau URL" />
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-end gap-3">
            <flux:button variant="ghost" type="button" wire:click="resetForm">
                Reset
            </flux:button>
            <flux:button type="submit" variant="primary" color="green" icon="save">
                Simpan Perubahan
            </flux:button>
        </div>
    </form>
</div>