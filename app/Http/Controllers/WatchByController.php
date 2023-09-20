<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class WatchByController extends Controller
{

    public $keyword, $description;

    public function __construct(Request $request)
    {
        $this->keyword = $request->route('keyword');
        $this->description = 'Jelajahi koleksi Jav terbaru yang baru-baru ini dirilis. Temukan Jav-jav menarik yang akan memuaskan hasrat Jav Anda hanya di sini.';
    }
    
    public function index()
    {
        SEOTools::setTitle('Watch JAV - '.$this->condition($this->keyword) .'', false);
        SEOTools::setDescription($this->description);
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::setCanonical(url()->current() . '?keyword=' . $this->keyword);
        SEOTools::opengraph()->addProperty('type', 'video.movie');
        SEOTools::opengraph()->setTitle($this->condition($this->keyword));
        SEOTools::opengraph()->setDescription($this->description);
        SEOTools::twitter()->setTitle($this->condition($this->keyword));
        SEOTools::twitter()->setDescription($this->description);
        SEOMeta::setKeywords('jav terbaru, jav baru, jav rilis, tontonan terbaru, jav paling baru');
        
        return view('watch-by', [
            'keyword' => $this->keyword
        ]);
    }

    public function condition($keyword)
    {
        $key = null;
        switch ($keyword) {
            case 'updated_at':
                $key = 'Recent update';
                break;
            case 'most_watch_today':
                $key = 'Most watch today';
                break;
            case 'most_watch_week':
                $key = 'Most watch week';
                break;
            case 'most_watch_month':
                $key = 'Most watch month';
                break;
            default:
                $key = 'New release';
                break;
        }
        return $key;
    }
}
