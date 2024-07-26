<?php

namespace App\Modules\LookUps\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class LookUpsRouteServiceProvider extends ServiceProvider
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
    }

    public function register(){}

}
