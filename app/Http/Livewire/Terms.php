<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\SeoSetting;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Terms extends Component
{
    use LivewireAlert;
    
    public $terms;

    public $rules = [
        'terms' => 'required|min:5|max:2000|string'
    ];

    public function mount()
    {
        $this->terms = SeoSetting::where('id', '1')->first()->terms;
    }
    
    public function render()
    {   
        return view('livewire.terms');
    }

    public function save()
    {   
        Gate::authorize('create', Post::class);
        
        $this->validate();
        SeoSetting::updateOrCreate(['id' => 1], [
            'terms' => $this->terms
        ]);

        $this->alert('success', 'Setting saved');
        redirect()->route('setting');
    }
}
