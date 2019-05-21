<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>{{ config('app.name') }} - @yield('title', 'Главная страница')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<nav class="navbar">

</nav>
<div class="container">
    @yield('breadcrumb')
    @yield('content')
</div>
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>