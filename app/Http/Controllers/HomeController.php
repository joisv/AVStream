<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\SeoSetting;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = SeoSetting::first();

        return view('welcome', [
            'SEOData' => new SEOData(
                site_name: $setting->site_name,
                title: $setting->site_name,
                description: $setting->description,
                author: 'joisvvv',
                robots: 'follow, index',
            ),
        ]);
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
