<?php

namespace App\Http\Livewire\Home;

use App\Models\Studio;
use Livewire\Component;

class Studios extends Component
{
    public $search;
    
    public function updated()
    {
        $this->getStudios();
    } 
    
    public function render()
    {
        $studios = $this->getStudios();
        
        return view('livewire.home.studios', [
            'studios' => $studios->paginate(12)
        ]);
    }

    public function getStudios()
    {
        return Studio::search(['name'], $this->search)->with('posts')->orderBy('name', 'asc');
    }
   
}
