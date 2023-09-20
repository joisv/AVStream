<?php

namespace App\Http\Livewire\Category;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use LivewireAlert;
    
    public Category $categories;

    public $name,
        $slug;

    public $listeners = [

        'editId' => 'editId'

    ];

    public $rules = [
        'name' => 'required|min:3|unique:categories,name'
    ];

    public function render()
    {
        return view('livewire.category.edit');
    }

    public function save()
    {
        $this->validate();

        $this->categories->update([
            'name' => $this->name,
            'slug' => $this->setSlugAttribute($this->name)
        ]);

        $this->emit('closeModal');
        $this->alert('success', 'Updated successfully');
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

    public function editId(Category $category)
    {

        $this->categories = $category;

        $this->name = $category->name;
        $this->slug = $category->slug;
    }
}
