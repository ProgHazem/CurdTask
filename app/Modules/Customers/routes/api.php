<?php

use Illuminate\Support\Facades\Route;


Route::namespace('App\Modules\Customers\Http\Controllers\API')->group(function () {
    Route::prefix('api/v1/')->group(function () {
        Route::prefix('customers/')->middleware(['auth:api', 'api'])->group(function () {
            Route::get('', 'CustomerController@index');
            Route::get('{customer}', 'CustomerController@show');
            Route::post('', 'CustomerController@store');
            Route::put('{customer}', 'CustomerController@update');
            Route::delete('{customer}', 'CustomerController@delete');
        });
    });
});


