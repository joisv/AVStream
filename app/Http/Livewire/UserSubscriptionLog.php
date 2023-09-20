<?php

namespace App\Http\Livewire;

use App\Models\Subscription;
use Livewire\Component;

class UserSubscriptionLog extends Component
{
    public $search = '',
        $sort = 'created_at',
        $isPaginate = 10,
        $modal = false,
        $sortDirection = 'desc';
    
    public function render()
    {
        return view('livewire.user-subscription-log', [
            'subscriptions' => $this->getSubcriptionLog()->paginate($this->isPaginate)
        ]);
    }

    public function getSubcriptionLog()
    {
        $query = Subscription::search('name', $this->search)->with('user')->where('user_id', auth()->user()->id);

        if ($this->sort === 'active') {
            $query->where('status', 'active');
        } elseif ($this->sort === 'pending') {
            $query->where('status', 'pending');
        } elseif ($this->sort === 'expired') {
            $query->where('status', 'expired');
        } elseif ($this->sort === 'cancelled') {
            $query->where('status', 'cancelled');
        }    
        else {
            $query->orderBy($this->sort, $this->sortDirection);
        }

        return $query->orderBy('created_at', 'desc');
    }
}
