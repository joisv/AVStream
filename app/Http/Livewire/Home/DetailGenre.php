<?php

namespace App\Http\Livewire\Home;

use App\Models\Genre;
use Livewire\Component;
use Livewire\WithPagination;

class DetailGenre extends Component
{
    use WithPagination;
    
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
