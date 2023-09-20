<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\SeoSetting;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public $site,
        $description;

    public function __construct()
    {
        $this->site = SeoSetting::first();
        $this->description = 'If you have any questions, comments, or feedback, please feel free to reach out to us using the contact form below.';
    }

    public function index()
    {
        SEOTools::setTitle('Contact Us | ' . ($this->site->site_name ?? '') . '', false);
        SEOTools::setDescription($this->description);
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->addProperty('type', 'article');
        SEOTools::opengraph()->setTitle('Contact Us');
        SEOTools::opengraph()->setDescription($this->description);
        SEOTools::twitter()->setTitle('Contact Us');
        SEOTools::twitter()->setDescription($this->description);
        SEOMeta::setKeywords('Kontak kami,
        Hubungi kami,
        Informasi kontak,
        Cara menghubungi kami,
        Lokasi kantor,
        Kirim pesan,
        Feedback,
        Beri saran,
        Support,
        Customer service,
        Pertanyaan,
        Konsultasi,
        Layanan pelanggan');
        SEOMeta::setRobots('index, follow');

        $contacts = Contact::all();
        return view('contact', compact('contacts'));
    }

    public function terms()
    {
        return view('terms', [
            'terms' => $this->site->terms ?? []
        ]);
    }

    public function about()
    {
        return view('about', [
            'about' => $this->site->about ?? []
        ]);
    }
}
