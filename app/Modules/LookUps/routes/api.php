<?php

use Illuminate\Support\Facades\Route;


Route::namespace('App\Modules\LookUps\Http\Controllers\API')->middleware(['auth:api', 'api'])->group(function () {
    Route::prefix('api/v1/look-ups/')->group(function () {
        Route::get('customers', 'LookUpsController@getCustomers');
    });
});
