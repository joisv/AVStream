<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class VipController extends Controller
{
    public $description;

    public function __construct()
    {
        $this->description = 'Berlangganan layanan streaming jav terbaik untuk akses tak terbatas ke koleksi jav kami. Nikmati jav-jav terbaru dan tonton kapan saja, di mana saja.';
    }
    
    public function index()
    {
        SEOTools::setTitle('Subscriptions - Langganan Jav VIP', false);
        SEOTools::setDescription($this->description);
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->addProperty('type', 'video.movie');
        SEOTools::opengraph()->setTitle('Langganan JAV VIP');
        SEOTools::opengraph()->setDescription($this->description);
        // SEOTools::opengraph()->addImage($this->post->poster_path);
        SEOTools::twitter()->setTitle('Langganan JAV VIP');
        SEOTools::twitter()->setDescription($this->description);
        // SEOTools::twitter()->setImage($this->post->poster_path);
        SEOMeta::setRobots('index, follow');
        SEOMeta::setKeywords('Nikmati akses tak terbatas ke koleksi jav terbaru kami. Tonton jav kapan saja, di mana saja.');

        return view('vip');
    }
}
