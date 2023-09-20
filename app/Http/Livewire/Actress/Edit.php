<?php

namespace App\Http\Livewire\Actress;

use App\Models\Actress;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    public Actress $actress;

    public $name,
        $age,
        $cup_size,
        $profile,
        $height,
        $debut;

    public $rules = [
        'cup_size' => 'required|regex:/^[A-Z]$/',
        'age' => 'required|integer',
        'height' => 'required|integer',
        'debut' => 'required|date_format:Y',
        'profile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ];

    public $listeners = [

        'editId' => 'editId'

    ];

    protected function rules()
    {
        $profileRules = is_object($this->profile)
            ? 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            : '';
        $name = $this->name != $this->actress->name ? 'unique:actresses,name|required|min:3|string' : '';
        return array_merge($this->rules, ['profile' => $profileRules , 'name' => $name]);
    }

    public function save()
    {
        $this->validate();

        if ($this->actress) {
            $this->actress->update([
                'name' => $this->name,
                'age' => $this->age,
                'cup_size' => $this->cup_size,
                'height' => $this->height,
                'debut' => $this->debut,
                'profile' =>  is_object($this->profile) ? $this->deleteProfile() : $this->profile
            ]);
        }

        $this->emit('closeModal');
        $this->alert('success', 'Actress updated');
    }

    public function render()
    {
        return view('livewire.actress.edit');
    }

    public function editId(Actress $actress)
    {
        $this->actress = $actress;
        $this->name = $actress->name;
        $this->age = $actress->age;
        $this->cup_size = $actress->cup_size;
        $this->profile = $actress->profile;
        $this->height = $actress->height;
        $this->debut = $actress->debut;
    }


    public function deleteProfile()
    {
        $prof = $this->profile->store('profile');
        Storage::delete($this->actress->profile);

        return $prof;
    }
}
