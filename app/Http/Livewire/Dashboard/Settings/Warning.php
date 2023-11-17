<?php

namespace App\Http\Livewire\Dashboard\Settings;

use Livewire\Component;

class Warning extends Component
{
    public $is_warning_active;

    public $listeners = ['visibilityChange' => 'visibilityChange'];

    public function render()
    {
        return view('livewire.dashboard.settings.warning');
    }

    public function visibiltyWarning()
    {
        $this->emit('visibility');
    }

    public function visibilityChange($props)
    {
        $this->is_warning_active = $props;
    }
}
