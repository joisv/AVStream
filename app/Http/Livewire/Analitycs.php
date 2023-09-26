<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Revenue;
use App\Models\User;
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
            'todayRevenues' => $todayRevenues,
            'todayConversion' => $this->calculateConversionRateByDays()
        ]);
    }

    public function calculateConversionRateByDays()
    {
        $today = Carbon::today();
        $newUsers = User::where('created_at', $today)->count();
        $vipUsers = User::whereHas('subscriptions', function ($query) use ($today) {
            $query->where('status', 'active')->where('start_date', $today); // Pastikan nama kolom "start_date" sesuai dengan tabel langganan
        })->count();
        return ($newUsers > 0) ? ($vipUsers / $newUsers) * 100 : 0;

        // $sixDaysAgo = Carbon::today()->subDays(6);

        // $dates = [];
        // $conversionRates = [];

        // for ($date = $sixDaysAgo->copy(); $date <= $today; $date->addDay()) {
        //     $startOfDay = $date->copy()->startOfDay();
        //     $endOfDay = $date->copy()->endOfDay();

        //     // Menghitung jumlah pengguna baru yang mendaftar hari ini
        //     $newUsers = User::whereBetween('created_at', [$startOfDay, $endOfDay])->count();

        //     // Menghitung jumlah pengguna yang berubah menjadi VIP hari ini
        //     $vipUsers = User::whereHas('subscriptions', function ($query) use ($startOfDay, $endOfDay) {
        //         $query->where('status', 'active')->whereBetween('start_date', [$startOfDay, $endOfDay]); // Pastikan nama kolom "start_date" sesuai dengan tabel langganan
        //     })->count();

        //     // Menghitung conversion rate (perbandingan antara pengguna VIP dengan pengguna baru)
        //     $conversionRate = ($newUsers > 0) ? ($vipUsers / $newUsers) * 100 : 0;

        //     $dates[] = $date->format('l');
        //     $conversionRates[] = $conversionRate;
        // }

        // return [
        //     'date' => $dates,
        //     'conversion_rate' => $conversionRates
        // ];
    }
}
