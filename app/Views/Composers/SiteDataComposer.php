<?php

namespace App\Views\Composers;

use App\Models\SeoSetting;
use Illuminate\Support\Facades\Auth;
use illuminate\View\View;

class SiteDataComposer
{

    public function __construct()
    {
    }

    // The compose function here handles the logic of binding data to the view   
    public function compose(View $view)
    {

        $setting = SeoSetting::first(); // With method accepts two arguments, a key and a value        
        $view->with('setting', $setting);
    }
}
