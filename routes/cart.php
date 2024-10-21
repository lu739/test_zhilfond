<?php

use App\Http\Controllers\Cart\CartController;
use Illuminate\Support\Facades\Route;


Route::controller(CartController::class)
    ->prefix('cart')
    ->group(function () {
        Route::get('/', 'index')->name('cart.index');
        Route::post('/add/{product}', 'add')->name('cart.add');
    });
