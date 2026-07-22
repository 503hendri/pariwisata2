<flux:modal name="delete-user" class="w-full max-w-md" @close="$wire.userIdToDelete = null">
    <div class="flex flex-col items-center justify-center space-y-4">
        <flux:heading size="lg">Hapus User</flux:heading>
        <flux:text class="text-center">Apakah Anda yakin ingin menghapus user ini?</flux:text>
        <flux:spacer />
        <flux:button variant="danger" wire:click="delete" class="w-full">Ya, Hapus</flux:button>
    </div>
</flux:modal>
