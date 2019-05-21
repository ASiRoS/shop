@extends('app')

@section('content')
    @foreach($categories as $category)
        <h2>Блок: {{ $category->name }}</h2>
        <section class="products row">
            @foreach($category->products as $product)
                <section class="card product col-sm-3">
                    <img src="{{ asset($product->image) }}" alt="" width="253" height="253" class="card-img-top">
                    <div class="card-body">
                        <a href="{{ route('product', ['product' => $product]) }}" class="card-title">{{ $product->name }}</a>
                        <a href="{{ route('payment.choose', ['$product' => $product]) }}" class="btn btn-primary">Купить</a>
                    </div>
                </section>
            @endforeach
        </section>
    @endforeach

    <style>
        .product { margin: 10px; }

        .product a { display: block; }

        .product .card-title { font-size: 20px; }
    </style>
@stop