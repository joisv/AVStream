<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public $description;

    
    public function show(Category $category)
    {
        SEOTools::setTitle('Category - '.$category->name .'', false);
        SEOTools::setDescription('Temukan berbagai jav dalam kategori '.$category->name.'. Jelajahi daftar jav-jav '.$category->name.' yang menarik untuk memenuhi selera jav Anda.');
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::setCanonical(url()->current() . '/' . $category->slug);
        SEOTools::opengraph()->addProperty('type', 'video.movie');
        SEOTools::opengraph()->setTitle($category->name);
        SEOTools::opengraph()->setDescription('Temukan berbagai jav dalam kategori '.$category->name.'. Jelajahi daftar jav-jav '.$category->name.' yang menarik untuk memenuhi selera jav Anda.');
        SEOTools::twitter()->setTitle($category->name);
        SEOTools::twitter()->setDescription('Temukan berbagai jav dalam kategori '.$category->name.'. Jelajahi daftar jav-jav '.$category->name.' yang menarik untuk memenuhi selera film Anda.');
        SEOMeta::setKeywords('kategori jav, '.$category->name.', jav '.$category->name.', koleksi '.$category->name.', daftar jav '.$category->name.'');
        SEOMeta::setRobots('index, follow');
        
        return view('category', [
            'category' => $category
        ]);
    }
}
