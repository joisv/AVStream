<?php

namespace App\Http\Livewire\Navigation;

use App\Models\Notification as ModelsNotification;
use Livewire\Component;

class Notification extends Component
{
    public $notification;
    public $listeners = [ 'sendNotif' => 'reRender' ];
    
    
    public function render()
    {
        return view('livewire.navigation.notification');
    }

    public function getNotificationCount()
    {
        $this->notification = ModelsNotification::where('user_id', auth()->user()->id)->where('is_read', true)->count();
        $this->emit('sendNotifiCount', $this->notification);
    }

    public function reRender()
    {
        $this->getNotificationCount();
    }
}
