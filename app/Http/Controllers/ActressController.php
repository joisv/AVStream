<?php

namespace App\Http\Controllers;

use App\Models\Actress;
use App\Models\SeoSetting;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class ActressController extends Controller
{
    public $setting;

    public function __construct()
    {
        $this->setting = SeoSetting::first();
    }

    public function index()
    {
        return view('actresses', [
            'SEOData' => new SEOData(
                title: 'Actress JAV Terlengkap Hanya di Sini!',
                description: $this->setting->description,
                robots: 'noindex, nofollow',
                tags: [
                    'jav guru', 'jav', 'jav sub indo', 'jav most', 'jav streaming', 'free jav', 'jav stream', 'jav online',
                    'streaming jav', 'jav subtitle', 'jav subindo', 'jav subtitle indo', 'jav uncesored leak', 'jav hd', 'jav cosplay'
                ]
            )
        ]);
    }

    public function show(Actress $actress)
    {
        return view('actress', [
            'actress' => $actress
        ]);
    }

    public function actressCollection()
    {
        return view('actress-collection', [
            'SEOData' => new SEOData(
                title: 'Actresses Collection | ' . auth()->user()->name,
                description: $this->setting->description,
                robots: 'noindex, nofollow',
                tags: [
                    'jav guru', 'jav', 'jav sub indo', 'jav most', 'jav streaming', 'free jav', 'jav stream', 'jav online',
                    'streaming jav', 'jav subtitle', 'jav subindo', 'jav subtitle indo', 'jav uncesored leak', 'jav hd', 'jav cosplay'
                ]
            )
        ]);
    }

    public function javCollection()
    {
        return view('save', [
            'SEOData' => new SEOData(
                title: 'JAV Collection | ' . auth()->user()->name,
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
