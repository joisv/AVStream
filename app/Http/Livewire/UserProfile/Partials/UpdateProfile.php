<?php

namespace App\Http\Livewire\UserProfile\Partials;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class UpdateProfile extends Component
{
    use LivewireAlert;
    
    public User $user;

    public $name, $email;
    
    public $rules = [
        'email' => 'required|email|max:255'
    ];
    
    protected function rules()
    {
        $name = $this->name !== $this->user->name
            ? 'required|unique:users,name|min:3|max:255'
            : '';

        return array_merge($this->rules, ['name' => $name]);
    }
    
    public function render()
    {
        return view('livewire.user-profile.partials.update-profile');
    }

    public function save()
    {
        $this->validate();

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email
        ]);

        $this->alert('success', 'Profile updated successfully', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
        ]);

    }
    
    public function getUser()
    {
        $this->user = auth()->user();

        $this->name = $this->user->name;
        $this->email = $this->user->email;
        
    }
}
