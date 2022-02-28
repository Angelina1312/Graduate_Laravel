@extends('layouts.master')

@section('title', 'товар')

@section('content')

    <div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset("storage/$product->images") }}" width="400px" height="400px">
        </div>

    <div class="col-md-6 product">
        <div class="card ml-5" style="width: 25rem; height: 20rem;">
            <div class="card-body">
                <h1 class="card-title">{{ $product->name }}</h1>
                <h4 class="card-title">{{ $product->category->name }}</h4>
                <p>Выберите рост</p>
                <select name="" class="form-control">
                    <!-- детский рост -->
                    <!--<option value="1">95-115 см</option>
                    <option value="2">115-130 см</option>
                    <option value="3">130-149 см</option>
                    <option value="4">150-164 см</option>-->
                    <!-- детский рост -->
                    <!-- взрослый рост -->
                    <option value="1">150-164 см</option>
                        <option value="2">165-179 см</option>
                        <option value="3">180-200 см</option>
                    <!-- взрослый рост -->
                </select>
                <p class="price card-text">Цена: <b>{{ $product->price }}</b></p>
                <form action="{{ route('basket-add', $product) }}" method="POST">
                    @if($product->isAvailable())
                        <button type="submit" class="btn btn-default" role="button">В корзину</button>
                    @else
                        <p class="disabled">Нет в наличии</p>
                    @endif
                 @csrf
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>

    <div class="container">
    <div class="row">
        <div class="col mt-3 mb-3">
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModalCenter">
                Получите скидку!
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Промокод на скидку</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Введите промокод STUDENT при заказе и получите скидку 30%.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Понятно!</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <p>{{ $product->description }}</p>
        </div>
    </div>
</div>
@endsection
