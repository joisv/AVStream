<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\SeoSetting;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class ContactController extends Controller
{
    public $site,
        $description;

    public function __construct()
    {
        $this->site = SeoSetting::first();
    }

    public function index()
    {
        $contacts = Contact::all();
        $SEOData =  new SEOData(
            title: 'Contact Webmaster | '.$this->site->site_name,
            description: $this->site->description,
            robots: 'noindex, nofollow',
            tags: ['jav guru', 'jav', 'jav sub indo', 'jav most', 'jav streaming', 'free jav', 'jav stream', 'jav online', 
           'streaming jav', 'jav subtitle', 'jav subindo', 'jav subtitle indo', 'jav uncesored leak', 'jav hd', 'jav cosplay']
        );
        return view('contact', compact(['contacts', 'SEOData']));
    }

    public function terms()
    {
        return view('terms', [
            'terms' => $this->site->terms ?? [],
            'SEOData' => new SEOData(
                title: 'Terms of Use | '.$this->site->site_name,
                description: $this->site->description,
                robots: 'noindex, nofollow',
                tags: ['jav guru', 'jav', 'jav sub indo', 'jav most', 'jav streaming', 'free jav', 'jav stream', 'jav online', 
               'streaming jav', 'jav subtitle', 'jav subindo', 'jav subtitle indo', 'jav uncesored leak', 'jav hd', 'jav cosplay']
            )
        ]);
    }

    public function about()
    {
        return view('about', [
            'about' => $this->site->about ?? [],
            'SEOData' => new SEOData(
                title: 'About this site | '.$this->site->site_name,
                description: $this->site->description,
                robots: 'noindex, nofollow',
                tags: ['jav guru', 'jav', 'jav sub indo', 'jav most', 'jav streaming', 'free jav', 'jav stream', 'jav online', 
               'streaming jav', 'jav subtitle', 'jav subindo', 'jav subtitle indo', 'jav uncesored leak', 'jav hd', 'jav cosplay']
            )
        ]);
    }
}
