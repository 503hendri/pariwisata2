<?php

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Models\Role;

new class extends Component
{
    public $search = '';

    public $userIdToDelete = null;
    
    public $userIdToReset = null;

    public ?User $editingUser = null;

    #[Computed]
    public function user()
    {
        return $this->editingUser;
    }

    #[Computed]
    public function roles()
    {
        return Role::get();
    }

    #[Validate('required|string|max:255')]
    public $name = '';

    #[Validate('required|unique:users,email|email|max:255')]
    public $email = '';

    #[Validate('required|string|min:8|confirmed')]
    public $password = '';

    public $password_confirmation = '';
    
    // #[Validate('required|string|min:8')]
    public $newPassword = '';
    
    // #[Validate('required|string|min:8|same:newPassword')]
    public $confirmPassword = '';

    #[Validate('required|string|exists:roles,name')]
    public $role = '';

    #[Computed]
    public function users()
    {
        return User::where('name', 'like', '%'.$this->search.'%')
            ->orWhere('email', 'like', '%'.$this->search.'%')
            ->paginate(10);
    }

    public function clear()
    {
        $this->reset();
    }

    public function deleteUser($id)
    {
        if ($id === auth()->id()) {
            Flux::toast(
                heading: 'Error',
                text: 'You cannot delete yourself',
                variant: 'error',
            );

            return;
        }

        $this->userIdToDelete = $id;

        $this->modal('delete-user')->show();
    }

    public function updateUser($id)
    {
        $this->editingUser = User::find($id);

        $this->fill($this->editingUser->toArray());

        $this->role = $this->editingUser->roles->first()->name;

        $this->modal('add-user')->show();
    }

    public function resetPasswordModal($id)
    {
        $this->userIdToReset = $id;

        $this->modal('reset-password')->show();
    }

    public function save()
    {
        $this->validate();
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $user->assignRole($this->role);

        $this->modal('add-user')->close();

        Flux::toast(
            heading: 'Success',
            text: 'User created successfully',
            variant: 'success',
        );

        $this->reset();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|string|exists:roles,name',
        ]);

        $this->editingUser->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        $this->editingUser->assignRole($this->role);

        $this->modal('add-user')->close();

        Flux::toast(
            heading: 'Success',
            text: 'User updated successfully',
            variant: 'success',
        );

        $this->reset();
    }

    public function delete()
    {
        if ($this->userIdToDelete) {
            User::find($this->userIdToDelete)->delete();

            $this->userIdToDelete = null;

            $this->modal('delete-user')->close();

            Flux::toast(
                heading: 'Success',
                text: 'User deleted successfully',
                variant: 'success',
            );
        }
    }

    public function resetPassword()
    {
        $this->validate([
            'newPassword' => 'required|string|min:8',
            'confirmPassword' => 'required|string|min:8|same:newPassword',
        ]);

        User::find($this->userIdToReset)->update([
            'password' => bcrypt($this->newPassword),
        ]);

        $this->modal('reset-password')->close();

        Flux::toast(
            heading: 'Success',
            text: 'Password reset successfully',
            variant: 'success',
        );

        $this->reset();
    }
};
