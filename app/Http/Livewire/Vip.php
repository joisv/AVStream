<?php

namespace App\Http\Livewire;

use App\Models\Plan;
use App\Models\Subscription;
use Livewire\Component;

class Vip extends Component
{
    public $plans, $loading = true;

    public $listeners = [
        'isSuscces' => 'isSuccess'
    ];
    
    public function render()
    {
        return view('livewire.vip');
    }

    public function getPlans()
    {
        $this->plans = Plan::latest('id')->get();
        $this->loading = false;
    }

    public function modalSubmit($plan)
    {
        if (auth()->check()) {
            $this->emit('openModal', $plan);
        } else {
            redirect()->route('login');
        }
    }
}
