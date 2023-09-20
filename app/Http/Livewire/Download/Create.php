<?php

namespace App\Http\Livewire\Download;

use App\Models\Download;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Create extends Component
{
    use LivewireAlert;
    public $downloads = [
        ['name' => '', 'url_download' => '', 'isVip' => false, 'user_id' => '']
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
    
    public function mount()
    {
        $this->reset(['post_id', 'title', 'search']);
    }
    
    public function render()
    {
        return view('livewire.download.create', [
            'posts' => Post::search('title', $this->search)->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function save()
    {
        Gate::authorize('create', Download::class);
        
        $this->validate([
            'downloads.*.name' => 'required|string|max:255',
            'downloads.*.url_download' => 'required|url|max:255',
            'post_id' => 'required'
        ]);

        foreach ($this->downloads as $item) {
            Download::create([
                'name' => $item['name'],
                'url_download' => $item['url_download'],
                'isVip' => $item['isVip'],
                'user_id' => auth()->user()->id,
                'post_id' => $this->post_id
            ]);
        }

        $this->modal = false;
        $this->emit('closeModal');
        $this->alert('success', 'Success create download');
        $this->reset(['title', 'post_id']);
        $this->resetDownloads();
    }

    public function openModal()
    {
        $this->modal = !$this->modal;
    }

    public function addDownload()
    {
        $this->downloads[] = ['name' => '', 'url_download' => '', 'isVip' => false, 'user_id' => ''];
    }

    public function deleteDownload($index)
    {
        unset($this->downloads[$index]);
        $this->downloads = array_values($this->downloads); // Reset array keys
    }
    public function deleteSelected()
    {
        $this->reset(['post_id', 'title']);
    }

    public function resetDownloads()
    {
        $this->downloads = [
            ['name' => '', 'url_download' => '', 'isVip' => false, 'user_id' => '']
        ];
    }
}
