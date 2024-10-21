<?php

use App\Services\CartManager;

if (!function_exists('cart')) {

    function cart(): CartManager
    {
        return app(CartManager::class);
    }
}
