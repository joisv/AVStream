<?php

namespace App\Http\Livewire\Home;

use App\Models\Post;
use Livewire\Component;

class Recomended extends Component
{
    public $posts,
        $isLoading = true,
        $take = 4;

    public function render()
    {
        return view('livewire.home.recomended');
    }

    public function getPosts()
    {
        $this->posts = Post::latest('id')->take($this->take)->get();
        $this->isLoading = false;
    }

    public function loadMore()
    {
        $this->isLoading = true;
        $this->take *= 2;
        $this->getPosts();
    }
}
