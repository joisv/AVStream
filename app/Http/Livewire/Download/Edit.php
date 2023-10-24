<?php

namespace App\Http\Livewire\Download;

use App\Models\Download;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Edit extends Component
{
    use LivewireAlert;
    public Download $download;

    public $downloads = [
        ['name' => '', 'url_download' => '', 'isVip' => false, 'user_id' => '']
    ];

    public $modal = false,
        $search,
        $post_id,
        $title,
        $post;

    public $listeners = [
        'editDownload' => 'editDownload'
    ];

    public function render()
    {
        return view('livewire.download.edit', [
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
        Gate::authorize('update', $this->download);
        
        $this->validate([
            'downloads.*.name' => 'required|string|max:255',
            'downloads.*.url_download' => 'required|url|max:255',
            'post_id' => 'required'
        ]);

        $this->download->delete();
        
        foreach ($this->downloads as $item) {
            Download::create([
                'name' => $item['name'],
                'url_download' => $item['url_download'],
                'isVip' => $item['isVip'],
                'user_id' => $item['user_id'],
                'post_id' => $this->post_id
            ]);
        }

        $this->modal = false;
        $this->emit('closeModal');
        $this->alert('success', 'Download updated');
        $this->reset(['title', 'post_id']);
        $this->resetDownloads();
    }
    
    public function editDownload(Download $editedDownload)
    {
        foreach ($this->downloads as $index => $movie) {
            $this->downloads[$index]['name'] = $editedDownload->name;
            $this->downloads[$index]['url_download'] = $editedDownload->url_download;
            $this->downloads[$index]['isVip'] = $editedDownload->isVip;
            $this->downloads[$index]['user_id'] = $editedDownload->user_id;
        }
        $this->download = $editedDownload;
        $this->post_id = $editedDownload->post_id;
        $this->title = $editedDownload->post->title;
        $this->modal = true;
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
