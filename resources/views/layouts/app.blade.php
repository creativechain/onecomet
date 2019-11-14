<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Onecomet') }} - Compra CREA, CGY y CBD fácilmente con tarjeta de crédito.</title>
    
    <meta property="og:title" content="Onecomet - Compra CREA, CGY y CBD fácilmente con tarjeta de crédito." />
    <meta property="og:description" content="Onecomet es una plataforma segura que facilita la compra de tokens CREA con tarjeta de crédito. Caza un cometa y aumenta tu energía creativa en Creary.net." />
    <meta property="og:url" content="https://onecomet.co" />
    <meta property="og:image" content="https://onecomet.co/img/social/onecomet-f.jpg" />
    <meta property="og:locale" content="es_ES" />
    <meta property="og:locale:alternate" content="en_GB" />

    <link rel='shortcut icon' type='image/x-icon' href='https://onecomet.co/img/social/favicon-onecomet.ico' />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('header-scripts')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <script src="https://kit.fontawesome.com/11ad431a65.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{URL::asset('img/logos/logo-onecomet-navbar.png')}}" alt="Onecomet" class="img-fluid">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="">Comprar</a></li>
                        <li class="nav-item"><a class="nav-link" href="">ES</a></li>
                        <li class="nav-item"><a class="nav-link"  href="">EN</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <footer class="m-footer">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-3">
                    <p class="titulo-footer font-14 font-weight-bold text-white">Información</p>
                    <ul class="list-unstyled ul-footer-vertical">
                        <li><a href="">Precios y comisiones</a></li>
                        <li><a href="">Términos y Condiciones</a></li>
                        <li><a href="">Quines somos</a></li>
                    </ul>
                </div>
                <div class="col-12 col-md-3">
                    <p class="titulo-footer font-14 font-weight-bold text-white">Contacta</p>
                    <ul class="list-unstyled ul-footer-vertical">
                        <li><a href="">support@onecomet.co</a></li>
                        <li><a href="">info@onecomet.co</a></li>
                    </ul>
                </div>
                <div class="col-12 col-md-3">
                    <p class="titulo-footer font-14 font-weight-bold text-white">Métodos de pago</p>
                    <ul class="list-unstyled list-inline ul-footer-payment">
                        <li class="list-inline-item"><img src="{{URL::asset('img/footer/mastercard.png')}}" alt="mastercard" class="img-fluid"></li>
                        <li class="list-inline-item"><img src="{{URL::asset('img/footer/visa.png')}}" alt="visa" class="img-fluid"></li>
                        <li class="list-inline-item"><img src="{{URL::asset('img/footer/amex.png')}}" alt="amex" class="img-fluid"></li>
                        <li class="list-inline-item"><img src="{{URL::asset('img/footer/jcb.png')}}" alt="jcb" class="img-fluid"></li>
                        <li class="list-inline-item"><img src="{{URL::asset('img/footer/discover.png')}}" alt="google pay" class="img-fluid"></li>
                        <li class="list-inline-item"><img src="{{URL::asset('img/footer/diners-club.png')}}" alt="google pay" class="img-fluid"></li>
                        <li class="list-inline-item">
                            <img src="{{URL::asset('img/footer/g-pay.png')}}" alt="google pay" class="img-fluid">
                        </li>
                        <li class="list-inline-item"><img src="{{URL::asset('img/footer/apple-pay.png')}}" alt="google pay" class="img-fluid"></li>
                    </ul>
                </div>
                <div class="col-12 col-md-3">
                    <p class="titulo-footer font-14 font-weight-bold text-white">Social Networks</p>
                    <ul class="list-unstyled list-inline ul-footer-social">
                        <li class="list-inline-item"><a href="https://twitter.com/onecometco" target="_blank"><i class="fab fa-twitter"></i></a></li>
                        <li class="list-inline-item">
                            <a href="https://creary.net/@onecomet" target="_blank"><img src="{{URL::asset('img/footer/crea.png')}}" alt="Onecomet" class="img-fluid"></a>
                        </li>
                        <li class="list-inline-item"><a href="https://medium.com/@onecomet" target="_blank"><i class="fab fa-medium-m"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <footer class="m-footer-legal">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <p class="titulo-footer font-10 text-white mb-0">2019 Algunos derechos reservados Onecomet.co - Creativechain Foundation. G67250124. Santa Caterina 47, 08014, Barcelona, España.</p>
                </div>
            </div>
        </div>
    </footer>
    @yield('footer-scripts')
</body>
</html>
