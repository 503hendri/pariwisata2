<?php

namespace App\Livewire\Settings\Users;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleManagement extends Component
{
    use WithPagination;

    #[Validate('required|string|max:255|unique:roles,name')]
    public string $name = '';

    #[Validate('nullable|string')]
    public string $description = '';

    public array $selectedPermissions = [];
    public bool $isEditing = false;
    public ?Role $editingRole = null;

    protected $paginationTheme = 'tailwind';

    public function createRole()
    {
        $this->validate();

        $role = Role::create([
            'name' => strtolower($this->name),
            'description' => $this->description,
        ]);

        if (!empty($this->selectedPermissions)) {
            $role->syncPermissions($this->selectedPermissions);
        }

        $this->reset(['name', 'description', 'selectedPermissions']);
        $this->dispatch('roleCreated');
    }

    public function editRole($roleId)
    {
        $this->isEditing = true;
        $this->editingRole = Role::findOrFail($roleId);
        $this->name = $this->editingRole->name;
        $this->description = $this->editingRole->description ?? '';
        $this->selectedPermissions = $this->editingRole->permissions->pluck('name')->toArray();
    }

    public function updateRole()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $this->editingRole->id,
        ]);

        $this->editingRole->update([
            'name' => strtolower($this->name),
            'description' => $this->description,
        ]);

        $this->editingRole->syncPermissions($this->selectedPermissions);

        $this->cancel();
        $this->dispatch('roleUpdated');
    }

    public function deleteRole($roleId)
    {
        $role = Role::findOrFail($roleId);
        
        // Prevent deletion if role has users
        if ($role->users()->count() > 0) {
            $this->dispatch('error', 'Cannot delete role with assigned users.');
            return;
        }

        $role->delete();
        $this->dispatch('roleDeleted');
    }

    public function cancel()
    {
        $this->reset(['name', 'description', 'selectedPermissions', 'isEditing', 'editingRole']);
    }

    #[Computed]
    public function roles()
    {
        return Role::with('permissions', 'users')
            ->orderBy('name')
            ->paginate(10);
    }

    #[Computed]
    public function permissions()
    {
        return Permission::orderBy('name')->get()->groupBy(function ($permission) {
            $parts = explode('.', $permission->name);
            return $parts[0] ?? 'other';
        });
    }

    public function render()
    {
        return view('livewire.settings.users.role-management');
    }
}
