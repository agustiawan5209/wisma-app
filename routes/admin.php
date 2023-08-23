<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\TransaksiController;


Route::middleware(['auth', 'role:Admin'])->group(function () {

    // Router Kamar

    Route::group(['prefix' => 'Kamar', 'as' => 'Kamar.'], function () {
        Route::controller(KamarController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit', 'edit')->name('edit');
            Route::get('/show', 'show')->name('show');
            Route::post('/store', 'store')->name('store');
            Route::put('/update', 'update')->name('update');
            Route::delete('/delete', 'destroy')->name('delete');
        });
    });

    // router Diskon
    Route::group(['prefix' => 'Diskon', 'as' => 'Diskon.'], function () {
        Route::controller(DiskonController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit', 'edit')->name('edit');
            Route::get('/show', 'show')->name('show');
            Route::post('/store', 'store')->name('store');
            Route::put('/update', 'update')->name('update');
            Route::delete('/delete', 'destroy')->name('delete');
        });
    });

    // router Voucher
    Route::group(['prefix' => 'Voucher', 'as' => 'Voucher.'], function () {
        Route::controller(VoucherController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit', 'edit')->name('edit');
            Route::get('/show', 'show')->name('show');
            Route::post('/store', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
            Route::delete('/delete', 'destroy')->name('delete');
        });
    });

    // router Transaksi
    Route::group(['prefix' => 'Transaksi', 'as' => 'Transaksi.'], function () {
        Route::controller(TransaksiController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/show', 'show')->name('show');
            Route::post('/confirm', 'confirm')->name('confirm');
            Route::delete('/delete', 'destroy')->name('delete');
        });
    });
});
