@extends('app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
            <li class="breadcrumb-item">Оплата</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="alert alert-success">Спасибо за покупку!</div>
@endsection