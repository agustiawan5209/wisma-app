<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\CheckoutController;


Route::middleware(['auth', 'role:User'])->group(function () {


    // router Checkout
    // Checkout Controller Only User can be access this routes
    Route::group(['prefix' => 'Checkout', 'as' => 'Checkout.'], function () {
        Route::controller(CheckoutController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/createpesanan', 'checkout')->name('checkout');
            Route::get('Success', 'success')->name('success');
        });
    });

    // Route User Dashboard
    Route::group(['prefix' => 'User', 'as' => 'User.'], function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/', 'dashboard')->name('dashboard');
            Route::get('/setting-profile', 'profile')->name('profile');
            Route::get('/pemesanan-kamar', 'reservasi')->name('reservasi');
            Route::get('/detail-pemesanan-kamar', 'invoice')->name('invoice');
        });
    });
});
