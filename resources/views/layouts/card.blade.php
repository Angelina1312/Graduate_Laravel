
<div class="col-sm-6 col-md-4">
    <div class="card" style="width: 18rem;">
    <div class="labels">
        @if($product->isNew())
            <span class="badge badge-success">Новинка</span>
        @endif

            @if($product->isRecommend())
                <span class="badge badge-warning">Рекомендуем</span>
            @endif

            @if($product->isHit())
                <span class="badge badge-danger">Хит продаж!</span>
            @endif
    </div>
        <a href="{{ route('product', [$product->category->code, $product->code]) }}" class="btn btn-default" role="button">
            <img src="{{ asset("storage/$product->images")  }}" class="card-img-top" alt="{{ $product->images }}"></a>
    <div class="card-body">
        <a href="{{ route('product', [$product->category->code, $product->code]) }}"><h4 class="card-title">{{ $product->name }}</h4></a>
        <p class="card-text">{{ $product->price }} руб.</p>

        <div class="card_bottom">

        <form action="{{ route('basket-add', $product) }}" method="POST">
            @csrf
            @if($product->count > 0)
                <button type="submit" class="btn btn-primary" role="button">В корзину</button>
            @else
                Нет в наличии
            @endif
                <a href="{{ route('product', [$product->category->code, $product->code]) }}" class="btn btn-default" role="button">Подробнее</a>
        </form>
        </div>
    </div>
</div>
</div>
