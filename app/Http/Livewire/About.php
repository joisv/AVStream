<?php

namespace App\Http\Livewire;

use App\Models\SeoSetting;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class About extends Component
{
    use LivewireAlert;
    
    public $about;

    public $rules = [
        'about' => 'required|min:5|max:2000|string'
    ];

    public function mount()
    {
        $this->about = SeoSetting::where('id', '1')->first()->about;
    }
    
    public function render()
    {
        return view('livewire.about');
    }

    public function save()
    {   
        Gate::authorize('create', Post::class);
        
        $this->validate();
        SeoSetting::updateOrCreate(['id' => 1], [
            'about' => $this->about
        ]);

        $this->alert('success', 'Setting saved');
        redirect()->route('setting');
    }
}
