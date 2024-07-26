<?php

namespace App\Modules\LookUps\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Modules\LookUps\Repositories\lookUpsRepository;
use App\Modules\LookUps\Repositories\Interfaces\LookUpsInterface;

class LookUpsServiceProvider extends ServiceProvider
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

        $this->app->bind(LookUpsInterface::class, LookUpsRepository::class);
    }

}
