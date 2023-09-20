<?php

namespace App\Http\Livewire\Analitycs;

use App\Models\User as ModelsUser;
use Carbon\Carbon;
use Livewire\Component;

class User extends Component
{
    public $postBy = 'days';
    
    // new user week, month, year
    public function render()
    {
        
        $postName =  $this->postBy === 'days' ? $this->postViewByDays() : (
            $this->postBy === 'weeks' ? $this->postViewByWeeks() : 
                $this->postViewByMonth()
        );

        $this->emitSelf("refreshChartData", $postName);
        
        return view('livewire.analitycs.user', [
            'postByName' => $postName
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
            $views = ModelsUser::whereBetween('created_at', [$startOfDay, $endOfDay])
                ->count();
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
            $views = ModelsUser::whereBetween('created_at', [$startOfWeek, $endOfWeek])
                ->count();
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
            $views = ModelsUser::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->count();
            $dates[] = $startOfMonth->format('F Y');
            $viewsData[] = $views;
        }

        return [
            'date' => $dates,
            'data' => $viewsData
        ];
    }
}
