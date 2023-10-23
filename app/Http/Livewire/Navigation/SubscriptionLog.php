<?php

namespace App\Http\Livewire\Navigation;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SubscriptionLog extends Component
{
    public $isSubscriptionExist;
    public $listeners = [ 'sendNotif' => 'reRender' ];
    
    
    public function render()
    {
        return view('livewire.navigation.subscription-log');
    }

    public function getSubscriptions()
    {
        $this->isSubscriptionExist = Auth::user()->subscriptions->where('status', 'pending')->isNotEmpty();
        $this->emit('isSubscriptionExist', $this->isSubscriptionExist);
    }

    public function reRender()
    {
        $this->getSubscriptions();
    }
   
}