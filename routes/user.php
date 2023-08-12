<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\TransaksiController;
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
});
