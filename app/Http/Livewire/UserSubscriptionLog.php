<?php

namespace App\Http\Livewire;

use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserSubscriptionLog extends Component
{
    public $search = '',
        $sort = 'created_at',
        $isPaginate = 10,
        $modal = false,
        $sortDirection = 'desc',
        $usersSubscription;

    public function render()
    {
        return view('livewire.user-subscription-log', [
            'subscriptions' => $this->getSubcriptionLog()->paginate($this->isPaginate)
        ]);
    }

    public function getSubcriptionLog()
    {
        $this->usersSubscription = Auth::user()->subscriptions->where('status', 'pending')->first();

        $query = Subscription::search('name', $this->search)
            ->with('user')
            ->where('user_id', auth()->user()->id)
            ->when(in_array($this->sort, ['active', 'pending', 'expired', 'cancelled']), function ($query) {
                return $query->where('status', $this->sort);
            }, function ($query) {
                return $query->orderBy($this->sort, $this->sortDirection);
            });

        return $query->orderByDesc('created_at');
    }
}
