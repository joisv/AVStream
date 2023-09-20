<?php

namespace App\Http\Livewire\Download;

use App\Models\Download;
use Illuminate\Support\Facades\Gate;
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
        $downloadCount,
        $sortDirection = 'desc';

    public $listeners = ['closeModal' => 'refreshData', 'destroy' => 'destroy'];

    public function render()
    {
        $query = Download::with(['post', 'user' => function ($q) {
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

        $downloads = $query->paginate($this->isPaginate);
        
        return view('livewire.download.index', [
            'downloads' => $downloads
        ]);
    }

    public function getPostCount()
    {
        $postInfo = Download::selectRaw('COUNT(*) as postCount, MAX(name) as postLatestUpdated')
            ->first();

        $this->downloadCount = $postInfo->postCount;
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

    public function createModal()
    {
        $this->emit('openModal');
    }

    public function refreshData()
    {
    }

    public function destroyAlert($download)
    {
        $this->alert('warning', 'delete this download ?', [
            'position' => 'top-end',
            'timer' => '',
            'toast' => true,
            'showConfirmButton' => true,
            'onConfirmed' => 'destroy',
            'showCancelButton' => true,
            'onDismissed' => '',
            'data' => [
                'download' => $download
            ]
        ]);
    }

    public function destroy($data)
    {
        $id = $data['data']['download'];
        try {
            $download = Download::find($id);
            Gate::authorize('delete', $download);
            $download->delete();
            $this->emitSelf('closeModal');
            $this->alert('success', 'Deleted successfully', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        } catch (\Throwable $th) {
            $this->alert('error', 'Download not found', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        }

        
    }

    public function editDownload(Download $download)
    {
        $this->emit('editDownload', $download);
    }
}
