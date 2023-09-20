<?php

namespace App\Http\Livewire\Studio;

use App\Models\Studio;
use Livewire\Component;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Create extends Component
{
    use LivewireAlert;
    public $modal = false;
    public $name;

    public $rules = [
        'name' => 'required|min:3|unique:studios,name'
    ];

    public $listeners = ['createModal' => 'createModal'];
    
    public function render()
    {
        return view('livewire.studio.create');
    }

    public function save()
    {

        $this->validate();

        Studio::create([
            'name' => $this->name,
            'slug' => $this->setSlugAttribute($this->name)
        ]);

        $this->emit('closeModal');
        $this->modal = false;
        $this->alert('success', 'Created studio successfully');
        $this->reset('name');
    }

    public function setSlugAttribute($value)
    {
        $slug = Str::slug($value);
        $originalSlug = $slug;
        $count = 2;

        while (Studio::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
    
    public function createModal()
    {
        $this->modal = true;
    }
}
