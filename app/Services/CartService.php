<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;

class CartService implements CartServiceInterface
{
    public static function getCurrentCart($session = null): Cart
    {
        if (!$session) {
            $session = SessionService::getCurrentSession();
        }
        $cart = $session->carts->where('open', 1)->first();
        if (!$cart) {
            $cart = Cart::query()->create(['session_id' => $session->id]);
        }
        return $cart;
    }

    public function getTotalPrice(Cart $cart): float
    {
        $products = $cart->products;
        $fullPrice = 0;
        foreach ($products as $product) {
            $fullPrice += $product->price * $product->pivot->count;
        }
        return round($fullPrice, 2);
    }

    public function addToCart(array $data): string
    {
        $cart = app(CartServiceInterface::class)->getCurrentCart();
        if (!$cart->products->where('id', $data['product_id'])->first()) {
            $cart->products()->attach([$data['product_id'] => ['count' => $data['count']]]);
            return 'Успешно добавлено';
        } else {
            return 'Продукт уже был добавлен ранее';
        }
    }

    public function deleteFromCart(array $data): string
    {
        $cart = app(CartServiceInterface::class)->getCurrentCart();
        if ($cart->products->where('id', $data['product_id'])->first()) {
            $cart->products()->detach($data['product_id']);
            return 'Успешно удалено';
        } else {
            return 'Продукт уже удален из корзины';
        }
    }

    public function changeCount(array $data): array
    {
        $cart = app(CartServiceInterface::class)->getCurrentCart();
        $cart->products()->detach($data['product_id']);
        $cart->products()->attach([$data['product_id'] => ['count' => $data['count']]]);
        $total = $this->getTotalPrice($cart);
        $product = Product::query()->find($data['product_id']);
        return [
            'price' => round($product->price * $data['count'], 2),
            'total' => $total
        ];
    }
}
