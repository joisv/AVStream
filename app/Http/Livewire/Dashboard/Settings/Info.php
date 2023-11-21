<?php

namespace App\Http\Livewire\Dashboard\Settings;

use App\Models\SeoSetting;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Info extends Component
{
    use LivewireAlert;
    
    public $settings;

    public $info,
        $is_info_active;

    public $listeners = ['visibilityInfo' => 'visibilityInfo'];

    public function mount()
    {
        $this->settings = SeoSetting::select(['info', 'is_info_active'])->first();
        $this->info = $this->settings->info;
        $this->is_info_active = $this->settings->is_info_active;
    }

    public function render()
    {
        return view('livewire.dashboard.settings.info');
    }

    public function save()
    {
        if ($this->settings) {
            SeoSetting::first()->update([
                'info' => $this->info,
                'is_info_active' => $this->is_info_active
            ]);
            $this->alert('success', 'Info Saved');
        } else {
           $this->alert('error', 'something went wrong');
        }
        
    }

    public function visibilityInfo()
    {
        $this->is_info_active = !$this->is_info_active;
        $this->emit('visibilityInfoChange', $this->is_info_active);
    }
}
