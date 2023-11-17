<?php

namespace App\Http\Livewire\Dashboard\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Artisan;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class MaintenanceToggle extends Component
{
    use LivewireAlert;
    
    public $maintenanceMode;
    public $secret = "8yw238ymap8cdfz38fmr6c3sp";

    public function mount()
    {
        $this->maintenanceMode = app()->isDownForMaintenance();
    }

    public function toggleMaintenance()
    {
        if (auth()->user()->hasRole('admin')) {
            $status = $this->maintenanceMode ? 'up' : 'down';

            if ($status === 'up') {
                Artisan::call('up');
            } else {
                Artisan::call('down', ['--secret' => $this->secret, '--render' => 'errors::503']);
            }

            $this->maintenanceMode = !$this->maintenanceMode;

        } else {
            $this->alert('error', 'You dont have right permission');
            
        }
    }

    public function render()
    {
        return view('livewire.dashboard.settings.maintenance-toggle');
    }
}
