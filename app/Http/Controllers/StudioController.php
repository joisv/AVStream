<?php

namespace App\Http\Controllers;

use App\Models\SeoSetting;
use App\Models\Studio;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class StudioController extends Controller
{
    public $setting,
        $description;

    public function __construct()
    {
        $this->setting = SeoSetting::first();
    }
    
    public function index()
    {   
        return view('studios', [
            'SEOData' => new SEOData(
                title: 'Studio JAV Terlengkap Hanya di Sini!',
                description: $this->setting->description,
                robots: 'noindex, nofollow',
                tags: ['jav guru', 'jav', 'jav sub indo', 'jav most', 'jav streaming', 'free jav', 'jav stream', 'jav online', 
               'streaming jav', 'jav subtitle', 'jav subindo', 'jav subtitle indo', 'jav uncesored leak', 'jav hd', 'jav cosplay']
            )
        ]);
    }

    public function show(Studio $studio)
    {   
        return view('detail-studio', [
            'studio' => $studio
        ]);
    }
}
