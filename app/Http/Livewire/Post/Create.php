<?php

namespace App\Http\Livewire\Post;

use App\Models\Actress;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Post;
use App\Models\Studio;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Create extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    
    public $title,
        $overview,
        $poster_path,
        $slug,
        $search,
        $searchStudio,
        $searchGenre,
        $category_id,
        $modal = false,
        $isVip = false,
        $code;

    public $selectedActresses = [];
    public $selectedGenres = [];
    public $selectedStudio = [];

    protected $rules = [

        'title' => 'required|min:6|string',
        'overview' => 'required|min:3|string',
        'poster_path' => 'required|max:2048',
        'category_id' => 'required'

    ];

    public $listeners = [
        'closeModal' => 'clearModal'
    ];
    
    public function save()
    {
        Gate::authorize('create', Post::class);

        $this->validate();

       $post = Post::create([

            'title' => $this->title,
            'category_id' => $this->category_id,
            'code' => $this->code,
            'user_id' => auth()->user()->id,
            'overview' => $this->overview,
            'isVip' => $this->isVip,
            'poster_path' => $this->poster_path->store('poster_path'),
            'slug' => $this->setSlugAttribute($this->title)

        ]);
        
        if ($this->selectedActresses) {
            $post->actresses()->attach($this->selectedActresses);
        }
        if ($this->selectedGenres) {
            $post->genres()->attach($this->selectedGenres);
        }
        if ($this->selectedStudio) {
            $post->studios()->attach($this->selectedStudio);
        }

        redirect()->route('post')->with('message', 'Post successfully updated.');
    }

    public function setSlugAttribute($value)
    {
        $slug = Str::slug($value);
        $originalSlug = $slug;
        $count = 2;

        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    public function render()
    {
        return view('livewire.post.create', [
            'actresses' => Actress::search('name', $this->search)->get(),
            'categories' => Category::all(),
            'genres' => Genre::search('name', $this->searchGenre)->get(),
            'studios' => Studio::search('name', $this->searchStudio)->get()
        ]);
    }

    // public function createActress()
    // {
    //     $this->modal = true;
    // }

    // public function createGenre()
    // {
    //     $this->emitTo('genre.create', 'openModal');
    // }
    public function createStudio()
    {
        $this->emitTo('studio.create', 'createModal');
    }

    public function clearModal() 
    {
        $this->modal = false;
    }
}
