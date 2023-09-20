<?php

namespace App\Http\Livewire\Analitycs;

use App\Models\Revenue as ModelsRevenue;
use Carbon\Carbon;
use Livewire\Component;

class Revenue extends Component
{
    public $postBy = 'days';
    
    public function render()
    {
        $revenues =  $this->postBy === 'days' ? $this->postViewByDays() : (
            $this->postBy === 'weeks' ? $this->postViewByWeeks() : 
                $this->postViewByMonth()
        );
        
        $this->emitSelf("refreshChartData", $revenues);
        return view('livewire.analitycs.revenue', [
            'revenues' => $revenues
        ]);
    }

    public function postViewByDays()
    {
        $today = Carbon::today();
        $sixDaysAgo = Carbon::today()->subDays(6);

        $dates = [];
        $viewsData = [];
        for ($date = $sixDaysAgo->copy(); $date <= $today; $date->addDay()) {
            $startOfDay = $date->copy()->startOfDay();
            $endOfDay = $date->copy()->endOfDay();
            $views = ModelsRevenue::whereBetween('date', [$startOfDay, $endOfDay])
                ->sum('amount');
            $dates[] = $date->format('l');
            $viewsData[] = $views;
        }
        return [

            'date' => $dates,
            'data' => $viewsData
        ];
    }

    public function postViewByWeeks()
    {
        $fourWeeksAgo = Carbon::today()->subWeeks(8);

        $dates = [];
        $viewsData = [];

        for ($i = 0; $i < 8; $i++) {
            $startOfWeek = $fourWeeksAgo->copy()->addWeeks($i)->startOfWeek();
            $endOfWeek = $fourWeeksAgo->copy()->addWeeks($i)->endOfWeek();
            $views = ModelsRevenue::whereBetween('date', [$startOfWeek, $endOfWeek])
                ->sum('amount');
            $dates[] = 'Week ' . ($i + 1);
            $viewsData[] = $views;
        }

        return [
            'date' => $dates,
            'data' => $viewsData
        ];
    }

    public function postViewByMonth()
    {
        $oneMonthAgo = Carbon::today()->subMonth();

        $dates = [];
        $viewsData = [];

        for ($i = 0; $i < 12; $i++) {
            $startOfMonth = $oneMonthAgo->copy()->addMonths($i)->startOfMonth();
            $endOfMonth = $oneMonthAgo->copy()->addMonths($i)->endOfMonth();
            $views = ModelsRevenue::whereBetween('date', [$startOfMonth, $endOfMonth])
                ->sum('amount');
            $dates[] = $startOfMonth->format('F Y');
            $viewsData[] = $views;
        }

        return [
            'date' => $dates,
            'data' => $viewsData
        ];
    }
}
