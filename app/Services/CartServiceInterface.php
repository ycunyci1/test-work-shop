<?php

namespace App\Services;

use App\Models\Cart;

interface CartServiceInterface
{
    public static function getCurrentCart($session = null): Cart;

    public function addToCart(array $data): string;

    public function getTotalPrice(Cart $cart): float;

    public function deleteFromCart(array $data): string;

    public function changeCount(array $data): array;
}
