<?php

namespace App\Http\Livewire\Home;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SavedPost extends Component
{
    public $search,
        $sort = 'created_at';

    public function render()
    {
        return view('livewire.home.saved-post', [
            'posts' => Auth::user()->savedPosts()->search('title', $this->search)->orderBy($this->sort, 'asc')->paginate(12)
        ]);
    }
}
