<div class="row mt-3 mb-4">
    <div class="col-12 text-center">
        <h1 class="titulo-seccion font-weight-bold">Compra CREA al instante con tu forma de pago preferida</h1>
    </div>
</div>
<div class="row align-items-center">
    <div class="col-12 col-md-6">
        <div class="card p-5" style="width: 100%">
            <div class="row">
                <div class="col-12">
                    <ul class="list-unstyled">
                        <li><h2 class="font-16 font-weight-bold">¿Cómo sigo?</h2></li>
                        <li><p class="font-14">Lee y sigue los pasos que se muestran a continuación. </p></li>
                    </ul>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 col-md-2 text-center">
                    <p class="font-16 c-primary">1.</p>
                </div>
                <div class="col-12 col-md-10">
                    <p class="mt-0 font-12 mb-0">Añade el nombre de usuario de CREA, este nombre funciona como una dirección donde se enviará el saldo que estás comprando. </p>
                    <ul class="list-unstyled line-height-1">
                        <li><a href="" class="font-10">Saber más sobre la blockchain de CREA.</a></li>
                        <li><a href="" class="font-10">Crear un @usuario. </a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-2">
                    <p class="font-16 c-primary text-center">2.</p>
                </div>
                <div class="col-12 col-md-10">
                    <p class="mt-0 font-12 mb-0">Selecciona el método de pago con el que quieres realizar la compra.</p>
                    <ul class="list-unstyled line-height-1">
                        <li><a href="" class="font-10">Precios y comisiones</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card" style="width: 100%">
            <div class="m-form">
                <div class="padding-card pl-5 pr-5 pt-3 pb-3 border-bottom">
                    <div class="form-row">
                        <div class="col-md-12">
                            <ul class="list-inline list-unstyled m-ul-total mb-0">
                                <li class="list-inline-item">
                                    <p class="font-36 font-weight-bold c-primary mb-0">100,00 <span class="font-16 text-uppercase">eur</span> </p>
                                </li>
                                <li class="list-inline-item">
                                    <img src="{{URL::asset('img/home/simbolo-igual.png')}}" alt="profile Pic" class="img-fluid">
                                </li>
                                <li class="list-inline-item text-right">
                                    <p class="font-weight-bold font-20 c-primary mb-0">243,789 CREA</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="padding-card pl-5 pr-5 pt-3 pb-3">
                    <div class="form-row">
                        <div class="col-md-12 mb-1">
                            <label class="mb-0" for="validationDefaultUsername">1. Introduce tu usuario de Crea</label>
                            <p class="sub-label">Es el nombre de @usuario con el que te conectas a creary.net</p>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">@</div>
                                </div>
                                {{--<input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Username">--}}
                                {!! Form::text('username', null, ['v-model' => 'form.username', 'class' => 'form-control', 'id' => 'username','placeholder' => 'Username', 'aria-describedby' => 'username', 'required']) !!}

                            </div>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="col-md-12 mb-3">
                            <label class="mb-0" for="validationDefaultUsername">2. ¿Cómo quieres pagar?</label>
                            <p class="sub-label">A continuación selecciona el método de pago.</p>
                            <div class="input-group">
                                {!! Form::select('payment_method', $paymentMethods, 'card', ['v-model' => 'form.payment_method', 'class' => 'form-control', 'id' => 'payment_method', 'aria-describedby' => 'payment_method', 'required']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center mt-4 mb-4">
    <div class="col-12 col-md-3 text-center">
        <button v-on:click="backStep(2)" class="font-14 btn btn-secondary text-uppercase font-weight-bold w-100"> Volver</button>
    </div>
    <div class="col-12 col-md-3 text-center">
        <button v-on:click="nextStep(2)" class="font-14 btn btn-primary text-uppercase font-weight-bold w-100" >Continuar</button>
    </div>
</div>