<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderServiceInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private OrderServiceInterface $service;

    public function __construct(OrderServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $orders = auth()->user()->orders()->orderByDesc('id')->with('cart.products')->paginate('15') ?? [];
        return view('pages.orders', [
            'orders' => $orders
        ]);
    }

    public function store(Request $request)
    {
        $order = $this->service->createOrder();

        return response()->json([
            'url' => route('orders.success', $order),
        ]);
    }

    public function show(Order $order)
    {
        return view('pages.order-success', [
            'order' => $order
        ]);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json([
            'url' => route('home'),
            'count' => auth()->user()->orders()->count()
        ]);
    }

    public function success(Order $order)
    {
        return view('pages.order-success', [
            'order' => $order
        ]);
    }
}
