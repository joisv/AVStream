<?php

namespace App\Http\Livewire\Home;

use App\Models\Genre;
use Livewire\Component;

class PopularGenres extends Component
{

    public $genres;
    
    public function render()
    {
        return view('livewire.home.popular-genres');
    }

    public function mount()
    {
        $this->genres = Genre::orderBy('views', 'desc')->take(10)->get();
    }
}
