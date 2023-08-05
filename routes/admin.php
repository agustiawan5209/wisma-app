<?php

use App\Http\Controllers\KamarController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'role:Admin'])->group(function () {

    // Router Kamar

    Route::group(['prefix' => 'Kamar', 'as' => 'Kamar.'], function () {
        Route::controller(KamarController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit', 'edit')->name('edit');
            Route::get('/show', 'show')->name('show');
            Route::post('/store', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::delete('/delete', 'destroy')->name('delete');
        });
    });
});
