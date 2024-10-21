<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\Factory;

class CartController extends Controller
{
    public function index(): View|Application|Factory
    {
        $cartItems = cart()->getCartItems();

        return view('cart.index', compact('cartItems'));
    }

    public function add(Product $product): RedirectResponse
    {
        cart()->add($product, request('quantity', 1));

        return redirect()
            ->intended(route('cart.index'))
            ->with('success', 'Товар добавлен в корзину');
    }
}