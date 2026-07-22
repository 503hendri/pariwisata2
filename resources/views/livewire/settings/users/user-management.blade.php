<div>
    <flux:container>
        <flux:header>
            <div class="flex items-center gap-2 ">
                <flux:button href="{{ route('users.index') }}" variant="primary" active>
                    Users
                </flux:button>
                <flux:button href="{{ route('users.roles') }}" variant="primary">
                    Roles & Permissions
                </flux:button>
            </div>
            <flux:heading>User Management</flux:heading>
            <flux:subheading>Manage application users and their permissions</flux:subheading>
        </flux:header>


        <flux:dropdown>
            <flux:button variant="outline" icon="arrow-down-tray">
                Export
            </flux:button>
            <flux:menu wire:click="exportUsers('csv')">
                Export as CSV
            </flux:menu>
            <flux:menu wire:click="exportUsers('excel')">
                Export as Excel
            </flux:menu>
        </flux:dropdown>

        <flux:spacer />

        <flux:button variant="primary" icon="plus" wire:click="$dispatch('open-user-form', { user: null })">
            Add User
        </flux:button>


        <!-- Search and Filters -->
        <div class="flex gap-4">
            <flux:input label="Search" wire:model.live="search" placeholder="Search by name or email..."
                icon="magnifying-glass" />

            <flux:select label="Role" wire:model.live="roleFilter">
                <option value="all">All Roles</option>
                @foreach ($this->roles as $role)
                    <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                @endforeach
            </flux:select>

            <flux:select label="Status" wire:model.live="statusFilter">
                <option value="all">All Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </flux:select>
        </div>

        <!-- Bulk Actions -->
        @if (count($selectedUsers) > 0)
            <div class="flex items-center justify-between">
                <span>{{ count($selectedUsers) }} user(s) selected</span>
                <div class="flex gap-2">
                    <flux:button size="sm" variant="outline" wire:click="bulkActivate">
                        Activate
                    </flux:button>
                    <flux:button size="sm" variant="outline" wire:click="bulkDeactivate">
                        Deactivate
                    </flux:button>
                    <flux:button size="sm" variant="danger" wire:click="bulkDelete">
                        Delete
                    </flux:button>
                </div>
            </div>
        @endif

        <!-- Users Table -->
        <flux:table class="mt-4">
            <flux:table.columns>
                <flux:table.row>
                    <flux:table.cell>
                        <flux:checkbox wire:model.live="selectAll" />
                    </flux:table.cell>
                    <flux:table.cell>User</flux:table.cell>
                    <flux:table.cell>Roles</flux:table.cell>
                    <flux:table.cell>Status</flux:table.cell>
                    <flux:table.cell>Created</flux:table.cell>
                    <flux:table.cell>Actions</flux:table.cell>
                </flux:table.row>
            </flux:table.columns>

            <flux:table.rows>
                @forelse($this->users as $user)
                    <flux:table.row>
                        <flux:table.cell>
                            <flux:checkbox wire:model.live="selectedUsers" value="{{ $user->id }}" />
                        </flux:table.cell>
                        <flux:table.cell>
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-sm font-medium">
                                    {{ $user->initials() }}
                                </div>
                                <div>
                                    <div class="font-medium">{{ $user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                </div>
                            </div>
                        </flux:table.cell>
                        <flux:table.cell>
                            @foreach ($user->roles as $role)
                                <flux:badge size="sm" class="mr-1">{{ ucfirst($role->name) }}</flux:badge>
                            @endforeach
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:badge variant="{{ $user->is_active ? 'success' : 'danger' }}" size="sm">
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                            </flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>
                            {{ $user->created_at->format('M j, Y') }}
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:dropdown>
                                <flux:dropdown>
                                    <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" />
                                </flux:dropdown>
                                <flux:menu>
                                    <flux:menu.item
                                        wire:click="$dispatch('open-user-form', { user: {{ $user->id }} })">
                                        Edit
                                    </flux:menu.item>
                                    <flux:menu.item wire:click="toggleUserStatus({{ $user->id }})">
                                        {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                                    </flux:menu.item>
                                    @if ($user->id !== auth()->id())
                                        <flux:separator />
                                        <flux:menu.item variant="danger"
                                            wire:click="$dispatch('open-user-delete-modal', { user: {{ $user->id }} })">
                                            Delete
                                        </flux:dropdown.item>
                                    @endif
                                </flux:menu>
                            </flux:dropdown>
                        </flux:table.cell>
                    </flux:table.row>
                @empty
                    <flux:table.row>
                        <flux:table.cell colspan="6">
                            No users found
                        </flux:table.cell>
                    </flux:table.row>
                @endforelse
            </flux:table.rows>
        </flux:table>

        <!-- Pagination -->
        {{ $this->users->links() }}
    </flux:container>

    <!-- User Form Modal -->
    <flux:modal wire:model="showUserForm">
        <livewire:settings.users.user-form :user="$editingUser" />
    </flux:modal>

    <!-- User Delete Modal -->
    <flux:modal wire:model="showUserDeleteModal">
        <livewire:settings.users.user-delete-modal :user="$deletingUser" />
    </flux:modal>

    <!-- Event Listeners -->
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('open-user-form', (event) => {
                @this.set('showUserForm', true);
                @this.call('loadUser', event.user);
            });

            Livewire.on('open-user-delete-modal', (event) => {
                @this.set('showUserDeleteModal', true);
                @this.call('loadUserForDeletion', event.user);
            });

            Livewire.on('close-modal', () => {
                @this.set('showUserForm', false);
                @this.set('showUserDeleteModal', false);
            });
        });
    </script>
</div>
