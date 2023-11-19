<?php

namespace App\Http\Livewire\Actress;

use App\Models\Actress;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $search = '',
        $sortField = 'created_at',
        $isPaginate = 10,
        $modal = false,
        $actressCount,
        $latesActressUpdated,
        $sortDirection = 'desc';

    protected $listeners = ['closeModal' => 'refreshData' , 'destroy' => 'destroy'];

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
        return view('livewire.actress.index', [
            'actress' => Actress::search('name', $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate($this->isPaginate)
        ]);
    }

    public function mount()
    {
        
    }
    
    public function getActressCount()
    {
        $actressInfo = Actress::selectRaw('COUNT(*) as postCount, MAX(name) as postLatestUpdated')
        ->first();
        $this->actressCount = $actressInfo->postCount;
        $this->latesActressUpdated = $actressInfo->postLatestUpdated;

    }
    
    public function mdll() {
        $this->dispatchBrowserEvent('modall');
    }
    
    public function destroyAlert($actress)
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
                'actress' => $actress
            ]
        ]);
    }

    public function destroy($data)
    {
        $id = $data['data']['actress'];
        try {
            $actress = Actress::find($id);
            $actress->delete();
            if ($actress->profile) {
                Storage::delete($actress->profile);
            }
            $this->emitSelf('closeModal');
            $this->alert('success', 'Deleted successfully', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        } catch (\Throwable $th) {
            $this->alert('error', 'Actress not found', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        }

        
    }

    public function refreshData()
    {
        $this->modal = false;
    }

    public function toggleModal($actres)
    {
        $this->modal = true;

        $this->emit('editId', $actres);
    }
}
