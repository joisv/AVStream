<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Validation\Rules\Password;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Ramsey\Uuid\Uuid;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    use LivewireAlert;
    
    public $modal = false,
        $name,
        $password,
        $email,
        $confirm_password,
        $role;

    public $listeners = [
        'openModal' => 'openModal'
    ];

    public $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:' . User::class,
        'password' => 'required|min:8',
        'confirm_password' => 'required|same:password'
    ];

    public function render()
    {
        return view('livewire.user.create', [
            'roles' => Role::all()
        ]);
    }

    public function save()
    {
        Gate::authorize('create', auth()->user());
        
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'id' => Uuid::uuid4()->toString(),
            'password' => Hash::make($this->password),
        ]);

        if($this->role){
            $user->assignRole($this->role);
        }

        $this->openModal();
        $this->emit('closeModal');
        $this->alert('success', 'User created successfully');
        $this->reset(['name', 'email', 'password', 'role']);
    }

    public function openModal()
    {
        $this->modal = !$this->modal;
    }
}
