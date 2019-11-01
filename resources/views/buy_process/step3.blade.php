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
                    <label for="inputEmail1">Introduce email de contacto</label>
                    {{--<input type="email" class="form-control" id="" placeholder="Email">--}}
                    {!! Form::email('email', null, ['v-model' => 'form.email', 'class' => 'form-control', 'id' => 'email','placeholder' => 'Email', 'aria-describedby' => 'email', 'required']) !!}

                </div>
                <div class="form-group col-md-6">
                    <label for="inputDomicilio2">Introduce tu dirección</label>
                    {{--<input type="text" class="form-control" id="" placeholder="Domicilio">--}}
                    {!! Form::text('address', null, ['v-model' => 'form.address', 'class' => 'form-control', 'id' => 'address','placeholder' => 'Domicilio', 'aria-describedby' => 'address', 'required']) !!}
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputPhone3">Introduce Teléfono Móvil y prefijo del país </label>
                   {{-- <input type="number" class="form-control" id="" placeholder="+00 000 000 000">--}}
                    {!! Form::text('phone', null, ['v-model' => 'form.phone', 'class' => 'form-control', 'id' => 'phone','placeholder' => '+00 000 000 000', 'aria-describedby' => 'phone', 'required']) !!}
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPostalCode4">Código Postal del domicilio</label>
                    {{--<input type="number" class="form-control" id="" placeholder="00000">--}}
                    {!! Form::text('zip_code', null, ['v-model' => 'form.zip_code', 'class' => 'form-control', 'id' => 'zip_code','placeholder' => '00000', 'aria-describedby' => 'zip_code', 'required']) !!}
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name5">Introduce tu nombre</label>
                    {{--<input type="text" class="form-control" id="" placeholder="Nombre">--}}
                    {!! Form::text('name', null, ['v-model' => 'form.name', 'class' => 'form-control', 'id' => 'name','placeholder' => 'Nombre', 'aria-describedby' => 'name', 'required']) !!}
                </div>
                <div class="form-group col-md-6">
                    <label for="provincia6">Provincia</label>
                    {{--<input type="text" class="form-control" id="" placeholder="Provincia">--}}
                    {!! Form::text('state', null, ['v-model' => 'form.state', 'class' => 'form-control', 'id' => 'state','placeholder' => 'Provincia', 'aria-describedby' => 'state', 'required']) !!}
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="surname7">Introduce tu apellido</label>
                    {{--<input type="email" class="form-control" id="" placeholder="Apellidos">--}}
                    {!! Form::text('surname', null, ['v-model' => 'form.surname', 'class' => 'form-control', 'id' => 'surname','placeholder' => 'Apellidos', 'aria-describedby' => 'surname', 'required']) !!}
                </div>
                <div class="form-group col-md-6">
                    <label for="country8">País</label>
                    {{--<input type="password" class="form-control" id="" placeholder="España">--}}
                    {!! Form::text('country', null, ['v-model' => 'form.country', 'class' => 'form-control', 'id' => 'country','placeholder' => 'País', 'aria-describedby' => 'country', 'required']) !!}
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="dateOfBirth9">Fecha de nacimiento</label>
                    {{--<input type="email" class="form-control" id="inputEmail4" placeholder="00/00/00">--}}
                    {!! Form::date('birth_date', null, ['v-model' => 'form.birth_date', 'class' => 'form-control', 'id' => 'birth_date','placeholder' => '00/00/00', 'aria-describedby' => 'birth_date', 'required']) !!}
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
        <button v-on:click="nextStep(3)" class="font-14 btn btn-primary text-uppercase font-weight-bold w-100">Continuar</button>
    </div>
</div>
