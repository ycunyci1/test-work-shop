@extends('layouts.main')
@section('content')
    <h2>Все заказы</h2>
    <div class="order-grid">
        @foreach ($orders as $order)
            <div class="order-card">
                <p><strong>Номер заказа:</strong> {{ $order->id }}</p>
                <p><strong>Дата заказа:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
                <p><strong>Товары:</strong> {{ implode(', ', $order->cart->products->pluck('name')->toArray()) }}</p>
                <p><strong>Общая стоимость:</strong> {{ $order->total_price }}₽</p>
                <button class="btn btn-danger btn-sm js-delete-order" data-id="{{$order->id}}">Удалить заказ</button>
            </div>
        @endforeach
    </div>
    @if ($orders->count() > 0)
        <div class="order-total">
            Итоговая стоимость всех заказов: {{ $orders->sum('total_price') }}₽
        </div>
    @else
        <p>Заказы не найдены.</p>
    @endif
    {{$orders->links()}}
@endsection
