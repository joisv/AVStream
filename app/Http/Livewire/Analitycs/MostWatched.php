<?php

namespace App\Http\Livewire\Analitycs;

use App\Models\Post;
use Livewire\Component;

class MostWatched extends Component
{
    public function render()
    {
        $topPosts = Post::orderBy('views', 'desc')
                ->take(10)
                ->get();
        
        return view('livewire.analitycs.most-watched', [
            'mostWatched' => $topPosts
        ]);
    }
}
