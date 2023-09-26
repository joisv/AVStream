<?php

namespace App\Http\Livewire\Navigation;

use App\Models\Report;
use Livewire\Component;

class UserReport extends Component
{
    public $reportCount;
    
    public function render()
    {
        return view('livewire.navigation.user-report');
    }

    public function getReportCount()
    {
        $this->reportCount = Report::where('is_new', true)->count();
    }
}
