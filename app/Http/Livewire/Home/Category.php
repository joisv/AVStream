<?php

namespace App\Http\Livewire\Home;

use App\Models\Category as ModelsCategory;
use Livewire\Component;

class Category extends Component
{
    public ModelsCategory $category;
    public $sort = 'created_at';

    public $queryString = ['sort'];
    
    public function render()
    {
        $category = $this->category;
        
        return view('livewire.home.category', [
            'posts' => $category->posts()->orderBy($this->sort, 'desc')->paginate(12)
        ]);
    }
}
