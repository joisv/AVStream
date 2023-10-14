<?php

namespace App\Http\Controllers;

use App\Models\SeoSetting;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class VipController extends Controller
{
    public $setting;

    public function __construct()
    {
        $this->setting = SeoSetting::first();
    }
    
    public function index()
    {
        return view('vip', [
            'SEOData' => new SEOData(
                title: "Paket VIP JAV | ".$this->setting->site_name."",
                description: 'Nikmati keuntungan eksklusif dengan Paket VIP '.$this->setting->site_name.'. Akses film dewasa terpanas tanpa batas, kualitas tinggi, dan tanpa iklan. Temukan paket berlangganan VIP kami untuk pengalaman menonton yang tak terlupakan.',
                robots: 'noindex, nofollow',
                tags: ['Paket VIP',' Berlangganan Film Dewasa', 'Akses Tanpa Batas', 'Film Dewasa Premium', 'Nonton Film Tanpa Iklan', 'Keuntungan Paket VIP', 'Konten Eksklusif Dewasa'],
            )
        ]);
    }
}
