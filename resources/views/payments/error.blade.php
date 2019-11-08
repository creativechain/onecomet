@extends('layouts.app')

@section('content')
    <div class="container p-congratulations vh-80">
        <div class="row justify-content-center">
            <div class="col-12 text-center mt-5">
                <img src="{{ asset('img/congratulations.png') }}" alt="" class="img-fluid">
                <ul class="list-unstyled">
                    <li class="mt-5"><h1 class="font-36 c-primary font-weight-bold">¡Upss! Algo ha ido mal.</h1></li>
                    <li><p class="mb-0 font-16">No se ha podido detectar el pago.</p></li>
                </ul>
            </div>

            <div class="col-12 col-md-4 text-center mb-5">
                <ul class="list-unstyled">
                    <li><p class="font-10">Cualquier duda o problema relacionado con esta operación ponte en contacto con nuestro equipo de soporte en support@onecomet.co</p></li>
                </ul>
            </div>

        </div>
    </div>
@endsection
