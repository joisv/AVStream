<?php

namespace App\Http\Livewire\Studio;

use App\Models\Studio;
use Livewire\Component;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use LivewireAlert;
    
    public Studio $studio;
    public $name,
        $modal = false;

    public $rules = [
        'name' => 'required|min:3|unique:studios,name'
    ];

    public $listeners = ['editModal' => 'editModal'];

    public function render()
    {
        return view('livewire.studio.edit');
    }

    public function save()
    {
        $this->validate();

        $this->studio->update([
            'name' => $this->name,
            'slug' => $this->setSlugAttribute($this->name)
        ]);

        $this->modal = false;
        $this->emit('closeModal');
        $this->alert('success', 'Updated successfully');
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
    
    public function editModal(Studio $studio)
    {
        $this->studio = $studio;
        $this->name = $studio->name;
        $this->modal = true;
    }
}
