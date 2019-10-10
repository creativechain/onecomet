@extends('layouts.app')

@section('content')
<div class="container">

    {!! Form::open(['route' => 'purchase.buy', 'method' => 'POST']) !!}

    <div class="form-group col-sm-12 col-md-6 col-lg-3">
        {!! Form::label('crea_user', 'Enviar a', ['class' => 'awesome']) !!}
        {!! Form::input('text', 'crea_user', '', ['id' => 'crea_user', 'class' => 'form-control', 'aria-describedby' => 'formHelp', 'required']) !!}

        @if ($errors->has('crea_user'))
            <span class="help-block text-danger">
                    <strong>{{ $errors->first('crea_user') }}</strong>
                </span>
        @endif
    </div>

    <div class="form-group col-sm-12 col-md-6 col-lg-3">
            {!! Form::label('payment_method', 'Método de pago', ['class' => 'awesome']) !!}
            {!! Form::select('payment_method', ['card' => 'Tarjeta', 'bank' => 'Cuenta bancaria'], '', ['id' => 'payment_method', 'class' => 'form-control', 'aria-describedby' => 'formHelp', 'required']) !!}

            @if ($errors->has('payment_method'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('payment_method') }}</strong>
                </span>
            @endif
    </div>

    <div class="form-group col-sm-12 col-md-6 col-lg-3">
        {!! Form::label('crypto_currency', 'Crypto a comprar', ['class' => 'awesome']) !!}
        {!! Form::select('crypto_currency', ['crea' => 'CREA', 'cbd' => 'CBD'], '', ['id' => 'crypto_currency', 'class' => 'form-control', 'aria-describedby' => 'formHelp', 'required']) !!}
        @if ($errors->has('crypto_currency'))
            <span class="help-block text-danger">
                <strong>{{ $errors->first('crypto_currency') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-sm-12 col-md-6 col-lg-3">
        {!! Form::label('fiat_currency', 'Moneda de pago', ['class' => 'awesome']) !!}
        {!! Form::select('fiat_currency', ['eur' => 'Euro', 'usd' => 'Dollar'], '', ['id' => 'fiat_currency', 'class' => 'form-control', 'aria-describedby' => 'formHelp', 'required']) !!}
        @if ($errors->has('fiat_currency'))
            <span class="help-block text-danger">
                <strong>{{ $errors->first('fiat_currency') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-sm-12 col-md-6 col-lg-3">
        {!! Form::label('fiat_amount', 'Cantidad a comprar', ['class' => 'awesome']) !!}
        {!! Form::input('number', 'fiat_amount', 10, ['min' => 10, 'step' => 0.01, 'id' => 'fiat_amount', 'class' => 'form-control', 'aria-describedby' => 'formHelp', 'required']) !!}
        @if ($errors->has('fiat_amount'))
            <span class="help-block text-danger">
                <strong>{{ $errors->first('fiat_amount') }}</strong>
            </span>
        @endif
    </div>

    {!! Form::input('hidden','price', (rand(2, 100) / 100)) !!}

    <button type="submit" class="btn btn-primary btn-lg btn-block">Enviar</button>
    {!! Form::close() !!}
</div>
@endsection
