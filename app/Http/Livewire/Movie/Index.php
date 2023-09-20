<?php

namespace App\Http\Livewire\Movie;

use App\Models\Movie;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use LivewireAlert;
    
    public $listeners = ['closeModal' => 'refreshData', 'destroy' => 'destroy'];

    public $search = '',
        $sortField = 'created_at',
        $isPaginate = 10,
        $embedCount,
        $sortDirection = 'desc';

    public function render()
    {
        $query = Movie::with(['post', 'user' => function ($q) {
            $q->orderBy('created_at', 'desc');
        }])->orderBy($this->sortField, $this->sortDirection);

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhereHas('post', function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('user', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
        }

        $movies = $query->paginate($this->isPaginate);

        return view('livewire.movie.index', [
            'movies' => $movies
        ]);
    }

    public function sortBy($field)
    {

        if ($this->sortField === $field) {

            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {

            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function refreshData()
    {
    }

    public function getPostCount()
    {
        $postInfo = Movie::selectRaw('COUNT(*) as postCount, MAX(name) as postLatestUpdated')
            ->first();

        $this->embedCount = $postInfo->postCount;
    }
    
    public function destroyAlert($embed)
    {
        $this->alert('warning', 'delete this embed ?', [
            'position' => 'top-end',
            'timer' => '',
            'toast' => true,
            'showConfirmButton' => true,
            'onConfirmed' => 'destroy',
            'showCancelButton' => true,
            'onDismissed' => '',
            'data' => [
                'embed' => $embed
            ]
        ]);
    }

    public function destroy($data)
    {
        $id = $data['data']['embed'];
        try {
            $embed = Movie::findOrFail($id);
            Gate::authorize('delete', $embed);
            $embed->delete();
            $this->emitSelf('closeModal');
            $this->alert('success', 'Deleted successfully', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        } catch (\Throwable $th) {
            $this->alert('error', 'Embed not found', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        }

        
    }
    
    // public function destroy($param)
    // {
    //     $embed = Movie::findOrFail($param);
    //     Gate::authorize('delete', $embed);
    //     $embed->delete();
    //     $this->emit('showAlert');
    // }

    public function createModal()
    {
        $this->emit('openModal');
    }

    public function editModal(Movie $movie)
    {
        $this->emit('editMovie', $movie);
    }
}
