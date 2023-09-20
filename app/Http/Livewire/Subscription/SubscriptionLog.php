<?php

namespace App\Http\Livewire\Subscription;

use App\Models\Subscription;
use Livewire\Component;
use Livewire\WithPagination;

class SubscriptionLog extends Component
{
    use WithPagination;
    public $search = '',
        $sortField = 'created_at',
        $isPaginate = 10,
        $modal = false,
        $sortDirection = 'desc';

    public $listeners = ['reRender' => 'reRender'];

    public function reRender()
    {
        $this->modal = false;
    }

    public function render()
    {
        return view('livewire.subscription.subscription-log', [
            'subscriptions' => $this->getSubcriptionLog()->paginate($this->isPaginate)
        ]);
    }

    public function getSubcriptionLog()
    {
        $query = Subscription::search('name', $this->search)->with('user');

        if ($this->sortField === 'active') {
            $query->where('status', 'active');
        } elseif ($this->sortField === 'pending') {
            $query->where('status', 'pending');
        } elseif ($this->sortField === 'expired') {
            $query->where('status', 'expired');
        } else {
            $query->orderBy($this->sortField, $this->sortDirection);
        }

        return $query->orderBy('created_at', 'desc');
    }

    public function editSubscription($subscription)
    {
        $this->modal = true;
        $this->emit('editSubscription', $subscription);
    }
}
