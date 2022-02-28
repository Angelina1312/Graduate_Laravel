@extends('layouts.master')

@section('title', 'Оформить заказ')

@section('content')

        <h1>Подтвердите заказ:</h1>

                <p>Общая стоимость: <b>{{ $order->getFullPrice() }} ₽.</b></p>
                <form action="{{ route('basket-confirm') }}" method="POST">
                    <div class="form-group">
                        <label for="exampleInputName1">Ваше имя:</label>
                        <input type="text" class="form-control" id="exampleInputName1" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPhone1">Номер телефона:</label>
                        <input type="text" class="form-control" id="exampleInputPhone1" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    @csrf
                    <input type="submit" class="btn btn-primary" value="Подтвердите заказ">
                </form>



@endsection
