<?php

namespace App\Http\Livewire\Home;

use App\Models\Genre;
use Livewire\Component;
use Livewire\WithPagination;

class Genres extends Component
{
    use WithPagination;
    
    public $search;
    
    public function updated()
    {
        $this->getGenres();
    } 
    
    public function render()
    {
        return view('livewire.home.genres', [
            'genres' => $this->getGenres()->paginate(12)
        ]);
    }

    public function getGenres()
    {
        return Genre::search(['name'], $this->search)->with('posts')->orderBy('name', 'asc');
    }
}
