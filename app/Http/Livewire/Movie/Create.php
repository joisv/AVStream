<?php

namespace App\Http\Livewire\Movie;

use App\Models\Movie;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Create extends Component
{   
    use LivewireAlert;
    public Post $post;
    
    public $players = [
        ['player' => 'youtube', 'name' => 'Youtube'],
        ['player' => 'hls', 'name' => 'Hls (.m3u8)'],
        ['player' => 'embed', 'name' => 'Embed'],
        ['player' => 'direct', 'name' => 'Direct (.mp4, .mkv etc..)'],
    ];

    public $movies = [
        [
            'name' => '', 
            'url_movie' => '',
            'isVip' => false,
            'user_id' => '',
            'player' => 'embed'
        ]
    ];

    public $modal = false,
        $search,
        $post_id,
        $title;

    public $listeners = ['openModal' => 'openModal'];

    public function updated($propertyName)
    {
        if ($this->post_id) {

            $post = Post::findOrFail($this->post_id);
            $this->title = $post->title;
        }
    }

    public function render()
    {
        return view('livewire.movie.create', [
            'posts' => Post::search('title', $this->search)->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function save()
    {
        Gate::authorize('create', Movie::class);
        
        $this->validate([
            'movies.*.name' => 'required|string|max:255',
            'movies.*.url_movie' => 'required|url|max:255',
            'post_id' => 'required',
            'players.*.player' => 'required'
        ]);

        foreach ($this->movies as $item) {
            Movie::create([
                'name' => $item['name'],
                'url_movie' => $item['url_movie'],
                'isVip' => $item['isVip'],
                'user_id' => auth()->user()->id,
                'post_id' => $this->post_id,
                'player' => $item['player']
            ]);
        }

        $this->modal = false;
        $this->emit('closeModal');
        $this->alert('success', 'Sucessfully created embed');
        $this->reset(['title', 'post_id']);
        $this->resetMovies();
    }

    public function openModal()
    {
        $this->modal = !$this->modal;
    }

    public function addMovie()
    {
        $this->movies[] = ['name' => '', 'url_movie' => '', 'isVip' => false, 'user_id' => '', 'player' => 'embed'];
    }

    public function deleteMovie($index)
    {
        unset($this->movies[$index]);
        $this->movies = array_values($this->movies); // Reset array keys
    }
    public function deleteSelected()
    {
        $this->reset(['post_id', 'title']);
    }

    public function resetMovies()
    {
        $this->movies = [
            ['name' => '', 'url_movie' => '', 'isVip' => false, 'user_id' => '', 'player' => '']
        ];
    }

    
}
