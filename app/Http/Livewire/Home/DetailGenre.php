<?php

namespace App\Http\Livewire\Home;

use App\Models\Genre;
use Livewire\Component;

class DetailGenre extends Component
{
    public Genre $genre;

    public $sort = 'created_at';
    protected $queryString = ['sort'];
    
    public function render()
    {
        $genre = $this->genre;

        return view('livewire.home.detail-genre', [
            'genres' => $genre->posts()->orderBy($this->sort, 'desc')->paginate(12)
        ]);
    }
}
