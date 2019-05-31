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
        <img src="{{ asset($product->image) }}" alt="" width="250" height="300" class="card-img-top">
        <div class="card-body">
            <h2 class="card-title">{{ $product->name }}</h2>
            <p class="description">{{ $product->description }}</p>
            <form action="{{ route('payment.choose', ['product' => $product]) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email" class="sr-only">E-mail:</label>
                    <input id="email" name="email" class="form-control" type="email" placeholder="Введите email" required>
                </div>
                <button class="btn btn-primary">Купить</button>
            </form>
        </div>
    </section>
@stop
