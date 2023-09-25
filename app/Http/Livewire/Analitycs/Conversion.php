<?php

namespace App\Http\Livewire\Analitycs;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Conversion extends Component
{
    public $postBy = 'days';

    public function render()
    {
        $conversions =  $this->postBy === 'days' ? $this->calculateConversionRateByDays() : (
            $this->postBy === 'weeks' ? $this->calculateConversionRateByWeeks() : 
               $this->calculateConversionRateByMonth()
        );
        
        $this->emitSelf("refreshChartData", $conversions);
        
        return view('livewire.analitycs.conversion', [
            'conversions' => $conversions
        ]);
    }

    public function calculateConversionRateByDays()
    {
        $today = Carbon::today();
        $sixDaysAgo = Carbon::today()->subDays(6);

        $dates = [];
        $conversionRates = [];

        for ($date = $sixDaysAgo->copy(); $date <= $today; $date->addDay()) {
            $startOfDay = $date->copy()->startOfDay();
            $endOfDay = $date->copy()->endOfDay();

            // Menghitung jumlah pengguna baru yang mendaftar hari ini
            $newUsers = User::whereBetween('created_at', [$startOfDay, $endOfDay])->count();

            // Menghitung jumlah pengguna yang berubah menjadi VIP hari ini
            $vipUsers = User::whereHas('subscriptions', function ($query) use ($startOfDay, $endOfDay) {
                $query->where('status', 'active')->whereBetween('start_date', [$startOfDay, $endOfDay]); // Pastikan nama kolom "start_date" sesuai dengan tabel langganan
            })->count();

            // Menghitung conversion rate (perbandingan antara pengguna VIP dengan pengguna baru)
            $conversionRate = ($newUsers > 0) ? ($vipUsers / $newUsers) * 100 : 0;

            $dates[] = $date->format('l');
            $conversionRates[] = $conversionRate;
        }

        return [
            'date' => $dates,
            'conversion_rate' => $conversionRates
        ];
    }

    public function calculateConversionRateByWeeks()
    {
        $fourWeeksAgo = today()->subWeeks(8);

        $dates = [];
        $conversionRates = [];

        for ($i = 0; $i < 7; $i++) {
            $startOfWeek = $fourWeeksAgo->copy()->addWeeks($i)->startOfWeek();
            $endOfWeek = $fourWeeksAgo->copy()->addWeeks($i)->endOfWeek();

            // Menghitung jumlah pengguna baru yang mendaftar hari ini
            $newUsers = User::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();

            // Menghitung jumlah pengguna yang berubah menjadi VIP hari ini
            $vipUsers = User::whereHas('subscriptions', function ($query) use ($startOfWeek, $endOfWeek) {
                $query->where('status', 'active')->whereBetween('start_date', [$startOfWeek, $endOfWeek]); // Pastikan nama kolom "start_date" sesuai dengan tabel langganan
            })->count();

            // Menghitung conversion rate (perbandingan antara pengguna VIP dengan pengguna baru)
            $conversionRate = ($newUsers > 0) ? ($vipUsers / $newUsers) * 100 : 0;

            $dates[] = 'Week ' . ($i + 1);
            $conversionRates[] = $conversionRate;
        }

        return [
            'date' => $dates,
            'conversion_rate' => $conversionRates
        ];
    }

    public function calculateConversionRateByMonth()
    {
        $oneMonthAgo = today()->subMonth();

        $dates = [];
        $conversionRates = [];

        for ($i = 0; $i < 12; $i++) {
            $startOfMonth = $oneMonthAgo->copy()->addMonths($i)->startOfMonth();
            $endOfMonth = $oneMonthAgo->copy()->addMonths($i)->startOfMonth();

            // Menghitung jumlah pengguna baru yang mendaftar hari ini
            $newUsers = User::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

            // Menghitung jumlah pengguna yang berubah menjadi VIP hari ini
            $vipUsers = User::whereHas('subscriptions', function ($query) use ($startOfMonth, $endOfMonth) {
                $query->where('status', 'active')->whereBetween('start_date', [$startOfMonth, $endOfMonth]); // Pastikan nama kolom "start_date" sesuai dengan tabel langganan
            })->count();

            // Menghitung conversion rate (perbandingan antara pengguna VIP dengan pengguna baru)
            $conversionRate = ($newUsers > 0) ? ($vipUsers / $newUsers) * 100 : 0;

            $dates[] = $startOfMonth->format('F Y');
            $conversionRates[] = $conversionRate;
        }

        return [
            'date' => $dates,
            'conversion_rate' => $conversionRates
        ];
    }
   
}
