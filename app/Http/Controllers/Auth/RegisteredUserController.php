<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class RegisteredUserController extends Controller
{
    public $setting;

    public function __construct()
    {
        $this->setting = SeoSetting::first();
    }
    
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register', [
            'SEOData' => new SEOData(
                title: "Register | " . $this->setting->site_name . "",
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
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
