<?php

namespace App\Http\Livewire\Post;

use App\Models\Actress;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Post;
use App\Models\Studio;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public Post $post;
    public $title,
        $overview,
        $poster_path,
        $category_id,
        $search,
        $searchGenre,
        $searchStudio,
        $code,
        $modal = false,
        $isVip = false;

    public $selectedActresses = [];
    public $selectedGenres = [];
    public $selectedStudio = [];
    
    protected $rules = [

        'title' => 'required|min:6|string',
        'overview' => 'required|min:3|string',
        'category_id' => 'required'
    ];

    protected function rules()
    {
        $poster_path = is_object($this->poster_path)
            ? 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
            : '';

        return array_merge($this->rules, ['poster_path' => $poster_path]);
    }

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->code = $post->code;
        $this->isVip = $post->isVip;
        $this->overview = $post->overview;
        $this->category_id = $post->category_id;
        $this->poster_path = $post->poster_path;
        $this->selectedActresses = $post->actresses->pluck('id')->toArray();
        $this->selectedGenres = $post->genres->pluck('id')->toArray();
        $this->selectedStudio = $post->studios->pluck('id')->toArray();
    }

    public function render()
    {
        
        return view('livewire.post.edit', [
            'actresses' => Actress::search('name', $this->search)->get(),
            'categories' => Category::all(),
            'genres' => Genre::search('name', $this->searchGenre)->get(),
            'studios' => Studio::search('name', $this->searchStudio)->get(),
        ]);
    }

    public function deletePoster($poster)
    {
        if (is_object($poster)) {

            $this->poster_path = '';
        } elseif (Str::startsWith($poster, 'poster_path')) {

            $this->post->update([
                'poster_path' => '',
            ]);
            Storage::delete($this->post->poster_path);
            $this->alert('success', 'Poster path has been deleted successfully.');
        } else {
            $this->alert('error', 'No poster found');
        }
    }
    
    public function showAlert($message)
    {
        $this->dispatchBrowserEvent('showAlert', ['message' => $message]);
    }

    public function save()
    {
        Gate::authorize('update', $this->post);

        $this->validate();
        $poster = is_object($this->poster_path) ? $this->deletePosterPath() : $this->poster_path;

        if ($this->post) {
            $this->post->update([
                'title' => $this->title,
                'overview' => $this->overview,
                'code' => $this->code,
                'isVip' => $this->isVip,
                'category_id' => $this->category_id,
                'slug' => $this->setSlugAttribute($this->title),
                'poster_path' =>  $poster
            ]);
            if ($this->selectedActresses) {
                $this->post->actresses()->sync($this->selectedActresses);
            }
            if ($this->selectedGenres) {
                $this->post->genres()->sync($this->selectedGenres);
            }
            if ($this->selectedStudio) {
                $this->post->studios()->sync($this->selectedStudio);
            }
            session()->flash('message', 'Post successfully updated.');
            return redirect()->route('post');
        }
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

    public function deletePosterPath()
    {
        $prof = $this->poster_path->store('poster_path');
        Storage::delete($this->post->poster_path);
        return $prof;
    }
    
}
