<?php

namespace App\Http\Livewire\Plan;

use App\Models\Plan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use LivewireAlert;
    use WithPagination;
    
    public $listeners = ['closeModal' => 'refreshData', 'destroy' => 'destroy'];

    public $search = '',
        $sortField = 'created_at',
        $isPaginate = 10,
        $modal = false,
        $sortDirection = 'desc';

    public function render()
    {
        return view('livewire.plan.index', [
            'plans' =>  Plan::search('name', $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate($this->isPaginate)
        ]);
    }

    public function createModal()
    {
        $this->emit('openModal');
    }

    
    public function destroyAlert($plan)
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
                'plan' => $plan
            ]
        ]);
    }

    public function destroy($data)
    {
        $id = $data['data']['plan'];
        try {
            $plan = Plan::find($id);
            $plan->delete();
            $this->emitSelf('closeModal');
            $this->alert('success', 'Deleted successfully', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        } catch (\Throwable $th) {
            $this->alert('error', 'Plan not found', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        }

        
    }

    public function editModal(Plan $plan)
    {
        $this->emit('edit', $plan);
    }

    public function refreshData()
    {
    }
}
