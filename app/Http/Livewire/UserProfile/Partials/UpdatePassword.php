<?php

namespace App\Http\Livewire\UserProfile\Partials;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class UpdatePassword extends Component
{
    use LivewireAlert;
    public User $user;

    public $current_password;
    public $password;
    public $password_confirmation;

    public $rules = [
        'password' => 'required|min:8',
        'password_confirmation' => 'required|min:8|same:password'
    ];

    public function render()
    {
        return view('livewire.user-profile.partials.update-password');
    }

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function save()
    {
        $this->validate();

        if (!Hash::check($this->current_password, $this->user->password)) {
            $this->addError('current_password', 'Current password is incorrect.');
            return;
        }

        $this->user->update([
            'password' => Hash::make($this->password),
        ]);

        $this->alert('success', 'Updated password successfully', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
        ]);

        $this->reset(['password_confirmation','password', 'current_password']);
    }
}
