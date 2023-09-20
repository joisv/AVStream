<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    use LivewireAlert;

    public $search = '',
        $sortField = 'created_at',
        $isPaginate = 10,
        $sortDirection = 'desc',
        $postCount,
        $postViewCount,
        $postLatestUpdated;

    public $listeners = ['destroy' => 'destroy'];

    protected $queryString = ['sortField', 'sortDirection', 'isPaginate'];


    public function sortBy($field)
    {

        if ($this->sortField === $field) {

            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {

            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function render()
    {
        return view('livewire.post.index', [
            'posts' => Post::search('title', $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate($this->isPaginate),
        ]);
    }

    public function getPostCount()
    {
        $postInfo = Post::selectRaw('COUNT(*) as postCount, SUM(views) as postViewCount, MAX(title) as postLatestUpdated')
            ->first();

        $this->postCount = $postInfo->postCount;
        $this->postViewCount = $postInfo->postViewCount;
        $this->postLatestUpdated = $postInfo->postLatestUpdated;
    }
    
    public function destroyAlert($post)
    {
        $this->alert('warning', 'delete this post ?', [
            'position' => 'top-end',
            'timer' => '',
            'toast' => true,
            'showConfirmButton' => true,
            'onConfirmed' => 'destroy',
            'showCancelButton' => true,
            'onDismissed' => '',
            'data' => [
                'post' => $post
            ]
        ]);
    }

    public function destroy($data)
    {
        $id = $data['data']['post'];
        try {

            $post = Post::find($id);
            Gate::authorize('delete', $post);
            $post->delete();
            Storage::delete($post->poster_path);
            $this->emitSelf('closeModal');
            $this->alert('success', 'Deleted successfully', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        } catch (\Throwable $th) {
            $this->alert('error', 'Post not found', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        }
    }
}
