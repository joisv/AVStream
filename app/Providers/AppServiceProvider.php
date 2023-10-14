<?php

namespace App\Providers;

use App\Models\SeoSetting;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Builder::macro('search', function ($fields, $string) {
            if (!is_array($fields)) {
                $fields = [$fields];
            }

            return $string ? $this->where(function ($query) use ($fields, $string) {
                foreach ($fields as $field) {
                    $query->orWhere($field, 'like', '%'.$string.'%');
                }
            }) : $this;
        });

        // $site = SeoSetting::select('logo', 'description', 'site_name')->first();
        
        // View::share([
        //     'site_name' => $site->site_name,
        //     'logo' => $site->logo,
        //     'description' => $site->description,
        //     'version' => 'AV Stream v 0.1',
        //     'made' => 'made with 🤷‍♂️'
        // ]);
    }
}
