<?php

namespace App\Http\Livewire\Home;

use App\Models\Post;
use Livewire\Component;

class RecentUpdate extends Component
{
    public $posts,
        $isLoading = true,
        $take = 4;

    public function render()
    {
        return view('livewire.home.recent-update');
    }

    public function getPosts()
    {
        $this->posts = Post::orderBy('updated_at', 'desc')->take($this->take)->get();
        $this->isLoading = false;
    }

    public function loadMore()
    {
        $this->isLoading = true;
        $this->take *= 2;
        $this->getPosts();
    }
}
