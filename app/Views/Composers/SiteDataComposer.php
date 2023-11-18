<?php

namespace App\Views\Composers;

use App\Models\SeoSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use illuminate\View\View;

class SiteDataComposer
{

    public function __construct()
    {
    }

    // The compose function here handles the logic of binding data to the view   
    public function compose(View $view)
    {

        $setting = Cache::remember('settings', 60 * 60, function () {
            return SeoSetting::first(); // With method accepts two arguments, a key and a value   
        });

        $view->with('setting', $setting);
    }
}
