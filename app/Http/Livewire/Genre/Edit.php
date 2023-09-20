<?php

namespace App\Http\Livewire\Genre;

use App\Models\Genre;
use Livewire\Component;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use LivewireAlert;
    
    public Genre $genre;
    public $name,
    $modal = false;

    public $rules = [
        'name' => 'required|min:3|unique:categories,name',
    ];


    public $listeners = ['editId' => 'edit'];
    
    public function render()
    {
        return view('livewire.genre.edit');
    }

    public function save()
    {
        $this->validate();

        $this->genre->update([
            'name' => $this->name,
            'slug' => $this->setSlugAttribute($this->name)
        ]);

        $this->modal = false;
        $this->alert('success', "Success updated genre");
        $this->emit('closeModal');
        $this->reset('name');
    }
    
    public function setSlugAttribute($value)
    {
        $slug = Str::slug($value);
        $originalSlug = $slug;
        $count = 2;

        while (Genre::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
    
    public function edit(Genre $genre) {
        
        $this->genre = $genre;
        $this->name = $genre->name;
        $this->modal = true;
        
    }
}
