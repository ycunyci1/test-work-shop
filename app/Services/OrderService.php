<?php

namespace App\Services;

use App\Models\Order;

class OrderService implements OrderServiceInterface
{
    public function createOrder(): Order
    {
        $user = auth()->user();
        $cart = app(CartServiceInterface::class)->getCurrentCart();
        $order = Order::query()->create([
            'user_id' => $user->id,
            'cart_id' => $cart->id,
            'total_price' => app(CartServiceInterface::class)->getTotalPrice($cart),
        ]);
        $cart->update([
            'open' => 0,
        ]);

        return $order;
    }
}
