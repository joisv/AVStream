<?php

namespace App\Http\Livewire\Home;

use App\Models\Studio;
use Livewire\Component;
use Livewire\WithPagination;

class DetailStudio extends Component
{
    use WithPagination;
    public Studio $studio;

    public $sort = 'created_at';
    protected $queryString = ['sort'];
    
    public function render()
    {
        $studio = $this->studio;
        
        return view('livewire.home.detail-studio', [
            'studios' => $studio->posts()->orderBy($this->sort, 'desc')->paginate(12)
        ]);
    }
}
