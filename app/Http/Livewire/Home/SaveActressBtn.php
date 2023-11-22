<?php

namespace App\Http\Livewire\Home;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class SaveActressBtn extends Component
{
    use LivewireAlert;
    
    public $bgActress,
        $actressId,
        $user,
        $hasActress;

    public function render()
    {
        return view('livewire.home.save-actress-btn');
    }

    public function saveActress()
    {
        if (!auth()->check()) {
            $this->alert('warning', 'You need to login first');
            return;
        }

        try {
            if ($this->hasActress === 0) {
                $this->user->actresses()->attach($this->actressId);
                $this->alert('success', 'Successfully added actress');
                $this->hasActress = 1;
            } else {
                $this->user->actresses()->detach($this->actressId);
                $this->alert('success', 'Removed actress');
                $this->hasActress = 0;
            }
            $this->emitSelf('reRender');
        } catch (\Throwable $th) {
            $this->alert('error', $th->getMessage());
        }
    }

    public function isActressExist()
    {
        if (auth()->check()) {
            $this->user = Auth::user();
            $this->hasActress = $this->user->actresses()->find($this->actressId) ? 1 : 0;
        }
    }
}
