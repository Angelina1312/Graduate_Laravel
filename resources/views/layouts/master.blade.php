<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Интернет магазин: @yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="{{ route('index') }}">Graduate.moscow <br> Мантии выпускников</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item @if(Route::currentRouteNamed('index')) active @endif">
                <a class="nav-link" href="{{ route('index') }}">Главная <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item @if(Route::currentRouteNamed('all_tovs')) active @endif">
                <a class="nav-link" href="{{ route('all_tovs') }}">Все товары <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item @if(Route::currentRouteNamed('categories')) active @endif">
                <a class="nav-link" href="{{ route('categories') }}">Категории</a>
            </li>
            <li class="nav-item @if(Route::currentRouteNamed('basket')) active @endif">
                <a class="nav-link" href="{{ route('basket') }}">В корзину</a>
            </li>
            <li class="nav-item @if(Route::currentRouteNamed('contacts')) active @endif">
                <a class="nav-link" href="{{ route('contacts') }}">Контакты</a>
            </li>
        </ul>
    </div>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            @guest
                <li class="nav-item @if(Route::currentRouteNamed('login')) active @endif">
                    <a href="{{ route('login') }}" class="nav-link">Войти</a>
                </li>
            @endguest

            @auth
                @admin
                    <li class="nav-item @if(Route::currentRouteNamed('home')) active @endif">
                        <a href="{{ route('home') }}" class="nav-link">Панель администратора</a>
                    </li>
            @else
                    <li class="nav-item @if(Route::currentRouteNamed('person.orders.index')) active @endif">
                        <a href="{{ route('person.orders.index') }}" class="nav-link">Мои заказы</a>
                    </li>
                @endadmin
                    <li class="nav-item @if(Route::currentRouteNamed('get-logout')) active @endif">
                        <a href="{{ route('get-logout') }}" class="nav-link">Выйти</a>
                    </li>
            @endauth
        </ul>
    </div>
</nav>


<div class="container">
        @if(session()->has('success'))
        <p class="alert alert-success">{{ session()->get('success') }}</p>
        @endif
            @if(session()->has('warning'))
                <p class="alert alert-warning">{{ session()->get('warning') }}</p>
            @endif
    @yield('content')
</div>


        <div class="container-fluid footer">
            <div class="row mt-5 pt-4">
                <div class="col-md-3 text-left">
                    <p>В нашем интернет-магазине представлен большой <br> выбор мантий для выпускников <br>и не только.</p>
                    <p>Интернет-магазин Graduate &copy; 2021</p>
                </div>

                <div class="col-md-3 text-left">
                    <h2 class="font-italic">Интернет-магазин Graduate</h2>
                    <ul>
                        <li><a href="{{ route('about') }}">О нас</a></li>
                        <li><a href="{{ route('contacts') }}">Контакты</a> </li>
                        <li><a href="{{ route('advantages') }}">Наши преимущества</a></li>
                    </ul>
                </div>

                <div class="col-md-3 text-left">
                    <h2 class="font-italic">Покупателям</h2>
                    <ul>
                        <li><a href="{{ route('all_tovs') }}">Каталог</a></li>
                        <li><a href="{{ route('information') }}">Полезная информация</a></li>
                    </ul>
                </div>
                <div class="col-md-3 text-left">
                    <h2 class="font-italic">Помощь</h2>
                    <ul>
                        <li><a href="{{ route('place-order') }}">Как оформить заказ</a></li>
                        <li><a href="{{ route('payment') }}">Способы оплаты</a></li>
                        <li><a href="{{ route('exchange') }}">Обмен и возврат</a></li>
                    </ul>
                </div>
        </div>
    </div>

    <script src="{{asset('custom.js')}}"></script>

</body>
</html>
