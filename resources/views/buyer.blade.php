@extends('layouts.app')

@section('content')
<div class="container p-address">
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
                        <input type="email" class="form-control" id="" placeholder="Email">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputDomicilio2">Introduce tu dirección</label>
                        <input type="text" class="form-control" id="" placeholder="Domicilio">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPhone3">Introduce Teléfono Móvil y prefijo del país </label>
                        <input type="number" class="form-control" id="" placeholder="+00 000 000 000">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPostalCode4">Código Postal del domicilio</label>
                        <input type="number" class="form-control" id="" placeholder="00000">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name5">Introduce tu nombre</label>
                        <input type="text" class="form-control" id="" placeholder="Nombre">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="provincia6">Provincia</label>
                        <input type="text" class="form-control" id="" placeholder="Provincia">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="surname7">Introduce tu apellido</label>
                        <input type="email" class="form-control" id="" placeholder="Apellidos">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="country8">País</label>
                        <input type="password" class="form-control" id="" placeholder="España">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="dateOfBirth9">Fecha de nacimiento</label>
                        <input type="email" class="form-control" id="inputEmail4" placeholder="00/00/00">
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row justify-content-center mt-4 mb-4">
        <div class="col-12 col-md-3 text-center">
            <button class="font-14 btn btn-secondary text-uppercase font-weight-bold w-100" type="submit">Volver</button>
        </div>
        <a href="{{ route('summary') }}" class="col-12 col-md-3 text-center">
            <button class="font-14 btn btn-primary text-uppercase font-weight-bold w-100" type="submit">Continuar</button>
        </a>
    </div>
</div>
@endsection
