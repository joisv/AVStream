<?php

namespace App\Http\Livewire\Home;

use App\Models\Post;
use Livewire\Component;

class NewRelease extends Component
{
    public $posts,
        $isLoading = true,
        $take = 8;

    public function render()
    {
        return view('livewire.home.new-release');
    }

    public function getPosts()
    {
        $this->posts = Post::latest('id')->take($this->take)->get();
        $this->isLoading = false;
        $this->dispatchBrowserEvent('finish-load');
    }

    public function loadMore()
    {
        $this->isLoading = true;
        $this->take += 4;
        $this->getPosts();
    }
}
