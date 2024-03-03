<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\ChangeCountProductsInCartRequest;
use App\Http\Requests\DeleteFromCartRequest;
use App\Services\CartService;
use App\Services\CartServiceInterface;

class CartController extends Controller
{
    private CartServiceInterface $service;

    public function __construct(CartServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = app(CartServiceInterface::class)->getCurrentCart();
        return view('pages.cart', [
            'products' => $cart->products->sortBy('id'),
            'total' => $this->service->getTotalPrice($cart),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddToCartRequest $request)
    {
        return response()->json([
            'message' => $this->service->addToCart($request->validated())
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChangeCountProductsInCartRequest $request)
    {
        return response()->json($this->service->changeCount($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteFromCartRequest $request)
    {
        return response()->json([
            'message' => $this->service->deleteFromCart($request->validated())
        ]);
    }
}
