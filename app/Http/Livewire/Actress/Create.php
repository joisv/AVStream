<?php

namespace App\Http\Livewire\Actress;

use App\Models\Actress;
use Livewire\Component;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $name,
        $cup_size,
        $age,
        $profile,
        $debut,
        $height;

    // public bool $modal = false;

    // public $listeners = ['create' => 'toggleModal'];

    // public function toggleModal()
    // {
    //     $this->modal = true;
    // }

    public $rules = [
        'name' => 'unique:actresses,name|required|min:3|string',
        'cup_size' => 'required|regex:/^[A-Z]$/',
        'age' => 'required|integer',
        'height' => 'required|integer',
        'debut' => 'required|date_format:Y',
        'profile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ];

    public function render()
    {
        return view('livewire.actress.create');
    }

    public function save()
    {
        $this->validate();
        Actress::create([
            'name' => $this->name,
            'age' => $this->age,
            'cup_size' => $this->cup_size,
            'height' => $this->height,
            'slug' => $this->setSlugAttribute($this->name),
            'debut' => $this->debut,
            'profile' => $this->profile->store('profile'),
        ]);

        $this->dispatchBrowserEvent('mdd');
        $this->emit('closeModal');
        $this->alert('success', 'Actress succes created');
        $this->reset(['name', 'cup_size', 'age', 'profile', 'debut', 'height']);
    }
    
    public function setSlugAttribute($value)
    {
        $slug = Str::slug($value);
        $originalSlug = $slug;
        $count = 2;

        while (Actress::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
