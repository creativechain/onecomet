@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-3 mb-4">
        <div class="col-12 text-center">
            <h1 class="titulo-seccion font-weight-bold">Comprar CREA nunca fue tan fácil</h1>
        </div>
    </div>
    <div class="row align-items-center">
        <div class="col-12 col-md-6">
            <img src="{{URL::asset('img/home/onecomet-illustracion.png')}}" alt="profile Pic" class="img-fluid">
        </div>
        <div class="col-12 col-md-6">
            <div class="card p-5" style="width: 100%">
                <form class="m-form">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label class="mb-0" for="validationDefaultUsername">¿Cuánto quieres comprar?</label>
                            <p class="sub-label">Introduce la cantidad que deseas pagar.</p>
                            <div class="input-group">
                                {{--<input type="number" class="form-control text-right font-weight-bold" id="validationDefaultUsername" placeholder="100.000" aria-describedby="inputGroupPrepend2" required>--}}
                                {!! Form::number('amount', 1, ['class' => 'form-control text-right font-weight-bold', 'id' => 'amount','placeholder' => '10', 'min' => 1, 'aria-describedby' => 'amount', 'required']) !!}
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-eur font-weight-bold" id="inputGroupPrepend2">EUR</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="col-md-12 mb-3">
                            <label class="mb-0" for="validationDefaultUsername">¿Qué tipo de token o servicio quieres?</label>
                            <p class="sub-label">Elige el token que desees comprar.</p>
                            <div class="input-group">
                                {!! Form::select('crypto', $cryptoCurrencies, 'none', ['class' => 'form-control', 'id' => 'crypto', 'aria-describedby' => 'crypto', 'required']) !!}

                                {{--<select class="form-control">
                                    <option>Default select</option>
                                </select>--}}
                            </div>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="col-md-12 mb-3">
                            <a href="" class="font-12">Precios y comisiones</a>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <p class="font-weight-bold text-uppercase font-12 mb-0">importe de la compra</p>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <ul class="list-inline list-unstyled m-ul-total mb-0">
                                <li class="list-inline-item">
                                    <p class="font-36 font-weight-bold c-primary mb-0">1,00 <span class="font-16 text-uppercase">eur</span> </p>
                                </li>
                                <li class="list-inline-item">
                                    <img src="{{URL::asset('img/home/simbolo-igual.png')}}" alt="profile Pic" class="img-fluid">
                                </li>
                                <li class="list-inline-item text-right">
                                    <p class="font-weight-bold font-20 c-primary mb-0">{{ $lastPrice->convert(1) }} CREA</p>
                                </li>
                            </ul>
                        </div>
                    </div>

                </form>
            </div>
            <div class="row mt-5 ">
                <div class="col-12 text-center">
                    <button class="btn btn-primary text-uppercase font-14 font-weight-bold" type="submit">Comprar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
