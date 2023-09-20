<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    
    public function index()
    {
        SEOTools::setTitle('Profile - ' . auth()->user()->name . '', false);
        SEOTools::setDescription('Lihat profil ' . auth()->user()->name . ' dalam aplikasi streaming film kami.');
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::setCanonical(url()->current());
        SEOTools::opengraph()->addProperty('type', 'profile');
        SEOTools::opengraph()->setTitle('Profil ' . auth()->user()->name);
        SEOTools::opengraph()->setDescription('Lihat profil ' . auth()->user()->name . ' dalam aplikasi streaming film kami.');
        SEOTools::twitter()->setTitle('Profil ' . auth()->user()->name);
        SEOTools::twitter()->setDescription('Lihat profil ' . auth()->user()->name . ' dalam aplikasi streaming film kami.');
        
        return view('livewire.user-profile.edit');
    }
}
