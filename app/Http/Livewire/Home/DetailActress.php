<?php

namespace App\Http\Livewire\Home;

use App\Models\Actress;
use Livewire\Component;
use Livewire\WithPagination;

class DetailActress extends Component
{
    use WithPagination;
    
    public Actress $actress;
    public $sortBy = 'created_at';

    public $listeners = [ 'reRender' => 'reRender' ];

    public function reRender(){

    }

    public function render()
    {
        $actresses = $this->actress;
        
        return view('livewire.home.detail-actress', [
            'actresses' => $actresses->posts()->orderBy($this->sortBy, 'desc')->paginate(12)
        ]);
    }

}
