<div class="space-y-4">
    <div class="flex items-center gap-2">
        <div class="rounded-full bg-gray-100 dark:bg-gray-800 p-2 w-12 h-12 flex items-center justify-center">
            <flux:icon.users class="text-gray-600 dark:text-gray-400" />
        </div>
        <div class="flex-1">
            <flux:heading size="xl">Manajemen User</flux:heading>
            <flux:subheading>Mengelola user aplikasi</flux:subheading>
        </div>
    </div>

    <flux:separator />

    <div class="space-y-4">
        <div class="flex items-center gap-2">
            <flux:input placeholder="Search users..." wire:model.live.debounce.300ms="search" icon="magnifying-glass"
                class="flex-1 min-w-0" />
            <flux:modal.trigger name="add-user">
                <flux:button variant="primary" icon-trailing="plus" color="green">
                    Tambah
                </flux:button>
            </flux:modal.trigger>
        </div>

        <flux:table container:class="max-h-[calc(100vh-200px)]" :paginate="$this->users">
            <flux:table.columns sticky class="bg-gray-100 dark:bg-gray-800">
                <flux:table.column>#</flux:table.column>
                <flux:table.column sortable sorted direction="asc">Name</flux:table.column>
                <flux:table.column>Email</flux:table.column>
                <flux:table.column>Role</flux:table.column>
                <flux:table.column>Active</flux:table.column>
                <flux:table.column>Actions</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @forelse ($this->users as $user)
                    <flux:table.row>
                        <flux:table.cell>
                            {{ $loop->iteration + $this->users->perPage() * ($this->users->currentPage() - 1) }}
                        </flux:table.cell>
                        <flux:table.cell>{{ $user->name }}</flux:table.cell>
                        <flux:table.cell>{{ $user->email }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:badge variant="primary" size="sm" color="blue" class="capitalize">
                                {{ $user->getRoleNames()->first() ?? '-' }}
                            </flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:badge variant="primary" size="sm"
                                color="{{ $user->is_active ? 'green' : 'red' }}" class="capitalize">
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                            </flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:dropdown>
                                <flux:button variant="ghost" icon="ellipsis-vertical" size="sm" />
                                <flux:menu>
                                    <flux:menu.item icon="pencil" wire:click="updateUser('{{ $user->id }}')">
                                        Edit
                                    </flux:menu.item>
                                    <flux:menu.item icon="key"
                                        wire:click="resetPasswordModal('{{ $user->id }}')">
                                        Reset Password
                                    </flux:menu.item>
                                    <flux:menu.item icon="trash" variant="danger"
                                        wire:click="deleteUser('{{ $user->id }}')">
                                        Hapus
                                    </flux:menu.item>
                                </flux:menu>
                            </flux:dropdown>
                        </flux:table.cell>
                    </flux:table.row>
                @empty
                    <flux:table.row>
                        <flux:table.cell colspan="6">
                            <div class="flex items-center justify-center gap-2">
                                <flux:icon icon="x-mark" class="w-6 h-6 text-gray-400" />
                                <flux:text variant="muted">Tidak ada data</flux:text>
                            </div>
                        </flux:table.cell>
                    </flux:table.row>
                @endforelse
            </flux:table.rows>
        </flux:table>
    </div>

    <x-settings.users.form-modal />

    <x-settings.users.reset-password />

    <x-settings.users.delete-modal />
</div>
