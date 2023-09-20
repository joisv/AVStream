<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    use LivewireAlert;

    public User $user;
    public $modal = false,
        $name,
        $password,
        $email,
        $role,
        $user_roles;

    public $listeners = ['editId' => 'edit', 'removeThisRole' => 'removeThisRole'];

    public $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
    ];

    public function render()
    {
        return view('livewire.user.edit', [
            'roles' => Role::all()
        ]);
    }

    public function edit(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->role = $user->getRoleNames();
        $this->user_roles = $user->roles;
        $this->modal = true;
    }

    public function save()
    {
        Gate::authorize('update', $this->user);

        $this->validate();

        $this->user->email = $this->email;
        $this->user->name = $this->name;

        if ($this->user->isDirty('email')) {
            $this->validate(['email' => 'unique:users,email']);
        }

        $this->user->save();

        if ($this->role) {
            $this->user->assignRole($this->role);
        }

        $this->openModal();
        $this->emit('closeModal');
        $this->alert('success', 'Updated successfully');
        $this->reset(['name', 'email', 'role']);
    }

    public function openModal()
    {
        $this->modal = !$this->modal;
    }

    public function deleteUserRole($roleName)
    {
        if (auth()->user()->can('can user management')) {
            try {

                $this->alert('warning', 'delete this role?', [
                    'position' => 'top-end',
                    'timer' => '',
                    'toast' => true,
                    'showConfirmButton' => true,
                    'onConfirmed' => 'removeThisRole',
                    'showDenyButton' => true,
                    'onDenied' => '',
                    'data' => [
                        'roleName' => $roleName
                    ]
                ]);
            } catch (\Throwable $th) {
                $this->modal = false;
                $this->errorAlert('Something went wrong');
            }
        } else {
            $this->errorAlert('You dont have right permission');
        }
    }

    public function removeThisRole($data)
    {
        $roleName = $data['data']['roleName'];

        try {
            $this->user->removeRole($roleName);
            $this->modal = false;
            $this->alert('success', 'Deleted successfully', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        } catch (\Throwable $th) {
            $this->modal = false;
            $this->errorAlert('Something went wrong');
        }
    }

    public function errorAlert($message)
    {
        return $this->alert('error', $message, [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
        ]);
    }
}
