<?php

namespace App\Http\Livewire;

use App\Models\Notification as ModelsNotification;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Notification extends Component
{
    use LivewireAlert;
    public $notifications;

    public $listeners = [
        'destroy' => 'destroy',
        'successDelete' => 'reRender'
    ];

    public function render()
    {
        return view('livewire.notification');
    }

    public function getNotifications()
    {
        $this->notifications = ModelsNotification::where('user_id', auth()->user()->id)->latest('id')->get();

        foreach ($this->notifications as $notification) {
            $notification->update([
                'is_read' => false
            ]);
        }
    }

    public function reRender()
    {

    }

    public function destroyAlert($notification)
    {
        $this->alert('warning', 'delete this notification ?', [
            'position' => 'top-end',
            'timer' => '',
            'toast' => true,
            'showConfirmButton' => true,
            'onConfirmed' => 'destroy',
            'showCancelButton' => true,
            'onDismissed' => '',
            'data' => [
                'notification' => $notification
            ]
        ]);
    }

    public function destroy($data)
    {
        $id = $data['data']['notification'];
        try {
            $notifi = ModelsNotification::find($id);
            $notifi->delete();
            $this->emitSelf('successDelete');
            $this->alert('success', 'Deleted successfully', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        } catch (\Throwable $th) {
            $this->alert('error', 'Notification not found', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
            ]);
        }

        
    }
}
