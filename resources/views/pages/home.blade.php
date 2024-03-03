@extends('layouts.main')
@section('content')
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card" data-id="{{$product->id}}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Цена: {{ $product->price }} ₽</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                @if($cart && $cart->products->where('id', $product->id)->first())
                                    <button type="button" disabled
                                            class="btn btn-sm btn-outline-secondary js-add-to-cart">В корзине
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger ms-1 js-delete-from-cart">Удалить
                                        из корзины
                                    </button>
                                @else
                                    <button type="button" class="btn btn-sm btn-outline-secondary js-add-to-cart">
                                        Добавить в корзину
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger ms-1 js-delete-from-cart d-none">
                                        Удалить из корзины
                                    </button>
                                @endif
                            </div>
                            <div @class([
                                        'counter-wrapper',
                                        'd-flex',
                                        'align-items-center',
                                        'd-none' => $cart && $cart->products->where('id', $product->id)->first(),
                                        ])>
                                <small class="text-muted">Количество:</small>
                                <input type="number" value="1" min="1" class="form-control js-counter"
                                       style="width: 60px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{$products->links()}}
@endsection
