<div>
    <flux:heading>
        Delete User
    </flux:heading>

    <flux:card>
        <div class="flex items-center gap-2">
            <flux:icon.exclamation-triangle class="w-5 h-5 text-red-500" />
            <div>
                <strong>Warning:</strong> This action cannot be undone. This will permanently delete the user account.
            </div>
        </div>

        @if ($user?->id === auth()->user()->id)
            <div class="flex items-center gap-2 mt-4">
                <flux:icon.information-circle class="w-5 h-5 text-blue-500" />
                <div>
                    You cannot delete your own account.
                </div>
            </div>
        @else
            <div class="space-y-4">
                <p>
                    Are you sure you want to delete the user <strong>{{ $user?->name }}</strong> ({{ $user?->email }})?
                </p>

                <flux:field>
                    <flux:label>
                        Type <strong>{{ $user?->name }}</strong> to confirm deletion:
                    </flux:label>
                    <flux:input wire:model="confirmName" placeholder="Type the user name exactly" />
                    <flux:error name="confirmName" />
                </flux:field>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-medium mb-2">User Details:</h4>
                    <div class="space-y-1 text-sm">
                        <div><strong>Name:</strong> {{ $user?->name }}</div>
                        <div><strong>Email:</strong> {{ $user?->email }}</div>
                        <div><strong>Roles:</strong>
                            @if ($user)
                                @foreach ($user->roles as $role)
                                    <flux:badge size="sm" class="mr-1">{{ ucfirst($role->name) }}</flux:badge>
                                @endforeach
                            @endif
                        </div>
                        <div><strong>Status:</strong>
                            <flux:badge variant="{{ $user?->is_active ? 'success' : 'danger' }}" size="sm">
                                {{ $user?->is_active ? 'Active' : 'Inactive' }}
                            </flux:badge>
                        </div>
                        <div><strong>Created:</strong> {{ $user?->created_at->format('M j, Y') }}</div>
                    </div>
                </div>
            </div>
        @endif
    </flux:card>

    <flux:card>
        <flux:button variant="ghost" wire:click="cancel">
            Cancel
        </flux:button>
        @if ($user?->id !== auth()->id())
            <flux:button variant="danger" wire:click="deleteUser" wire:confirm="Are you absolutely sure?"
                :disabled="strtolower($confirmName) !== strtolower($user?->name)">
                Delete User
            </flux:button>
        @endif
    </flux:card>
</div>
