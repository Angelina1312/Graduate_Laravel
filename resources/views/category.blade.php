@extends('layouts.master')

@section('title', 'Категория ' . $category->name)

@section('content')

        <!-- меняем название категории и условие, чтобы было на русском -->
        <h1>
        {{$category->name}} {{ $category->products->count() }}
        </h1>
        <p>
            {{$category->description}}
        </p>

    <div class="row">
        @foreach($category->products as $product)
            @include('layouts.card', compact('product'))
        @endforeach

    </div>

@endsection
