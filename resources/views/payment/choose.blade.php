@extends('app')

@section('content')
    <section class="payments card">
        <div class="card-header">Выберите способ оплаты:</div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm">
                    <a class="pay-yandex">
                        <img src="{{ asset('img/payment/yandex.jpeg') }}" alt="Яндекс Деньги" width="294" height="171">
                    </a>
                </div>
                <div class="col-sm">
                    <a class="pay-qiwi" href="{{ $qiwiLink }}">
                        <img src="{{ asset('img/payment/qiwi.jpeg') }}" alt="Киви" width="294" height="171">
                    </a>
                </div>
                <div class="col-sm">
                    <a class="pay-atm">
                        <img src="{{ asset('img/payment/atm.png') }}" alt="Банковская карта" width="294" height="171">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <form method="POST" action="https://money.yandex.ru/quickpay/confirm.xml" class="d-none yandex-form">
        <input type="hidden" name="receiver" value="{{ $yandexWallet }}">
        <input type="hidden" name="formcomment" value="{{ $product->name }}">
        <input type="hidden" name="short-dest" value="{{ $product->name }}">
        <input type="hidden" name="targets" value="{{ $product->category->name }} {{ $product->name }}">
        <input type="hidden" name="label" class="form-control" value="{{ $product->id }}">
        <input type="hidden" name="quickpay-form" value="shop">
        <input type="hidden" name="sum" value="{{ $product->price }}" data-type="number">
        <input type="hidden" name="paymentType" class="payment-type">
        <input type="hidden" name="successURL" value="{{ route('payment.success') }}">
    </form>
@stop

@section('scripts')
    <script>
        $('.pay-yandex').on('click', function () {
            $('.payment-type').attr('value', 'PC');
            $('.yandex-form').submit();
        });

        $('.pay-atm').on('click', function () {
            $('.payment-type').attr('value', 'AC');
            $('.yandex-form').submit();
        });
    </script>
@stop