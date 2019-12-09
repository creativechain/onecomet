@extends('layouts.app')

@section('content')
<div class="container p-summary">
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
                            <li><p class="font-12 font-weight-bold">@user</p></li>
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
                                    <select class="form-control">
                                        <option>Default select</option>
                                    </select>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <ul class="list-unstyled">
                            <li><h2 class="font-16 font-weight-bold">Datos del comprador</h2></li>
                            <li><p class="font-12 font-weight-bold">nombre@gmail.com</p></li>
                            <li><p class="font-12 font-weight-bold">+34 666 666 666</p></li>
                        </ul>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <ul class="list-unstyled">
                            <li><p class="font-12 mb-0 font-weight-bold">Nombre Apellido Apellido</p></li>
                            <li><p class="font-12 mb-0">Calle Nombre de la calle, nº000, 00 - 00</p></li>
                            <li><p class="font-12 mb-0">CP 00000</p></li>
                            <li><p class="font-12 mb-0">Provincia</p></li>
                            <li><p class="font-12 mb-0">País</p></li>
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
            <div class="card mt-5" style="width: 100%">
                <div class="card-header">
                    <h2 class="font-16 font-weight-bold mb-0 text-uppercase">Datos de la tarjeta de crédito/débito</h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="" placeholder="Introduce el nombre del titular">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="" placeholder="Número de la tarjeta">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <select id="inputState" class="form-control">
                                <option selected>Número de la tarjeta</option>
                                <option>...</option>
                                <option>...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="number" class="form-control" id="inputPassword4" placeholder="CVV">
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
            <button class="font-14 btn btn-secondary text-uppercase font-weight-bold w-100" type="submit">Volver</button>
        </div>
        <div class="col-12 col-md-3 text-center">
            <button class="font-14 btn btn-primary text-uppercase font-weight-bold w-100" type="submit">Continuar</button>
        </div>
    </div>
</div>
@endsection
