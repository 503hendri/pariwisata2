<flux:modal name="add-user" class="w-full max-w-md" :dismissible="false" @close="clear()">
    <h2 class="text-lg font-semibold">
        {{ $this->editingUser ? 'Edit User' : 'Tambah User' }}
    </h2>
    <span class="text-sm text-gray-500">{{ $this->editingUser ? 'Edit user' : 'Tambah user baru' }}</span>

    <flux:separator class="my-4" />
    <form wire:submit="{{ $this->editingUser ? 'update' : 'save' }}" class="space-y-4">
        <flux:input label="Name" wire:model="name" />
        <flux:input label="Email" wire:model="email" />

        @if (!$this->editingUser)
            <flux:input type="password" label="Password" wire:model="password" viewable />
            <flux:input type="password" label="Confirm Password" wire:model="password_confirmation" viewable />
        @endif
        
        <flux:select label="Role" placeholder="Pilih role" wire:model="role">
            @foreach ($this->roles as $role)
                <flux:select.option value="{{ $role['name'] }}">{{ ucfirst($role['name']) }}</flux:select.option>
            @endforeach
        </flux:select>

        <div class="flex justify-between pt-6">
            <flux:button type="button" variant="outline" icon="x-mark" x-on:click="$flux.modal('add-user').close()">
                Batal
            </flux:button>
            <flux:button type="submit" variant="primary" color="green" icon="save">
                {{ $this->editingUser ? 'Update' : 'Simpan' }}
            </flux:button>
        </div>
    </form>
</flux:modal>
