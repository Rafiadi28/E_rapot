<?php

namespace App\Providers;

use App\Models\Siswa;
use App\Policies\SiswaPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Siswa::class => SiswaPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}