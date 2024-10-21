<?php

use App\Http\Controllers\Order\OrderController;
use Illuminate\Support\Facades\Route;


Route::controller(OrderController::class)
    ->prefix('orders')
    // ->middleware('auth')
    ->group(function () {
        Route::get('/', 'index')->name('orders.index');
        Route::post('/create', 'create')->name('orders.create');
        Route::delete('/{order}/destroy', 'destroy')->name('orders.destroy');
    });
