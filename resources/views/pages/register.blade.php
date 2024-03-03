@extends('layouts.main')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Регистрация</h2>
            <form action="{{route('register')}}" method="post">
                @csrf
                @if($errors->count())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif
                <div class="mb-3">
                    <label for="nameInput" class="form-label">Имя</label>
                    <input type="text" class="form-control" id="nameInput" name="name" placeholder="Федор">
                </div>
                <div class="mb-3">
                    <label for="emailInput" class="form-label">Email адрес</label>
                    <input type="email" class="form-control" id="emailInput" name="email" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="passwordInput" class="form-label">Пароль</label>
                    <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Пароль">
                </div>
                <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
            </form>
        </div>
    </div>
@endsection
