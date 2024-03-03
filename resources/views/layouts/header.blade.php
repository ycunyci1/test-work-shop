<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Интернет-Магазин</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('home')}}">Главная</a>
                </li>
            </ul>
            <div class="d-flex">
                @if(!auth()->user())
                    <a class="btn btn-outline-primary me-2" href="{{route('login')}}">Авторизация</a>
                @else
                    <a class="btn btn-outline-primary me-2" href="{{route('logout')}}">Выйти</a>
                    <a class="btn btn-outline-success me-2" href="{{route('orders.index')}}">Заказы</a>
                @endif

                <a class="btn btn-outline-success me-2" href="{{route('cart.index')}}">Корзина</a>
            </div>
        </div>
    </div>
</nav>
