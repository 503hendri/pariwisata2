<div>
    <flux:container>
        <flux:header>
            <flux:tabs>
                <flux:tab href="{{ route('users.index') }}">
                    Users
                </flux:tab>
                <flux:tab href="{{ route('users.roles') }}" active>
                    Roles & Permissions
                </flux:tab>
            </flux:tabs>
            <flux:heading>Role Management</flux:heading>
            <flux:subheading>Manage user roles and permissions</flux:subheading>
        </flux:header>

        <flux:segment>
            <!-- Role Form -->
            <flux:card class="mb-6">
                <flux:card.heading>
                    {{ $isEditing ? 'Edit Role' : 'Create New Role' }}
                </flux:card.heading>
                <flux:card.content>
                    <form wire:submit="{{ $isEditing ? 'updateRole' : 'createRole' }}">
                        <flux:grid :cols="['md:2']" class="space-y-4">
                            <flux:field>
                                <flux:label>Role Name</flux:label>
                                <flux:input
                                    wire:model="name"
                                    placeholder="e.g., admin, editor, viewer"
                                    required
                                />
                                <flux:error name="name" />
                            </flux:field>

                            <flux:field>
                                <flux:label>Description</flux:label>
                                <flux:input
                                    wire:model="description"
                                    placeholder="Brief description of the role"
                                />
                                <flux:error name="description" />
                            </flux:field>
                        </flux:grid>

                        <!-- Permissions -->
                        <flux:field class="mt-4">
                            <flux:label>Permissions</flux:label>
                            <div class="space-y-4">
                                @foreach($permissions as $group => $groupPermissions)
                                    <div class="border rounded-lg p-4">
                                        <h4 class="font-medium mb-3 capitalize">{{ $group }}</h4>
                                        <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                                            @foreach($groupPermissions as $permission)
                                                <flux:checkbox
                                                    wire:model="selectedPermissions"
                                                    value="{{ $permission->name }}"
                                                    label="{{ ucfirst(str_replace('.', ' ', $permission->name)) }}"
                                                />
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <flux:error name="selectedPermissions" />
                        </flux:field>

                        <div class="flex gap-2 mt-4">
                            <flux:button variant="primary" type="submit">
                                {{ $isEditing ? 'Update Role' : 'Create Role' }}
                            </flux:button>
                            @if($isEditing)
                                <flux:button variant="ghost" type="button" wire:click="cancel">
                                    Cancel
                                </flux:button>
                            @endif
                        </div>
                    </form>
                </flux:card.content>
            </flux:card>

            <!-- Roles Table -->
            <flux:table>
                <flux:table.header>
                    <flux:table.row>
                        <flux:table.cell>Role</flux:table.cell>
                        <flux:table.cell>Permissions</flux:table.cell>
                        <flux:table.cell>Users</flux:table.cell>
                        <flux:table.cell>Actions</flux:table.cell>
                    </flux:table.row>
                </flux:table.header>
                
                <flux:table.body>
                    @forelse($roles as $role)
                        <flux:table.row>
                            <flux:table.cell>
                                <div>
                                    <div class="font-medium capitalize">{{ $role->name }}</div>
                                    @if($role->description)
                                        <div class="text-sm text-gray-500">{{ $role->description }}</div>
                                    @endif
                                </div>
                            </flux:table.cell>
                            <flux:table.cell>
                                <div class="flex flex-wrap gap-1">
                                    @foreach($role->permissions as $permission)
                                        <flux:badge size="sm">
                                            {{ ucfirst(str_replace('.', ' ', $permission->name)) }}
                                        </flux:badge>
                                    @endforeach
                                </div>
                            </flux:table.cell>
                            <flux:table.cell>
                                <flux:badge size="sm" variant="info">
                                    {{ $role->users->count() }} users
                                </flux:badge>
                            </flux:table.cell>
                            <flux:table.cell>
                                <flux:dropdown>
                                    <flux:dropdown.trigger>
                                        <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" />
                                    </flux:dropdown.trigger>
                                    <flux:dropdown.menu>
                                        <flux:dropdown.item wire:click="editRole({{ $role->id }})">
                                            Edit
                                        </flux:dropdown.item>
                                        @if($role->users->count() === 0)
                                            <flux:dropdown.separator />
                                            <flux:dropdown.item 
                                                variant="danger"
                                                wire:click="deleteRole({{ $role->id }})"
                                                wire:confirm="Are you sure you want to delete this role?"
                                            >
                                                Delete
                                            </flux:dropdown.item>
                                        @endif
                                    </flux:dropdown.menu>
                                </flux:dropdown>
                            </flux:table.cell>
                        </flux:table.row>
                    @empty
                        <flux:table.row>
                            <flux:table.cell colspan="4">
                                <flux:empty
                                    icon="shield-check"
                                    title="No roles found"
                                    description="No roles have been created yet."
                                />
                            </flux:table.cell>
                        </flux:table.row>
                    @endforelse
                </flux:table.body>
            </flux:table>

            <!-- Pagination -->
            {{ $roles->links() }}
        </flux:segment>
    </flux:container>
</div>
