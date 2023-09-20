<?php

namespace App\Http\Livewire\Navigation;

use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SubscriptionLog extends Component
{
    public $subscriptionCount;
    public $listeners = [ 'sendNotif' => 'reRender' ];
    
    
    public function render()
    {
        return view('livewire.navigation.subscription-log');
    }

    public function getSubscriptionCount()
    {
        $this->subscriptionCount = Auth::user()->subscriptions->where('status', 'pending')->count();
        $this->emit('subscriptionCount', $this->subscriptionCount);
    }

    public function reRender()
    {
        $this->getSubscriptionCount();
    }
   
}