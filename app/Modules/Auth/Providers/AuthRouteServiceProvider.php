<?php

namespace App\Modules\Auth\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class AuthRouteServiceProvider extends ServiceProvider
{

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot(): void
    {
        $separator = DIRECTORY_SEPARATOR;
        $this->loadRoutesFrom(__DIR__.$separator.'..'.$separator.'routes'.$separator.'api.php');
        $this->loadMigrationsFrom(__DIR__.$separator.'..'.$separator.'database'.$separator.'migrations');
        $this->loadTranslationsFrom(__DIR__.$separator.'..'.$separator.'lang', 'AuthLocalization');
    }

    public function register(){}

}
