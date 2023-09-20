<?php

namespace App\Http\Controllers;

use App\Models\SeoSetting;
use App\Models\Studio;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    public $setting,
        $description;

    public function __construct()
    {
        $this->setting = SeoSetting::first();
        $this->description = 'Jelajahi berbagai studio jav yang tersedia. Temukan koleksi studio jav terlengkap dan pilih jav-jav yang sesuai dengan selera Anda.';
    }
    
    public function index()
    {
        SEOTools::setTitle('Studios - Daftar Studio Jav', false);
        SEOTools::setDescription($this->description);
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->addProperty('type', 'article');
        SEOTools::opengraph()->setTitle('studios');
        SEOTools::opengraph()->setDescription($this->description);
        SEOTools::twitter()->setTitle('studios');
        SEOTools::twitter()->setDescription($this->description);
        SEOMeta::setKeywords('studio jav, studio-jav terpopuler, daftar studio jav, category jav, jav dengan studio beragam');
        
        return view('studios');
    }

    public function show(Studio $studio)
    {
        SEOTools::setTitle('Studio - '.$studio->name .'', false);
        SEOTools::setDescription('Temukan berbagai jav dalam kategori '.$studio->name.'. Jelajahi daftar jav-jav '.$studio->name.' yang menarik untuk memenuhi selera jav Anda.');
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::setCanonical(url()->current() . '/' . $studio->slug);
        SEOTools::opengraph()->addProperty('type', 'video.movie');
        SEOTools::opengraph()->setTitle('Daftar Studio Jav');
        SEOTools::opengraph()->setDescription('Temukan berbagai jav dalam kategori '.$studio->name.'. Jelajahi daftar jav-jav '.$studio->name.' yang menarik untuk memenuhi selera jav Anda.');
        SEOTools::twitter()->setTitle('Daftar Studio Jav');
        SEOTools::twitter()->setDescription('Temukan berbagai jav dalam kategori '.$studio->name.'. Jelajahi daftar jav-jav '.$studio->name.' yang menarik untuk memenuhi selera film Anda.');
        SEOMeta::setKeywords('kategori jav, '.$studio->name.', jav '.$studio->name.', koleksi '.$studio->name.', daftar jav '.$studio->name.'');
        SEOMeta::setRobots('index, follow');
        
        return view('detail-studio', [
            'studio' => $studio
        ]);
    }
}
