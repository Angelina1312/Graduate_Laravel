@extends('layouts.master')

@section('title', 'Главная')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <h2>Порознь мы порой кажемся немного неполноценными, а вместе, превращаясь в единое целое, становимся могучей силой.</h2>
            <p>&copy; Кристофер Паолини</p>
        </div>
        <div class="col-md-6">
            <img src="{{ asset("storage/products/glavnaya.gif")  }}" alt="Выпускники" class="w-100">
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Популярные модели</h2>
        </div>
    </div>
    <div class="row justify-content-center">

        @foreach($products as $product)
            @include('layouts.card', compact('product'))
        @endforeach
    </div>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Прокат</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset("storage/products/ULGU.jpg")  }}" alt="Выпускник" class="w-100">
        </div>
        <div class='col-md-6'>
            <h2>Не хотите покупать мантию на один раз?</h2>
            <p>Если вам нужна мантия выпускника на один день - у нас есть услуга проката мантий. Стоимость аренды одного комплекта (мантия и шапочка) 300 руб / 5 суток.

                При заказе от 10 комплектов - бесплатная доставка и возврат. Заказывайте у нас профессиональную фотосъемку для вашего выпускного +7(495)142-74-23</p>
        </div>
    </div>
</div>


@endsection
