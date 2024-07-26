<?php

namespace App\Modules\Services\Providers;

use App\Modules\Services\Models\Service;
use App\Modules\Services\Repositories\Interfaces\ServiceInterface;
use App\Modules\Services\Observers\ServiceObserver;
use App\Modules\Services\Repositories\ServiceRepository;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot(): void
    {
        Service::observe(ServiceObserver::class);
        Route::model('service', Service::class);
        Route::bind('service', function ($service) {
            return Service::where('id', $service)->first() ?? null;
        });
    }

    public function register()
    {
        $this->app->bind(ServiceInterface::class, ServiceRepository::class);
    }

}
