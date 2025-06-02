<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\UserRole;

class RoleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('user.role', function ($app) {
            return new UserRole();
        });
    }

    public function boot()
    {
        //
    }
}