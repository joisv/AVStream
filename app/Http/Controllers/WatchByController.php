<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

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
        return view('watch-by', [
            'keyword' => $this->keyword,
            'SEOData' => new SEOData(
                title: 'Watch JAV - '.$this->condition($this->keyword),
                description: $this->description,
                tags: ['jav terbaru', 'jav baru', 'jav rilis', 'tontonan terbaru', 'jav paling baru'],
                robots: 'index, follow'
            )
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
