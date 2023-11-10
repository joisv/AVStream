<?php

namespace App\Http\Livewire\Movie;

use App\Models\Movie;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    public Post $post;

    public $modal = false,
        $search,
        $post_id,
        $title;

    public $players = [
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
            'player' => 'embed',
            'poster' => ''
        ]
    ];

    public function updated($propertyName)
    {
        if ($this->post_id) {

            $post = Post::findOrFail($this->post_id);
            $this->title = $post->title;
        }
    }
    
    protected function rules()
    {
        foreach ($this->movies as $index => $movie) {

            $poster_path = is_object($movie['poster'])
                ? 'nullable|required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
                : 'nullable|url';

            return array_merge($this->rules, ['movies.*.poster' => $poster_path]);
        }
    }

    protected $rules = [
        'movies.*.name' => 'required|string|max:255',
        'movies.*.url_movie' => 'required|url|max:255',
        'post_id' => 'required',
        'players.*.player' => 'required',
        'movies.*.poster' => 'nullable|required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
    ];

    public $listeners = ['openModal' => 'openModal'];

    public function render()
    {
        return view('livewire.movie.create', [
            'posts' => Post::search('title', $this->search)->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function save()
    {
        Gate::authorize('create', Movie::class);

        $this->validate();

        foreach ($this->movies as $item) {
            $poster = is_object($item['poster']) ? $this->deletePosterPath($item['poster']) : $item['poster'];

            Movie::create([
                'name' => $item['name'],
                'url_movie' => $item['url_movie'],
                'isVip' => $item['isVip'],
                'user_id' => auth()->user()->id,
                'post_id' => $this->post_id,
                'player' => $item['player'],
                'poster' => $poster
            ]);
        }

        $this->modal = false;
        $this->emit('closeModal');
        $this->alert('success', 'Sucessfully created embed');
        $this->reset(['title', 'post_id']);
        $this->resetMovies();
    }

    public function deletePosterPath($poster)
    {
        $prof = $poster->store('posters');
        return $prof;
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
