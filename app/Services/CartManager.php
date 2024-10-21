<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CartManager
{

    public function getIdentity(): string
    {
        return session()->getId();
    }
    private function cacheKey(): string
    {
        return str('cart_' . $this->getIdentity())
            ->slug()
            ->value();
    }

    public function forgetCache(): void
    {
        Cache::forget($this->cacheKey());
    }
    private function identityData(string $sessionId): array
    {
        $data = [
            'session_id' => $sessionId
        ];

        if (auth()->check()) {
            $data['user_id'] = auth()->id();
        }

        return $data;
    }

    public function get(): mixed
    {
        return Cache::remember(
            $this->cacheKey(),
            now()->addHour(),
            function () {
                return Cart::query()
                    ->with('cartItems')
                    ->where('session_id', $this->getIdentity())
                    ->when(auth()->check(), fn($query) => $query->orWhere('user_id', auth()->id()))
                    ->first() ?? false;
            }
        );
    }

    public function getCartItems(): Collection
    {
        if (!$this->get()) {
            return collect([]);
        }
        return $this->get()->cartItems()->with('product')->get();
    }

    public function total(): int
    {
        return $this->getCartItems()
            ->sum(fn (CartItem $cartItem) => $cartItem->amount);
    }

    public function add(Product $product, int $quantity = 1): Cart
    {
        // Получаем корзину или создаем новую
        $cart = Cart::query()->updateOrCreate([
            'session_id' => $this->getIdentity(),
        ],
            $this->identityData($this->getIdentity())
        );

        // Проверяем, есть ли такой продукт в корзине
        $existingCartItem = $cart->cartItems()->where('product_id', $product->id)->first();

        if ($existingCartItem) {
            $existingCartItem->update([
                'quantity' => DB::raw("quantity + $quantity"),
                'price' => $product->price,
            ]);
        } else {
            $cart->cartItems()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price,
                'cart_id' => $cart->id,
            ]);
        }

        $this->forgetCache();

        return $cart;
    }

    public function truncate(): void
    {
        if (!$this->get()) {
            return;
        }

        $this->get()->delete();

        $this->forgetCache();
    }
}
