<flux:modal name="reset-password" class="min-w-[22rem]">
    <div class="space-y-4">
        <flux:heading size="lg">Reset Password</flux:heading>

        <form wire:submit="resetPassword" class="space-y-4">
            <flux:input type="password" wire:model="newPassword" label="New Password" viewable />
            <flux:input type="password" wire:model="confirmPassword" label="Confirm Password" viewable />

            <div class="flex justify-end">
                <flux:button type="submit" icon="key" variant="primary" color="blue">
                    Reset Password
                </flux:button>
            </div>
        </form>
    </div>
</flux:modal>
