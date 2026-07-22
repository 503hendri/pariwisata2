<?php

namespace App\Livewire\Settings\Users;

use App\Models\User;
use App\Models\UserActivity;
use Spatie\Permission\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

class UserManagement extends Component
{
    use WithPagination;

    public string $search = '';
    public string $roleFilter = 'all';
    public string $statusFilter = 'all';
    public array $selectedUsers = [];
    public bool $selectAll = false;

    public bool $showUserForm = false;
    public bool $showUserDeleteModal = false;
    public ?User $editingUser = null;
    public ?User $deletingUser = null;

    protected $paginationTheme = 'tailwind';

    protected $listeners = [
        'userCreated' => '$refresh',
        'userUpdated' => '$refresh',
        'userDeleted' => '$refresh',
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedRoleFilter()
    {
        $this->resetPage();
    }

    public function updatedStatusFilter()
    {
        $this->resetPage();
    }

    public function updatedSelectAll()
    {
        if ($this->selectAll) {
            $this->selectedUsers = $this->users->pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selectedUsers = [];
        }
    }

    public function updatedSelectedUsers()
    {
        $this->selectAll = false;
    }

    #[Computed]
    public function users()
    {
        return User::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->roleFilter !== 'all', function ($query) {
                $query->role($this->roleFilter);
            })
            ->when($this->statusFilter !== 'all', function ($query) {
                $query->where('is_active', $this->statusFilter === 'active');
            })
            ->with('roles')
            ->orderBy('name')
            ->paginate(10);
    }

    #[Computed]
    public function roles()
    {
        return Role::all();
    }

    public function toggleUserStatus($userId)
    {
        $user = User::findOrFail($userId);
        $user->update(['is_active' => !$user->is_active]);
        
        UserActivity::log(
            'user_status_toggled',
            "User {$user->name} status changed to " . ($user->is_active ? 'active' : 'inactive'),
            ['user_id' => $user->id, 'new_status' => $user->is_active]
        );
        
        $this->dispatch('userUpdated');
    }

    public function bulkActivate()
    {
        $count = User::whereIn('id', $this->selectedUsers)->update(['is_active' => true]);
        
        UserActivity::log(
            'users_bulk_activated',
            "Bulk activated {$count} users",
            ['user_ids' => $this->selectedUsers, 'count' => $count]
        );
        
        $this->selectedUsers = [];
        $this->selectAll = false;
        $this->dispatch('userUpdated');
    }

    public function bulkDeactivate()
    {
        $count = User::whereIn('id', $this->selectedUsers)->update(['is_active' => false]);
        
        UserActivity::log(
            'users_bulk_deactivated',
            "Bulk deactivated {$count} users",
            ['user_ids' => $this->selectedUsers, 'count' => $count]
        );
        
        $this->selectedUsers = [];
        $this->selectAll = false;
        $this->dispatch('userUpdated');
    }

    public function bulkDelete()
    {
        $users = User::whereIn('id', $this->selectedUsers)->get();
        $deletedCount = 0;
        
        foreach ($users as $user) {
            if ($user->id !== auth()->id()) {
                $user->delete();
                $deletedCount++;
            }
        }
        
        if ($deletedCount > 0) {
            UserActivity::log(
                'users_bulk_deleted',
                "Bulk deleted {$deletedCount} users",
                ['user_ids' => $this->selectedUsers, 'count' => $deletedCount]
            );
        }
        
        $this->selectedUsers = [];
        $this->selectAll = false;
        $this->dispatch('userDeleted');
    }

    public function exportUsers($format = 'csv')
    {
        return redirect()->route('users.export', [
            'search' => $this->search,
            'role' => $this->roleFilter,
            'status' => $this->statusFilter,
            'format' => $format,
        ]);
    }

    public function loadUser($userId)
    {
        $this->editingUser = User::find($userId);
    }

    public function loadUserForDeletion($userId)
    {
        $this->deletingUser = User::find($userId);
    }

    public function render()
    {
        return view('livewire.settings.users.user-management');
    }
}
