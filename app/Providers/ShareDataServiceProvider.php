<?php

namespace App\Providers;

use App\Views\Composers\SiteDataComposer;
use Illuminate\Support\ServiceProvider;

class ShareDataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer(['layouts.home-navigation', 'layouts.home-footer','layouts.navigation', 'welcome', 'user-subscription-log', 'layouts.home'], SiteDataComposer::class);
    }
}
