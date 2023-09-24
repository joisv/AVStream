<?php

namespace App\Http\Livewire\Analitycs;

use Carbon\Carbon;
use Livewire\Component;

class Conversion extends Component
{

    public function render()
    {
        dd($this->calculateConversionRateByDays());
        return view('livewire.analitycs.conversion');
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
            $newUsers = User::whereBetween('registration_date', [$startOfDay, $endOfDay])->count();

            // Menghitung jumlah pengguna yang berubah menjadi VIP hari ini
            $vipUsers = User::whereHas('roles', function ($query) {
                $query->where('name', 'vip'); // Pastikan peran "VIP" sesuai dengan yang didefinisikan dalam Spatie Roles
            })->whereHas('subscription', function ($query) use ($startOfDay, $endOfDay) {
                $query->whereBetween('start_date', [$startOfDay, $endOfDay]); // Pastikan nama kolom "start_date" sesuai dengan tabel langganan
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
}
