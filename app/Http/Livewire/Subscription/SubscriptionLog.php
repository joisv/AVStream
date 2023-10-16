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
        $subscriptions = $this->getSubscriptions()->paginate($this->isPaginate);
        return view('livewire.subscription.subscription-log', [
            'subscriptions' => $subscriptions
        ]);
    }
    
    public function getSubscriptions()
    {
        $query = Subscription::with('user');
    
        if ($this->search) {
            $query->search(['status', 'payment_code'], $this->search);
        }
    
        if ($this->sortField === 'active') {
            $query->where('status', 'active');
        } elseif ($this->sortField === 'pending') {
            $query->where('status', 'pending');
        } elseif ($this->sortField === 'expired') {
            $query->where('status', 'expired');
        } else {
            $query->orderBy($this->sortField, $this->sortDirection);
        }
    
        // Jangan panggil get() di sini, biarkan query builder tetap sebagai objek query
        return $query;
    }

    public function editSubscription($subscription)
    {
        $this->modal = true;
        $this->emit('editSubscription', $subscription);
    }
}
