<div class="row mt-3 mb-4">
    <div class="col-12 text-center">
        <h1 class="titulo-seccion font-weight-bold">Compra CREA al instante con tu forma de pago preferida</h1>
    </div>
</div>
<div class="row align-items-center">
    <div class="col-12 col-md-12">
        <div class="card p-5" style="width: 100%">
            <div class="row">
                <div class="col-12 col-md-12">
                    <ul class="list-unstyled">
                        <li><h2 class="font-16 font-weight-bold">Datos del comprador</h2></li>
                    </ul>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Introduce email de contacto</label>
                    {{--<input type="email" class="form-control" id="" placeholder="Email">--}}
                    {!! Form::email('email', '', ['v-model' => 'form.email', 'class' => 'form-control', 'id' => 'email','placeholder' => 'Email', 'aria-describedby' => 'email', 'required']) !!}
                    @if ($errors->has("email"))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first("email") }}</strong>
                        </span>
                    @endif

                </div>
                <div class="form-group col-md-6">
                    <label for="address">Introduce tu dirección</label>
                    {{--<input type="text" class="form-control" id="" placeholder="Domicilio">--}}
                    {!! Form::text('address', '', ['v-model' => 'form.address', 'class' => 'form-control', 'id' => 'address','placeholder' => 'Domicilio', 'aria-describedby' => 'address', 'required']) !!}
                    @if ($errors->has("address"))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first("address") }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="phone">Introduce Teléfono Móvil y prefijo del país </label>
                   {{-- <input type="number" class="form-control" id="" placeholder="+00 000 000 000">--}}
                    {!! Form::text('phone', '', ['v-model' => 'form.phone', 'class' => 'form-control', 'id' => 'phone','placeholder' => '+00 000 000 000', 'aria-describedby' => 'phone', 'required']) !!}
                    @if ($errors->has("phone"))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first("phone") }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="zip_code">Código Postal del domicilio</label>
                    {{--<input type="number" class="form-control" id="" placeholder="00000">--}}
                    {!! Form::text('zip_code', '', ['v-model' => 'form.zip_code', 'class' => 'form-control', 'id' => 'zip_code','placeholder' => '00000', 'aria-describedby' => 'zip_code', 'required']) !!}
                    @if ($errors->has("zip_code"))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first("zip_code") }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Introduce tu nombre</label>
                    {{--<input type="text" class="form-control" id="" placeholder="Nombre">--}}
                    {!! Form::text('name', '', ['v-model' => 'form.name', 'class' => 'form-control', 'id' => 'name','placeholder' => 'Nombre', 'aria-describedby' => 'name', 'required']) !!}
                    @if ($errors->has("name"))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first("name") }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="state">Provincia</label>
                    {{--<input type="text" class="form-control" id="" placeholder="Provincia">--}}
                    {!! Form::text('state', '', ['v-model' => 'form.state', 'class' => 'form-control', 'id' => 'state','placeholder' => 'Provincia', 'aria-describedby' => 'state', 'required']) !!}
                    @if ($errors->has("state"))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first("state") }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="surname">Introduce tu apellido</label>
                    {{--<input type="email" class="form-control" id="" placeholder="Apellidos">--}}
                    {!! Form::text('surname', '', ['v-model' => 'form.surname', 'class' => 'form-control', 'id' => 'surname','placeholder' => 'Apellidos', 'aria-describedby' => 'surname', 'required']) !!}
                    @if ($errors->has("surname"))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first("surname") }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="country">País</label>
                    {{--<input type="password" class="form-control" id="" placeholder="España">--}}
                    {!! Form::text('country', '', ['v-model' => 'form.country', 'class' => 'form-control', 'id' => 'country','placeholder' => 'País', 'aria-describedby' => 'country', 'required']) !!}
                    @if ($errors->has("country"))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first("country") }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="birth_date">Fecha de nacimiento</label>
                    {{--<input type="email" class="form-control" id="inputEmail4" placeholder="00/00/00">--}}
                    {!! Form::date('birth_date', '', ['v-model' => 'form.birth_date', 'class' => 'form-control', 'id' => 'birth_date','placeholder' => '00/00/00', 'aria-describedby' => 'birth_date', 'required']) !!}
                    @if ($errors->has("birth_date"))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first("birth_date") }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row justify-content-center mt-4 mb-4">
    <div class="col-12 col-md-3 text-center">
        <button v-on:click="backStep(3)" class="font-14 btn btn-secondary text-uppercase font-weight-bold w-100" >Volver</button>
    </div>
    <div class="col-12 col-md-3 text-center">
        <div v-on:click="nextStep(3)" class="font-14 btn btn-primary text-uppercase font-weight-bold w-100">Continuar</div>
    </div>
</div>
