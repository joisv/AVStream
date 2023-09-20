<?php

namespace App\Http\Controllers;

use App\Models\Actress;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class ActressController extends Controller
{
    public $description;
    
    public function __construct()
    {
        $this->description = 'Daftar aktris jav yang terkenal dan populer dalam aplikasi streaming jav kami.';
    }
    
    public function index()
    {
        SEOTools::setTitle('Actress | Daftar actrees jav', false);
        SEOTools::setDescription($this->description);
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->addProperty('type', 'article');
        SEOTools::opengraph()->setTitle('Daftar actrees jav');
        SEOTools::opengraph()->setDescription($this->description);
        SEOTools::twitter()->setTitle('Daftar actrees jav');
        SEOTools::twitter()->setDescription($this->description);
        SEOMeta::setKeywords('daftar aktris jav, aktris jav terkenal, aktris jav populer, aplikasi streaming jav');
        SEOMeta::setRobots('index, follow');
        
        return view('actresses');
    }

    public function show(Actress $actress)
    {
        SEOTools::setTitle('Detail Aktris: '.$actress->name.'', false);
        SEOTools::setDescription('Temukan berbagai actress jav dalam '.$actress->name.'. Jelajahi actress jav-jav '.$actress->name.' yang menarik untuk memenuhi selera jav Anda.');
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::setCanonical(url()->current() . '/' . $actress->slug);
        SEOTools::opengraph()->addProperty('type', 'video.movie');
        SEOTools::opengraph()->setTitle('Daftar lengkap genre Jav');
        SEOTools::opengraph()->addImage(asset('storage/'.$actress->profile));
        SEOTools::opengraph()->setDescription('Temukan berbagai actress jav dalam '.$actress->name.'. Jelajahi actress jav-jav '.$actress->name.' yang menarik untuk memenuhi selera jav Anda.');
        SEOTools::jsonLd()->addImage(asset('storage/'.$actress->profile));
        SEOTools::twitter()->setTitle('Daftar lengkap genre Jav');
        SEOTools::twitter()->addImage(asset('storage/'.$actress->profile));
        SEOTools::twitter()->setDescription('Temukan berbagai actress jav dalam '.$actress->name.'. Jelajahi actress jav-jav '.$actress->name.' yang menarik untuk memenuhi selera film Anda.');
        SEOMeta::setKeywords('Actress jav, '.$actress->name.', jav '.$actress->name.', koleksi '.$actress->name.', daftar jav '.$actress->name.'');
        SEOMeta::setRobots('index, follow');
        
        return view('actress', [
            'actress' => $actress
        ]);    
    }

    public function actressCollection()
    {
        SEOTools::setTitle('Daftar Aktris JAV | ' . auth()->user()->name, false);
        SEOTools::setDescription('Daftar aktris JAV terkenal dan populer dalam aplikasi streaming JAV kami.');
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->addProperty('type', 'article');
        SEOTools::opengraph()->setTitle('Daftar Aktris JAV');
        SEOTools::opengraph()->setDescription('Daftar aktris JAV terkenal dan populer dalam aplikasi streaming JAV kami.');
        SEOTools::twitter()->setTitle('Daftar Aktris JAV');
        SEOTools::twitter()->setDescription('Daftar aktris JAV terkenal dan populer dalam aplikasi streaming JAV kami.');
        SEOMeta::setKeywords('daftar aktris JAV, aktris JAV terkenal, aktris JAV populer, aplikasi streaming JAV');
        SEOMeta::setRobots('index, follow');
        
        return view('actress-collection');
    }
}
