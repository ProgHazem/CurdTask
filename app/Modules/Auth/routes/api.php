<?php

use Illuminate\Support\Facades\Route;


Route::namespace('App\Modules\Auth\Http\Controllers\API')->group(function () {
    Route::prefix('api/v1/')->group(function () {
        Route::prefix('auth/')->group(function () {
            Route::middleware('custom.throttle')->group(function () {
                Route::post('/login', 'LoginController@login');
            });

            Route::middleware('auth:api')->delete('/logout', 'LogoutController@logout');
        });
    });
});

