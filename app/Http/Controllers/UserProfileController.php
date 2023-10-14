<?php

namespace App\Http\Controllers;

use App\Models\SeoSetting;
use Artesaos\SEOTools\Facades\SEOTools;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class UserProfileController extends Controller
{
    public $setting;

    public function __construct()
    {
        $this->setting = SeoSetting::first();
    }
    
    public function index()
    {   
        return view('livewire.user-profile.edit', [
            'SEOData' => new SEOData(
                title: 'Profile | ' . auth()->user()->name,
                description: $this->setting->description,
                robots: 'noindex, nofollow',
                tags: [
                    'jav guru', 'jav', 'jav sub indo', 'jav most', 'jav streaming', 'free jav', 'jav stream', 'jav online',
                    'streaming jav', 'jav subtitle', 'jav subindo', 'jav subtitle indo', 'jav uncesored leak', 'jav hd', 'jav cosplay'
                ]  
            )
        ]);
    }

    public function userSubscription()
    {
        return view('user-subscription-log', [
            'SEOData' => new SEOData(
                title: 'Subscription | ' . auth()->user()->name,
                description: $this->setting->description,
                robots: 'noindex, nofollow',
                tags: [
                    'jav guru', 'jav', 'jav sub indo', 'jav most', 'jav streaming', 'free jav', 'jav stream', 'jav online',
                    'streaming jav', 'jav subtitle', 'jav subindo', 'jav subtitle indo', 'jav uncesored leak', 'jav hd', 'jav cosplay'
                ]  
            )
        ]);
    }

    public function userNotifications()
    {
        return view('notifications', [
            'SEOData' => new SEOData(
                title: 'Notifications | ' . auth()->user()->name,
                description: $this->setting->description,
                robots: 'noindex, nofollow',
                tags: [
                    'jav guru', 'jav', 'jav sub indo', 'jav most', 'jav streaming', 'free jav', 'jav stream', 'jav online',
                    'streaming jav', 'jav subtitle', 'jav subindo', 'jav subtitle indo', 'jav uncesored leak', 'jav hd', 'jav cosplay'
                ]  
            )
        ]);
    }
}
