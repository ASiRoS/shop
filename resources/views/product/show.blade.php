@extends('app')

@section('content')
    <p>Категория: <span>{{ $product->category->name }}</span></p>
    <section class="card product">
        <img src="{{ asset($product->image) }}" alt="" width="350" height="500" class="card-img-top">
        <div class="card-body">
            <h2 class="card-title">{{ $product->name }}</h2>
            <p class="description">{{ $product->description }}</p>
            <a href="{{ route('payment.pay', ['product' => $product]) }}" class="btn btn-primary">Купить</a>
        </div>
    </section>
    <section class="yandex">
        <form method="POST" action="https://money.yandex.ru/quickpay/confirm.xml">
            <input type="hidden" name="receiver" value="{{ $yandexWallet }}">
            <div class="form-group">
                <input type="email" name="label" class="form-control" placeholder="email">
            </div>
            <input type="hidden" name="quickpay-form" value="shop">
            <input type="hidden" name="targets" value="Оплата за {{ $product->name }}">
            <input type="hidden" name="sum" value="{{ $product->price }}" data-type="number">
            <label>
                <input type="radio" name="paymentType" value="PC">
                Яндекс.Деньгами
            </label>
            <label>
                <input type="radio" name="paymentType" value="AC">
                Банковской картой
            </label>
            <input type="hidden" name="successURL" value="{{ route('payment.success') }}">
            <button class="btn btn-primary" type="submit">Перевести</button>
        </form>
    </section>
@stop

@section('title') {{ $product->name }} ({{ $product->category->name }}) @stop