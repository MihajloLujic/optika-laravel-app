<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Where to redirect users after login / registration.
     */
    public const HOME = '/admin/dashboard';
}
