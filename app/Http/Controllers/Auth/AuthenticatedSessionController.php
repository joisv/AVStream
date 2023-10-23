<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\SeoSetting;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class AuthenticatedSessionController extends Controller
{
    public $setting;

    public function __construct()
    {
        $this->setting = SeoSetting::first();
    }
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login', [
            'SEOData' => new SEOData(
                title: "Login | " . $this->setting->site_name . "",
                description: $this->setting->description,
                tags: [
                    'jav guru', 'jav', 'jav sub indo', 'jav most', 'jav streaming', 'free jav', 'jav stream', 'jav online',
                    'streaming jav', 'jav subtitle', 'jav subindo', 'jav subtitle indo', 'jav uncesored leak', 'jav hd', 'jav cosplay'
                ],
                robots: 'noindex, nofollow'
            )
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
