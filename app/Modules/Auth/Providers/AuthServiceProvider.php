<?php

namespace App\Modules\Auth\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Modules\Auth\Repositories\Interfaces\LoginInterface;
use App\Modules\Auth\Repositories\LoginRepository;


class AuthServiceProvider extends ServiceProvider
{

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot(): void
    {
    }

    public function register()
    {
        $this->app->bind(LoginInterface::class, LoginRepository::class);
    }

}
