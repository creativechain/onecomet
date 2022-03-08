<div class="row mt-3 mb-4">
    <div class="col-12 text-center">
        <h1 class="titulo-seccion font-weight-bold">{{ __('web.step1.title') }}</h1>
    </div>
</div>
<div class="row align-items-center">
    <div class="col-12 col-md-6">
        <img src="{{ asset('img/home/onecomet-illustracion.png') }}" alt="profile Pic" class="img-fluid">
    </div>
    <div class="col-12 col-md-6">
        <div class="card p-5" style="width: 100%">
            <div class="m-form">
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label class="mb-0" for="validationDefaultUsername">{{ __('web.step1.much_money') }}</label>
                        <p class="sub-label">{{ __('web.step1.input_money') }}</p>
                        <div class="input-group">
                            {{--<input type="number" class="form-control text-right font-weight-bold" id="validationDefaultUsername" placeholder="100.000" aria-describedby="inputGroupPrepend2" required>--}}
                            {!! Form::number('fiat_amount', $fiat['min_unit'], ['v-model' => 'form.amount', 'class' => 'form-control text-right font-weight-bold', 'id' => 'fiat_amount', 'placeholder' => $fiat['min_unit'], 'min' => $fiat['min_unit'], 'max' => $fiat['max_unit'], 'step' => '0.01', 'aria-describedby' => 'fiat_amount', 'required']) !!}
                            {!! Form::hidden('fiat_currency', $fiat['name']) !!}
                            <div class="input-group-prepend">
                                <span class="input-group-text input-eur font-weight-bold" id="inputGroupPrepend2">EUR</span>
                            </div>
                            <span v-if="step === 1 && validation.error" class="help-block text-danger">
                                <strong>@{{ validation.error }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-row mt-3">
                    <div class="col-md-12 mb-3">
                        <label class="mb-0" for="validationDefaultUsername">{{ __('web.step1.what_token') }}</label>
                        <p class="sub-label">{{ __('web.step1.input_token') }}</p>
{{--                        <div class="input-group d-none">
                            {!! Form::select('token', $cryptoCurrencies, 'none', ['v:model' => 'form.token', 'class' => 'form-control', 'id' => 'token', 'aria-describedby' => 'token', 'required']) !!}

                            @if ($errors->has("token"))
                                <span class="help-block text-danger">
                                    <strong>{{ $errors->first("token") }}</strong>
                                </span>
                            @endif
                        </div>--}}


{{--                        <div class="dropdown">
                            <button class="form-control dropdown-toggle button-select-coins" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{URL::asset('img/select/coins/crea.png')}}" alt="coin crea"> <span>CREA</span>
                            </button>
                            <div class="dropdown-menu dropdown-coins" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#"><img src="{{URL::asset('img/select/coins/crea.png')}}" alt="Coin crea"> CREA</a>
                                <a class="dropdown-item" href="#"><img src="{{URL::asset('img/select/coins/cgy.png')}}" alt="Coin cgy"> CGY</a>
                                <a class="dropdown-item" href="#"><img src="{{URL::asset('img/select/coins/cbd.png')}}" alt="Coin cbd"> CBD</a>
                            </div>
                        </div>--}}

                        <token-selector v-bind:at="{{ str_replace("\"", "'", json_encode(array_keys($cryptoCurrencies))) }}"
                                        v-on:tokenchange="onTokenChange">

                        </token-selector>

                    </div>
                </div>
                <div class="form-row mt-3">
                    <div class="col-md-12 mb-3">
                        <a href="" class="font-12">{{ __('web.step1.prices_and_fees') }}</a>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <p class="font-weight-bold text-uppercase font-12 mb-0">{{ __('web.step1.purchase_amount') }}</p>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <ul class="list-inline list-unstyled m-ul-total mb-0">
                            <li class="list-inline-item">
                                <p class="font-36 font-weight-bold c-primary mb-0">@{{ ("" + form.amount).replace('.', ',') }} <span class="font-16 text-uppercase">eur</span> </p>
                            </li>
                            <li class="list-inline-item">
                                <img src="{{ asset('img/home/simbolo-igual.png') }}" alt="profile Pic" class="img-fluid">
                            </li>
                            <li class="list-inline-item text-right">
                                <p class="font-weight-bold font-20 c-primary mb-0">@{{ ("" + lastPrice.fiatToToken(form.amount)).replace('.', ',') }} @{{ lastPrice.currency.toUpperCase() }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 ">
            <div class="col-12 text-center">
                <button class="btn btn-primary text-uppercase font-14 font-weight-bold" data-toggle="modal" data-target="#oosModal">{{ __('web.buy') }}</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="oosModal" aria-labelledby="oosModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Out Of Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ __('web.out_of_service') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('web.ok') }}</button>
            </div>
        </div>
    </div>
</div>

