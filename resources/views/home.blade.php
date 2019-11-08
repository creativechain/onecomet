@extends('layouts.app')

@section('header-scripts')
    {{--<script src="https://js.stripe.com/v3/"></script>--}}
@endsection

@section('content')
    <script>
        //JS Global CONSTANTS
        window.fiat = @json($fiat);
        window.lastPrice = @json($lastPrice);
        window.lastPrice.tokenToFiat = function (amount) {
            return amount * (this.price / Math.pow(10, this.counter_precision));
        };
        window.lastPrice.fiatToToken = function (amount) {
            return (amount * (1 / (this.price / Math.pow(10, this.counter_precision)))).toFixed(this.precision);
        };

        window.settings = @json($settings);
    </script>
    <div v-cloak id="buy-process" class="container">
        {!! Form::open(['route' => 'purchase.buy', 'method' => 'POST']) !!}
            <div v-show="step === 1">
                @include('buy_process.step1')
            </div>
            <div v-show="step === 2" class="p-address">
                @include('buy_process.step2')
            </div>
            <div v-show="step === 3" class="p-address">
                @include('buy_process.step3')
            </div>
            <div v-show="step === 4" class="p-summary">
                @include('buy_process.step4')
            </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('footer-scripts')
    <script src="{{ asset('js/steps.js') }}"></script>
@endsection