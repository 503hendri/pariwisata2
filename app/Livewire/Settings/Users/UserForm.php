<?php

namespace App\Livewire\Settings\Users;

use App\Models\User;
use App\Models\UserActivity;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserForm extends Component
{
    public ?User $user = null;
    public bool $isEditing = false;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|email|max:255|unique:users,email')]
    public string $email = '';

    #[Validate('nullable|string|min:8')]
    public string $password = '';

    #[Validate('required|string|confirmed')]
    public string $password_confirmation = '';

    #[Validate('nullable|array')]
    public array $roles = [];

    #[Validate('boolean')]
    public bool $is_active = true;

    public function mount(?User $user = null)
    {
        if ($user) {
            $this->user = $user;
            $this->isEditing = true;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->is_active = $user->is_active;
            $this->roles = $user->roles->pluck('name')->toArray();
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditing) {
            $this->updateUser();
        } else {
            $this->createUser();
        }
    }

    protected function createUser()
    {
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'is_active' => $this->is_active,
        ]);

        if (!empty($this->roles)) {
            $user->syncRoles($this->roles);
        }

        UserActivity::log(
            'user_created',
            "Created new user: {$user->name}",
            ['user_id' => $user->id, 'email' => $user->email, 'roles' => $this->roles]
        );

        $this->dispatch('userCreated');
        $this->dispatch('close-modal');
        $this->reset();
    }

    protected function updateUser()
    {
        $updateData = [
            'name' => $this->name,
            'email' => $this->email,
            'is_active' => $this->is_active,
        ];

        if (!empty($this->password)) {
            $updateData['password'] = Hash::make($this->password);
        }

        $this->user->update($updateData);
        $this->user->syncRoles($this->roles);

        UserActivity::log(
            'user_updated',
            "Updated user: {$this->user->name}",
            ['user_id' => $this->user->id, 'changes' => $updateData, 'roles' => $this->roles]
        );

        $this->dispatch('userUpdated');
        $this->dispatch('close-modal');
        $this->reset();
    }

    public function cancel()
    {
        $this->dispatch('close-modal');
        $this->reset();
    }

    public function generatePassword()
    {
        $this->password = Str::password(12);
        $this->password_confirmation = $this->password;
    }

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user?->id),
            ],
            'roles' => 'nullable|array',
            'is_active' => 'boolean',
        ];

        if (!$this->isEditing) {
            $rules['password'] = 'required|string|min:8|confirmed';
            $rules['password_confirmation'] = 'required|string';
        } else {
            $rules['password'] = 'nullable|string|min:8|confirmed';
            $rules['password_confirmation'] = 'nullable|string|required_with:password';
        }

        return $rules;
    }

    public function render()
    {
        return view('livewire.settings.users.user-form', [
            'availableRoles' => \Spatie\Permission\Models\Role::pluck('name', 'name')->toArray(),
        ]);
    }
}
