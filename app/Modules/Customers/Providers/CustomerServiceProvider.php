<?php

namespace App\Modules\Customers\Providers;

use App\Modules\Customers\Models\Customer;
use App\Modules\Customers\Repositories\Interfaces\CustomerInterface;
use App\Modules\Customers\Observers\CustomerObserver;
use App\Modules\Customers\Repositories\CustomerRepository;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class CustomerServiceProvider extends ServiceProvider
{

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot(): void
    {
        Customer::observe(CustomerObserver::class);
        Route::model('customer', Customer::class);
        Route::bind('customer', function ($customer) {
            return Customer::where('id', $customer)->first() ?? null;
        });
    }

    public function register()
    {
        $this->app->bind(CustomerInterface::class, CustomerRepository::class);
    }

}
