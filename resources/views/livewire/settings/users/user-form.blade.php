<div>
    <flux:heading>
        {{ $isEditing ? 'Edit User' : 'Create New User' }}
    </flux:heading>

    <flux:card>
        <form wire:submit="save">
            <div class="space-y-4">
                <flux:field>
                    <flux:label>Name</flux:label>
                    <flux:input wire:model="name" required autofocus />
                    <flux:error name="name" />
                </flux:field>

                <flux:field>
                    <flux:label>Email</flux:label>
                    <flux:input wire:model="email" type="email" required />
                    <flux:error name="email" />
                </flux:field>

                @if (!$isEditing)
                    <flux:field>
                        <flux:label>Password</flux:label>
                        <div class="flex gap-2">
                            <flux:input wire:model="password" type="password" required class="flex-1" />
                            <flux:button type="button" variant="outline" size="sm" wire:click="generatePassword">
                                Generate
                            </flux:button>
                        </div>
                        <flux:error name="password" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Confirm Password</flux:label>
                        <flux:input wire:model="password_confirmation" type="password" required />
                        <flux:error name="password_confirmation" />
                    </flux:field>
                @else
                    <flux:field class="md:col-span-2">
                        <flux:label>Password (leave blank to keep current)</flux:label>
                        <div class="flex gap-2">
                            <flux:input wire:model="password" type="password" class="flex-1" />
                            <flux:button type="button" variant="outline" size="sm" wire:click="generatePassword">
                                Generate
                            </flux:button>
                        </div>
                        <flux:error name="password" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Confirm Password</flux:label>
                        <flux:input wire:model="password_confirmation" type="password" />
                        <flux:error name="password_confirmation" />
                    </flux:field>
                @endif

                <flux:field class="md:col-span-2">
                    <flux:label>Roles</flux:label>
                    <div class="space-y-2">
                        @foreach ($availableRoles as $role)
                            <flux:checkbox wire:model="roles" value="{{ $role }}"
                                label="{{ ucfirst($role) }}" />
                        @endforeach
                    </div>
                    <flux:error name="roles" />
                </flux:field>

                <flux:field>
                    <flux:label>Status</flux:label>
                    <flux:switch wire:model="is_active" label="Active" />
                    <flux:error name="is_active" />
                </flux:field>
            </div>
        </form>
    </flux:card>

    <flux:card>
        <flux:button variant="ghost" wire:click="cancel">
            Cancel
        </flux:button>
        <flux:button variant="primary" wire:click="save" wire:target="save">
            {{ $isEditing ? 'Update User' : 'Create User' }}
        </flux:button>
    </flux:card>
</div>
