@extends('layouts.main')
@section('content')
    @if(!$products->count())
        <h2 class="mb-4">Ваша корзина пуста</h2>
    @else
        <h2 class="mb-4">Ваша корзина</h2>
        @foreach ($products as $product)
            <div class="d-flex align-items-center mb-3 p-2 border cart-wrapper">
                <div class="flex-grow-1">
                    <h5 class="mb-0">{{ $product->name }}</h5>
                    <p class="mb-0">Цена: {{ $product->price }}₽</p>
                </div>
                <div class="d-flex align-items-center counter-wrapper">
                    <button class="btn btn-outline-secondary btn-sm me-2 js-dec-count" data-product-id="{{$product->id}}">-
                    </button>
                    <span>{{ $product->pivot->count }}</span>
                    <button class="btn btn-outline-secondary btn-sm ms-2 js-inc-count" data-product-id="{{$product->id}}">+
                    </button>
                </div>
                <p class="mb-0 ms-3 price" style="width: 200px">Сумма: {{ $product->price * $product->pivot->count }}₽</p>
            </div>
        @endforeach
        <div class="d-flex justify-content-between align-items-center mb-3 p-2 border">
            <h4>Итого:</h4>
            <h4 class="total">{{ $total }}₽</h4>
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary js-create-order">Оформить заказ</button>
        </div>
    @endif
@endsection
