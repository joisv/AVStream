<?php

namespace App\Http\Livewire\Dashboard\Settings;

use Livewire\Component;

class InfoVisibility extends Component
{
    public $is_info_active;

    public $listeners = ['visibilityInfoChange' => 'visibilityInfoChange'];

    public function render()
    {
        return view('livewire.dashboard.settings.info-visibility');
    }

    public function visibiltyInfo()
    {
        $this->emit('visibilityInfo');
    }

    public function visibilityInfoChange($props)
    {
        $this->is_info_active = $props;
    }

}
