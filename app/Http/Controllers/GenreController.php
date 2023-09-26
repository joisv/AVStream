<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\SeoSetting;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

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
        SEOTools::setTitle('Genres - Daftar genre jav terlengkap', false);
        SEOTools::setDescription($this->description);
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->addProperty('type', 'article');
        SEOTools::opengraph()->setTitle('genres');
        SEOTools::opengraph()->setDescription($this->description);
        SEOTools::twitter()->setTitle('genres');
        SEOTools::twitter()->setDescription($this->description);
        SEOMeta::setKeywords('genre jav, genre-jav terpopuler, daftar genre jav, category jav, jav dengan genre beragam');
        SEOMeta::setRobots('index, follow');

        return view('genres');
    }

    public function show(Genre $genre)
    {
        SEOTools::setTitle('Genre - '.$genre->name .'', false);
        SEOTools::setDescription('Temukan berbagai jav dalam kategori '.$genre->name.'. Jelajahi daftar jav-jav '.$genre->name.' yang menarik untuk memenuhi selera jav Anda.');
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::setCanonical(url()->current() . '/' . $genre->slug);
        SEOTools::opengraph()->addProperty('type', 'video.movie');
        SEOTools::opengraph()->setTitle('Daftar lengkap genre Jav');
        SEOTools::opengraph()->setDescription('Temukan berbagai jav dalam kategori '.$genre->name.'. Jelajahi daftar jav-jav '.$genre->name.' yang menarik untuk memenuhi selera jav Anda.');
        SEOTools::twitter()->setTitle('Daftar lengkap genre Jav');
        SEOTools::twitter()->setDescription('Temukan berbagai jav dalam kategori '.$genre->name.'. Jelajahi daftar jav-jav '.$genre->name.' yang menarik untuk memenuhi selera film Anda.');
        SEOMeta::setKeywords('kategori jav, '.$genre->name.', jav '.$genre->name.', koleksi '.$genre->name.', daftar jav '.$genre->name.'');
        SEOMeta::setRobots('index, follow');
        
        return view('detail-genre', [

            'genre' => $genre
        ]);
    }
}
