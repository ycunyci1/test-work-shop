@extends('layouts.main')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Успех!</h4>
            <p>Ваш заказ успешно создан.</p>
            <hr>
            <p class="mb-0">В ближайшее время с вами свяжется наш менеджер для подтверждения заказа.</p>
        </div>
        <div class="d-flex justify-content-between">
            <a href="{{route('home')}}" class="btn btn-outline-primary">Продолжить покупки</a>
        </div>
    </div>
</div>
@endsection
