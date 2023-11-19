<?php

namespace App\Http\Livewire\Category;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Create extends Component
{
    use LivewireAlert;
    
    public $name;

    public $rules = [
        'name' => 'required|min:3|unique:categories,name'
    ];

    public function render()
    {
        return view('livewire.category.create');
    }

    public function save()
    {

        $this->validate();

        Category::create([
            'name' => $this->name,
            'slug' => $this->setSlugAttribute($this->name)
        ]);

        $this->dispatchBrowserEvent('close');
        $this->emit('closeModal');
        $this->alert('success', 'Success created category');
        $this->reset('name');
    }

    public function setSlugAttribute($value)
    {
        $slug = Str::slug($value);
        $originalSlug = $slug;
        $count = 2;

        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
