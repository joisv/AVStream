<?php

namespace App\Providers;

use App\Models\Download;
use App\Models\Movie;
use App\Models\User;
use App\Policies\DownloadPolicy;
use App\Policies\EmbedPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [

        Post::class => PostPolicy::class,
        User::class => UserPolicy::class,
        Download::class => DownloadPolicy::class,
        Movie::class => EmbedPolicy::class

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super-admin') ? true : null;
        });
    }
}
