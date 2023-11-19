<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('settings.edit');
    }

    public function basic()
    {
        return view('dashboard.settings.basic');
    }
    public function contactPayment()
    {
        return view('dashboard.settings.contact-payment');
    }

    public function telegram()
    {
        return view('dashboard.settings.telegram');
    }
    
}
