<?php

namespace App\Http\Livewire\Genre;

use App\Models\Genre;
use Livewire\Component;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Create extends Component
{
    use LivewireAlert;
    
    public $name,
        $slug,
        $modal = false;

    public $rules = [
        'name' => 'required|min:3|unique:genres,name',
    ];

    public $listeners = [
        'openModal' => 'openModal'
    ];

    public function render()
    {
        return view('livewire.genre.create');
    }

    public function save()
    {
        $this->validate();

        Genre::create([
            'name' => $this->name,
            'slug' => $this->setSlugAttribute($this->name)
        ]);

        $this->modal = false;
        $this->dispatchBrowserEvent('close');
        $this->emit('closeModal');
        $this->alert('success', 'Success create genre');
        $this->reset(['name']);
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

    public function openModal()
    {
        $this->modal = !$this->modal;
    }
}
