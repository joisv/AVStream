<?php

namespace App\Http\Livewire\Movie;

use App\Models\Movie;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Edit extends Component
{
    use LivewireAlert;
    public Movie $movie;

    public $movies = [
        ['name' => '', 'url_movie' => '' , 'isVip' => false, 'user_id' => '']
    ];

    public $modal = false,
        $search,
        $post_id,
        $title,
        $post;

    public $listeners = [
        'editMovie' => 'editMovie'
    ];

    public function render()
    {
        return view('livewire.movie.edit', [
            'posts' => Post::search('title', $this->search)->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function updated($propertyName)
    {
        if ($this->post_id) {

            $post = Post::findOrFail($this->post_id);
            $this->title = $post->title;
        }
    }
    
    public function save()
    {
        Gate::authorize('update', $this->movie);
        
        $this->validate([
            'movies.*.name' => 'required|string|max:255',
            'movies.*.url_movie' => 'required|url|max:255',
            'post_id' => 'required'
        ]);

        $this->movie->delete();
        
        foreach ($this->movies as $item) {
            Movie::create([
                'name' => $item['name'],
                'url_movie' => $item['url_movie'],
                'isVip' => $item['isVip'],
                'user_id' => $item['user_id'],
                'post_id' => $this->post_id
            ]);
        }

        $this->modal = false;
        $this->emit('closeModal');
        $this->alert('success', 'Embed updated');
        $this->reset(['title', 'post_id']);
        $this->resetMovies();
    }
    
    public function editMovie(Movie $editedMovie)
    {
        foreach ($this->movies as $index => $movie) {
            $this->movies[$index]['name'] = $editedMovie->name;
            $this->movies[$index]['url_movie'] = $editedMovie->url_movie;
            $this->movies[$index]['isVip'] = $editedMovie->isVip;
            $this->movies[$index]['user_id'] = $editedMovie->user_id;
        }
        $this->movie = $editedMovie;
        $this->post_id = $editedMovie->post_id;
        $this->title = $editedMovie->post->title;
        $this->modal = true;
    }

    public function addMovie()
    {
        $this->movies[] = ['name' => '', 'url_movie' => '' , 'isVip' => false, 'user_id' => ''];
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
            ['name' => '', 'url_movie' => '' , 'isVip' => false, 'user_id' => '']
        ];
    }
}
