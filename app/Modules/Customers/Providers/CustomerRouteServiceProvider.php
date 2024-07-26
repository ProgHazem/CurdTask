<?php

namespace App\Modules\Customers\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class CustomerRouteServiceProvider extends ServiceProvider
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
        $this->loadTranslationsFrom(__DIR__.$separator.'..'.$separator.'lang', 'CustomerLocalization');
    }

    public function register(){}

}
