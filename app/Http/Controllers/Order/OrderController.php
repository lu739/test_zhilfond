<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function create()
    {
        try {
            Order::create([
                'amount' => cart()->total(),
                'product_list' => cart()->getCartItems()->pluck('product.name')->implode(', '),
                'user_id' => auth()->id() ?? null,
            ]);

            cart()->truncate();
        } catch (\Throwable $e) {
            return redirect()
                ->intended(route('cart.index'))
                ->with('flash', 'Произошла ошибка' . $e->getMessage());
        }

        return redirect()
            ->intended(route('cart.index'))
            ->with('flash', 'Заказ создан');
    }

    public function index()
    {
        $orders = Order::all();

        if (auth()->check()) {
            $orders = $orders->where('user_id', auth()->id());
        }

        return view('order.index', compact('orders'));
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()
            ->intended(route('orders.index'))
            ->with('flash', 'Заказ удален');
    }
}
