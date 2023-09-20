<?php

namespace App\Http\Livewire\Watch;

use App\Models\Genre;
use App\Models\Post;
use Livewire\Component;

class Recomendation extends Component
{
    public $recomendations;
    
    public function render()
    {
        return view('livewire.watch.recomendation');
    }

    public function getRecomendations()
    {
        $random = Genre::inRandomOrder()->first();
        $this->recomendations = $random->posts->take(8);
    }
}
