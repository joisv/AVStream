<?php

namespace App\Http\Livewire\Home;

use App\Models\Category as ModelsCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;
    
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
