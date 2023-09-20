<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Revenue;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Analitycs extends Component
{
    public function render()
    {
        $today = Carbon::today();

        $newUserCount = DB::table('users')
            ->whereDate('created_at', $today)
            ->count();
            
        $todayViews = Post::whereDate('updated_at', $today)
            ->sum('views');

        $todayRevenues = Revenue::whereDate('date', $today)->sum('amount');
            
        return view('livewire.analitycs', [
            'newUserCount' => $newUserCount,
            'todayViews' => $todayViews,
            'todayRevenues' => $todayRevenues
        ]);
    }
}
