<?php

namespace App\Http\Livewire\Home;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ActressCollection extends Component
{
    public $search;
    
    public function render()
    {
        return view('livewire.home.actress-collection', [
            'actresses' => Auth::user()->actresses()->search('name', $this->search)->paginate(12)
        ]);
    }

    // public function getActressCollection()
    // {
    //    $this->actresses = ;
    // }
}
