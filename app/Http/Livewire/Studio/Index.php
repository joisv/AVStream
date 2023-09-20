<?php

namespace App\Http\Livewire\Studio;

use App\Models\Studio;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Index extends Component
{
    use LivewireAlert;
    public $listeners = ['closeModal' => 'refreshData', 'destroy' => 'destroy'];

    public $search = '',
        $sortField = 'created_at',
        $isPaginate = 10,
        $studioCount,
        $studioUpdated,
        $sortDirection = 'desc';

    public function render()
    {
        return view('livewire.studio.index', [
            'studios' => Studio::search('name', $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate($this->isPaginate)
        ]);
    }

    public function destroyAlert($studio)
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
                'studio' => $studio
            ]
        ]);
    }

    public function destroy($data)
    {
        $id = $data['data']['studio'];
        try {
            $studio = Studio::find($id);
            $studio->delete();
            $this->emitSelf('closeModal');
            $this->alert('success', 'Deleted successfully', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        } catch (\Throwable $th) {
            $this->alert('error', 'Studio not found', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        }

        
    }
    
    public function getStudiotCount()
    {
        $postInfo = Studio::selectRaw('COUNT(*) as postCount, MAX(name) as postLatestUpdated')
            ->first();

        $this->studioCount = $postInfo->postCount;
        $this->studioUpdated = $postInfo->postLatestUpdated;
    }

    public function refreshData()
    {

    }

    public function create()
    {
        $this->emit('createModal');
    }

    public function edit($studio)
    {
        $this->emit('editModal', $studio);
    }
}
