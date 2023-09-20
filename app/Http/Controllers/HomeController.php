<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\SeoSetting;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = SeoSetting::first();

        SEOTools::setTitle($setting->site_name ?? '', false);
        SEOTools::setDescription($setting->description ?? '');
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOMeta::setRobots('index, follow');
        SEOMeta::setKeywords($setting->keywords ?? '');
        SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');

        return view('welcome');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {

        $post = Post::where('slug', $request->slug)->with(['actresses', 'genres', 'studios', 'category'])->firstOrFail();
        $post->increment('views');
        return view('watch', [
            'post' => $post
        ]);
    }
}
