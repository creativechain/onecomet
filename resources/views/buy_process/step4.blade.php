<div class="row mt-3 mb-4">
    <div class="col-12 text-center">
        <h1 class="titulo-seccion font-weight-bold">Por favor revisa los datos y confírma que son correctos</h1>
    </div>
</div>
<div class="row align-items-top">
    <div class="col-12 col-md-6">
        <div class="card p-5" style="width: 100%">
            <div class="row">
                <div class="col-12">
                    <ul class="list-unstyled">
                        <li><h2 class="font-16 font-weight-bold">Usuario</h2></li>
                        <li><p class="font-12 font-weight-bold">@{{ form.username }}</p></li>
                        <li><p class="font-10 c-primary">Esta es la parte más importante. Asegúrese de que la dirección de @usuario es correcta.</p></li>
                    </ul>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <ul class="list-unstyled">
                        <li><h2 class="font-16 font-weight-bold">Método de pago</h2></li>
                        <li><p class="font-12">Tarjeta de crédito/débito</p></li>
                        <li>
                            <div class="form-control button-select-payment text-center">
                                <img src="{{ asset('img/select/card/visa.png') }}" alt="coin crea"> <span class="font-12 font-weight-bold">@{{ form.payment_method }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <ul class="list-unstyled">
                        <li><h2 class="font-16 font-weight-bold">Datos del comprador</h2></li>
                        <li><p class="font-12 font-weight-bold">@{{ form.email }}</p></li>
                        <li><p class="font-12 font-weight-bold">@{{ form.phone }}</p></li>
                    </ul>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <ul class="list-unstyled">
                        <li><p class="font-12 mb-0 font-weight-bold">@{{ form.name }} @{{ form.surname }}</p></li>
                        <li><p class="font-12 mb-0">@{{ form.address }}</p></li>
                        <li><p class="font-12 mb-0">CP @{{ form.zip_code }}</p></li>
                        <li><p class="font-12 mb-0">@{{ form.state }}</p></li>
                        <li><p class="font-12 mb-0">@{{ form.country }}</p></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card" style="width: 100%">
            <div class="card-header bg-azul-claro">
                <h2 class="font-16 font-weight-bold mb-0">Estás comprando</h2>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li><p class="font-14">@{{ ("" + lastPrice.fiatToToken(form.amount)).replace('.', ',') }} @{{ lastPrice.currency.toUpperCase() }}<span class="c-primary float-right">@{{ comissionAmount.toFixed(2).replace('.', ',') }} €</span></p></li>
                    <li><p class="font-14">Comisión Onecomet<span class="c-primary float-right">@{{ ocComission.toFixed(2).replace('.', ',') }} €</span></p></li>
                    <li><p class="font-14">Comisión Tarjeta<span class="c-primary float-right">@{{ stripeComission.toFixed(2).replace('.', ',') }} €</span></p></li>
                    <li><p class="font-16">Total<span class="font-weight-bold c-primary float-right">@{{ total.toFixed(2).replace('.', ',') }}€</span></p></li>
                </ul>
            </div>
        </div>

    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <ul class="list-unstyled">
            <li>
                <fieldset class="form-group mb-0">
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-check">
                                {{--<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" >--}}
                                {!! Form::checkbox('check_tos', 'true', false, ['class' => 'form-check-input', 'id' => 'check_tos', 'aria-describedby' => 'check_tos', 'required']) !!}
                                <label class="form-check-label font-12" for="check_tos">
                                    Acepto las condiciones generales del servicio y la política de privacidad.
                                </label>
                                @if ($errors->has("check_tos"))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first("check_tos") }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </fieldset>
            </li>
            <li>
                <fieldset class="form-group mb-0">
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-check">
                                {!! Form::checkbox('check_username', 'true', false, ['class' => 'form-check-input', 'id' => 'check_username', 'aria-describedby' => 'check_username', 'required']) !!}

                                <label class="form-check-label font-12" for="check_username">
                                    Afirmo que el monedero o dirección de usuario que utilizo en esta operación es de mi propiedad y no de un tercero.
                                </label>
                                @if ($errors->has("check_username"))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first("check_username") }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </fieldset>
            </li>
        </ul>
    </div>
</div>
<div class="row justify-content-center mt-4 mb-4">
    <div class="col-12 col-md-3 text-center">
        <button v-on:click="backStep(4)" class="font-14 btn btn-secondary text-uppercase font-weight-bold w-100" >Volver</button>
    </div>
    <div v-if="form.payment_method === 'card'" class="col-12 col-md-3 text-center">
        <button type="submit" class="font-14 btn btn-primary text-uppercase font-weight-bold w-100">Comprar</button>
    </div>
    <div v-else class="col-12 col-md-3 text-center">
        <google-pay-button>

        </google-pay-button>
    </div>

</div>