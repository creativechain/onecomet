<div class="row mt-3 mb-4">
    <div class="col-12 text-center">
        <h1 class="titulo-seccion font-weight-bold">Por favor revisa los datos y confírma que son correctos</h1>
    </div>
</div>
<div class="row align-items-center">
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
                            <div class="input-group">
                                @{{ form.payment_method }}
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
            <div class="card-header">
                <h2 class="font-16 font-weight-bold mb-0">Estás comprando</h2>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li><p class="font-14">243,789 CREA<span class="c-primary float-right">98,00 €</span></p></li>
                    <li><p class="font-14">Comisión Onecomet<span class="c-primary float-right">2</span></p></li>
                    <li><p class="font-14">Comisión Tarjeta<span class="c-primary float-right">2,34€</span></p></li>
                    <li><p class="font-16">Total<span class="font-weight-bold c-primary float-right">102,34€</span></p></li>
                </ul>
            </div>
        </div>
        <div v-if="form.payment_method === 'card'" class="card mt-5" style="width: 100%">
            <div class="card-header">
                <h2 class="font-16 font-weight-bold mb-0 text-uppercase">Datos de la tarjeta de crédito/débito</h2>
            </div>
            <div class="card-body">
                <div class="form-group">
                   {{--<input type="text" class="form-control" id="" placeholder="Introduce el nombre del titular">--}}
                    {!! Form::text('card_owner', null, ['class' => 'form-control', 'id' => 'card_owner','placeholder' => 'Introduce el nombre del titular', 'aria-describedby' => 'card_owner', 'required']) !!}
                </div>
                <div class="form-group">
                    {{--<input type="number" class="form-control" id="" placeholder="Número de la tarjeta">--}}
                    {!! Form::number('card_number', null, ['class' => 'form-control', 'id' => 'card_number','placeholder' => 'Número de la terjeta', 'aria-describedby' => 'card_number', 'required']) !!}
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        {!! Form::date('card_date', null, ['class' => 'form-control', 'id' => 'card_date','placeholder' => 'Fecha de caducidad', 'aria-describedby' => 'card_date', 'required']) !!}
                    </div>
                    <div class="form-group col-md-6">
                        {!! Form::number('card_cvv', null, ['class' => 'form-control', 'id' => 'card_cvv','placeholder' => 'CVV', 'aria-describedby' => 'card_cvv', 'required']) !!}
                    </div>
                </div>
                <fieldset class="form-group">
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" >
                                <label class="form-check-label" for="gridRadios1">
                                    Confirmo que soy el titular de la tarjeta
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <div v-else class="card mt-5" style="width: 100%">
            <div class="card-header">
                <h2 class="font-16 font-weight-bold mb-0 text-uppercase">Pago con Google PAy</h2>
            </div>
            <div class="card-body">
                <google-pay
                        pk_key="{{ env('STRIPE_PUBLIC_KEY') }}"
                        sk_key="{{ env('STRIPE_SECRET_KEY') }}"
                        v-bind:amount="form.amount"
                        v-bind:country="form.country"
                ></google-pay>
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
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" >
                                <label class="form-check-label font-12" for="gridRadios1">
                                    Acepto las condiciones generales del servicio y la política de privacidad.
                                </label>
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
                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" >
                                <label class="form-check-label font-12" for="gridRadios1">
                                    Afirmo que el monedero o dirección de usuario que utilizo en esta operación es de mi propiedad y no de un tercero.
                                </label>
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
        <button class="font-14 btn btn-secondary text-uppercase font-weight-bold w-100" >Volver</button>
    </div>
    <div class="col-12 col-md-3 text-center">
        <button class="font-14 btn btn-primary text-uppercase font-weight-bold w-100" >Comprar</button>
    </div>
</div>
