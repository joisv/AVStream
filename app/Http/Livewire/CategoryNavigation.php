<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryNavigation extends Component
{
    public function render()
    {
        return view('livewire.category-navigation', ['categories' => Category::all()]);
    }
}
