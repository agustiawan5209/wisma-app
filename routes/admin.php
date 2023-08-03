<?php

use App\Http\Controllers\KamarController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'role'])->group(function () {

    // Router Kamar
    Route::controller(KamarController::class)
        ->group(['prefix' => 'Kamar', 'as' => 'Kamar.'], function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::put('/update', 'update')->name('update');
            Route::delete('/delete', 'delete')->name('delete');
        });
});
