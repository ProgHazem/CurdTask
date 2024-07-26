<?php

use Illuminate\Support\Facades\Route;


Route::namespace('App\Modules\Services\Http\Controllers\API')->group(function () {
    Route::prefix('api/v1/')->group(function () {
        Route::prefix('services/')->middleware(['auth:api', 'api'])->group(function () {
            Route::get('', 'ServiceController@index');
            Route::get('get-services-customer/{customer}', 'ServiceController@getServicesCustomer');
            Route::post('', 'ServiceController@store');
            Route::put('{service}', 'ServiceController@update');
            Route::delete('{service}', 'ServiceController@delete');
        });
    });
});


