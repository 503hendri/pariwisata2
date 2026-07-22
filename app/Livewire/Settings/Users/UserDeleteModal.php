<?php

namespace App\Livewire\Settings\Users;

use App\Models\User;
use App\Models\UserActivity;
use Livewire\Component;

class UserDeleteModal extends Component
{
    public ?User $user = null;
    public string $confirmName = '';

    public function mount(?User $user)
    {
        $this->user = $user;
    }

    public function deleteUser()
    {
        if ($this->user->id === auth()->id()) {
            $this->dispatch('error', 'You cannot delete your own account.');
            return;
        }

        if (strtolower($this->confirmName) !== strtolower($this->user->name)) {
            $this->dispatch('error', 'Please type the user name correctly to confirm deletion.');
            return;
        }

        $userName = $this->user->name;
        $userId = $this->user->id;
        
        $this->user->delete();

        UserActivity::log(
            'user_deleted',
            "Deleted user: {$userName}",
            ['user_id' => $userId, 'name' => $userName]
        );

        $this->dispatch('userDeleted');
        $this->dispatch('close-modal');
        $this->reset();
    }

    public function cancel()
    {
        $this->dispatch('close-modal');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.settings.users.user-delete-modal');
    }
}
