<?php

namespace App\Http\Livewire\Watch;

use App\Models\Post;
use Livewire\Component;

class Trending extends Component
{
    public $recomendations;

    public function getTrending()
    {
        $this->recomendations = Post::orderBy('views', 'desc')->take(8)->get();
        $this->dispatchBrowserEvent('finish-load');
    }
    
    public function render()
    {
        return view('livewire.watch.trending');
    }
}
