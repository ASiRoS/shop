@extends('app')

@section('title') {{ $product->name }} ({{ $product->category->name }}) @stop

@section('breadcrumb')
<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
            <li class="breadcrumb-item">{{ $product->category->name }}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>
@stop

@section('content')
<section class="card product">
        <img src="{{ asset($product->image) }}" alt="" width="350" height="500" class="card-img-top">
        <div class="card-body">
            <h2 class="card-title">{{ $product->name }}</h2>
            <p class="description">{{ $product->description }}</p>
            <a href="{{ route('payment.choose', ['product' => $product]) }}" class="btn btn-primary">Купить</a>
        </div>
    </section>
@stop
