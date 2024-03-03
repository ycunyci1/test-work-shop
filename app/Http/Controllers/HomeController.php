<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use App\Services\CartServiceInterface;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home', [
            'products' => Product::query()->paginate(15),
            'cart' => app(CartServiceInterface::class)->getCurrentCart(),
        ]);
    }
}
