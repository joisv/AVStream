<?php

namespace App\Http\Livewire\Genre;

use App\Models\Genre;
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
        $genreUpdate,
        $genreCount,
        $sortDirection = 'desc';
    
    public function render()
    {
        return view('livewire.genre.index', [
            'genres' => Genre::search('name', $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate($this->isPaginate)
        ]);
    }

    public function getPostCount()
    {
        $postInfo = Genre::selectRaw('COUNT(*) as postCount, MAX(name) as postLatestUpdated')
            ->first();

        $this->genreCount = $postInfo->postCount;
        $this->genreUpdate = $postInfo->postLatestUpdated;
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
        notify()->success('genre created succesfully');
    }

    public function toggleModal($genre)
    {
        $this->emit('editId', $genre);
    }

    public function createModal()
    {
        $this->emit('openModal');
    }

    public function destroyAlert($genre)
    {
        $this->alert('warning', 'delete this genre ?', [
            'position' => 'top-end',
            'timer' => '',
            'toast' => true,
            'showConfirmButton' => true,
            'onConfirmed' => 'destroy',
            'showCancelButton' => true,
            'onDismissed' => '',
            'data' => [
                'genre' => $genre
            ]
        ]);
    }

    public function destroy($data)
    {
        $id = $data['data']['genre'];
        try {
            $genre = Genre::find($id);
            $genre->delete();
            $this->emitSelf('closeModal');
            $this->alert('success', 'Deleted successfully', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        } catch (\Throwable $th) {
            $this->alert('error', 'Genre not found', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        }
        
    }
}
