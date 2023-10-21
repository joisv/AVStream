<?php

namespace App\Http\Livewire\Home;

use App\Models\Actress;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class DetailActress extends Component
{
    use WithPagination;
    use LivewireAlert;
    
    public Actress $actress;
    public $user;
    public $hasActress;
    public $sortBy = 'created_at';

    public $listeners = [ 'reRender' => 'reRender' ];

    public function reRender(){

    }

    public function render()
    {
        $actresses = $this->actress;
        
        return view('livewire.home.detail-actress', [
            'actresses' => $actresses->posts()->orderBy($this->sortBy, 'desc')->paginate(16)
        ]);
    }

    public function saveActress()
    {
        if (!auth()->check()) {
            $this->alert('warning', 'You need to login first');
            return;
        }
    
        try {
            if ($this->hasActress === 0) {
                $this->user->actresses()->attach($this->actress->id);
                $this->alert('success', 'Successfully added actress');
                $this->hasActress = 1;
            } else {
                $this->user->actresses()->detach($this->actress->id);
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
            $this->hasActress = $this->user->actresses()->find($this->actress->id) ? 1 : 0;
        }
    }
}
