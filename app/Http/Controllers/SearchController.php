<?php

namespace App\Http\Controllers;

use App\Models\SeoSetting;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class SearchController extends Controller
{
    public $setting;
    
    public function __construct()
    {
        $this->setting = SeoSetting::first();   
    }
    
    public function index(Request $request) {

        $keyword = $request->input('keyword');
        
        return view('search', [
            'keyword' => $keyword,
            'SEOData' => new SEOData(
                title: 'Search JAV | '. $keyword,
                description: $this->setting->description,
                tags: ['jav terbaru', 'jav baru', 'jav rilis', 'tontonan terbaru', 'jav paling baru'],
                robots: 'index, follow'
            )
        ]);
    }
}
