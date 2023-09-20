<?php

namespace App\Http\Livewire\Analitycs;

use App\Models\Post;
use Carbon\Carbon;
use Livewire\Component;

class Views extends Component
{

    public $postBy = 'days';

    public function render()
    {
        $postName =  $this->postBy === 'days' ? $this->postViewByDays() : ($this->postBy === 'weeks' ? $this->postViewByWeeks() :
            $this->postViewByMonth()
        );

        $this->emitSelf("refreshChartData", $postName);

        return view('livewire.analitycs.views', [

            'postByName' => $postName

        ]);
    }


    public function postViewByDays()
    {
        $today = Carbon::today();
        $sixDaysAgo = Carbon::today()->subDays(6);

        $data = [];

        for ($date = $sixDaysAgo->copy(); $date <= $today; $date->addDay()) {
            $views = Post::whereDate('updated_at', $date)
                ->sum('views');
            $data[] = [
                'date' => $date->format('l'),
                'views' => $views,
            ];
        }

        return $data;
    }

    public function postViewByWeeks()
    {
        $fourWeeksAgo = Carbon::today()->subWeeks(8);

        $data = [];
        for ($i = 0; $i < 8; $i++) {
            $startOfWeek = $fourWeeksAgo->copy()->addWeeks($i)->startOfWeek();
            $endOfWeek = $fourWeeksAgo->copy()->addWeeks($i)->endOfWeek();
            $views = Post::whereBetween('updated_at', [$startOfWeek, $endOfWeek])
                ->sum('views');

            $data[] = [
                'date' => 'Week ' . ($i + 1),
                'views' => $views,
            ];
        }

        return $data;
    }

    public function postViewByMonth()
    {
        $oneMonthAgo = Carbon::today()->subMonth();

        $data = [];
        for ($i = 0; $i < 12; $i++) {
            $startOfMonth = $oneMonthAgo->copy()->addMonths($i)->startOfMonth();
            $endOfMonth = $oneMonthAgo->copy()->addMonths($i)->endOfMonth();
            $views = Post::whereBetween('updated_at', [$startOfMonth, $endOfMonth])
                ->sum('views');
            $data[] = [
                'date' => $startOfMonth->format('F Y'),
                'views' => $views,
            ];
        }

        return $data;
    }


    // public function postViewByWeeks()
    // {
    //     $fourWeeksAgo = Carbon::today()->subWeeks(8);

    //     $dates = [];
    //     $viewsData = [];

    //     for ($i = 0; $i < 8; $i++) {
    //         $startOfWeek = $fourWeeksAgo->copy()->addWeeks($i)->startOfWeek();
    //         $endOfWeek = $fourWeeksAgo->copy()->addWeeks($i)->endOfWeek();
    //         $views = Post::whereBetween('updated_at', [$startOfWeek, $endOfWeek])
    //             ->sum('views');

    //         $dates[] = 'Week ' . ($i + 1);
    //         $viewsData[] = $views;
    //     }

    //     return [
    //         'date' => $dates,
    //         'data' => $viewsData
    //     ];
    // }

    // public function postViewByMonth()
    // {
    //     $oneMonthAgo = Carbon::today()->subMonth();

    //     $dates = [];
    //     $viewsData = [];

    //     for ($i = 0; $i < 12; $i++) {
    //         $startOfMonth = $oneMonthAgo->copy()->addMonths($i)->startOfMonth();
    //         $endOfMonth = $oneMonthAgo->copy()->addMonths($i)->endOfMonth();
    //         $views = Post::whereBetween('updated_at', [$startOfMonth, $endOfMonth])
    //             ->sum('views');
    //         $dates[] = $startOfMonth->format('F Y');
    //         $viewsData[] = $views;
    //     }

    //     return [
    //         'date' => $dates,
    //         'data' => $viewsData
    //     ];
    // }
}
