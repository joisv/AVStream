<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\SeoSetting;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class GenreController extends Controller
{
    public $setting,
        $description;

    public function __construct()
    {
        $this->setting = SeoSetting::first();
        $this->description = 'Jelajahi berbagai genre jav yang tersedia. Temukan koleksi genre jav terlengkap dan pilih jav-jav yang sesuai dengan selera Anda.';
    }

    public function index()
    {
        return view('genres', [
            'SEOData' => new SEOData(
                title: 'Genre JAV Terlengkap Hanya di Sini!',
                description: $this->setting->description,
                robots: 'noindex, nofollow',
                tags: ['jav guru', 'jav', 'jav sub indo', 'jav most', 'jav streaming', 'free jav', 'jav stream', 'jav online', 
               'streaming jav', 'jav subtitle', 'jav subindo', 'jav subtitle indo', 'jav uncesored leak', 'jav hd', 'jav cosplay']
            )
        ]);
    }

    public function show(Genre $genre)
    {
        return view('detail-genre', [
            'genre' => $genre
        ]);
    }
}
