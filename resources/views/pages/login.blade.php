@extends('layouts.main')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Вход в систему</h2>
            <form action="{{route('login')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="emailInput" class="form-label">Email адрес</label>
                    <input type="email" class="form-control" id="emailInput" name="email" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="passwordInput" class="form-label">Пароль</label>
                    <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Пароль">
                </div>
                @if($errors->has('loginError'))
                    <div class="alert alert-danger">
                        {{ $errors->first('loginError') }}
                    </div>
                @endif
                <button type="submit" class="btn btn-primary">Войти</button>
                <a href="{{route('register-page')}}" class="btn btn-primary">Зарегистрироваться</a>
            </form>
        </div>
    </div>
@endsection
