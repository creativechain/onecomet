@extends('layouts.app')

@section('header-scripts')
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')
    <div v-cloak id="buy-process" class="container">
        {!! Form::open(['route' => 'purchase.buy', 'method' => 'POST']) !!}
            <div v-if="step === 1">
                @include('buy_process.step1')
            </div>
            <div v-else-if="step === 2" class="p-address">
                @include('buy_process.step2')
            </div>
            <div v-else-if="step === 3" class="p-address">
                @include('buy_process.step3')
            </div>
            <div v-else-if="step === 4" class="p-summary">
                @include('buy_process.step4')
            </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('footer-scripts')
    <script src="{{ asset('js/steps.js') }}"></script>
@endsection