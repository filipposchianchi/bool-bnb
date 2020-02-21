<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- ChartJS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    {{-- tomtom map --}}
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.47.0/maps/maps.css'>

    {{-- braintree --}}
    <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="sapp">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand logo" href="{{ url('/') }}">
                    <img src="{{url('/images/logo.svg')}}" alt="" style="color: red">
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
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user') }}">
                                        Appartamenti
                                    </a>
                                    {{-- <a class="dropdown-item" href="{{ route('user') }}">
                                        Messaggi
                                    </a> --}}
                                    <a class="dropdown-item" href="{{ route('apartments.generalCharts') }}">
                                        Statistiche appartamenti
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="">
            @yield('content')
        </main>
        <footer class="mt-5">
            <div class="container">
                <div class="row justify-content-center faqs">
                    <div class="col-md-3">
                        <p><b>Airbnb</b></p>
                        <ul class="list-unstyled">
                            <li><a href=""> Opportunità di lavoro </a></li>
                            <li><a href=""> News </a></li>
                            <li><a href=""> Condizioni </a></li>
                            <li><a href=""> Diversità e appartenenza </a></li>
                            <li><a href=""> Accessibilità </a></li>
                            <li><a href=""> Informazioni di contatto </a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <p><b>Scopri</b></p>
                        <ul class="list-unstyled">
                            <li><a href=""> Affidabilità e sicurezza </a></li>
                            <li><a href=""> Crediti di viaggio </a></li>
                            <li><a href=""> Cittadino di Airbnb </a></li>
                            <li><a href=""> Viaggi di lavoro </a></li>
                            <li><a href=""> Attività </a></li>
                            <li><a href=""> Airbnbmag </a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <p><b>Ospita</b></p>
                        <ul class="list-unstyled">
                            <li><a href=""> Perché affittare </a></li>
                            <li><a href=""> Ospitalità </a></li>
                            <li><a href=""> Ospitare responsabilmente </a></li>
                            <li><a href=""> Community Center </a></li>
                            <li><a href=""> Offri un'esperienza </a></li>
                            <li><a href=""> Open Homes </a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <p><b>Assistenza</b></p>
                        <ul class="list-unstyled">
                            <li><a href=""> Aiuto </a></li>
                            <li><a href=""> Servizio di assistenza di quartiere </a></li>
                        </ul>
                    </div>
                </div>
                <div class="row socials justify-content-between mt-4">
                    <div class="col-6">
                        © 2020 Airbnb, Inc. All rights reserved.Termini · Privacy · Mappa del sito
                    </div>
                    <div class="col-3">
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href=""><i class="fab fa-facebook-f"></i></a> </li>
                            <li class="list-inline-item"><a href=""><i class="fab fa-twitter"></i></a> </li>
                            <li class="list-inline-item"><a href=""><i class="fab fa-instagram"></i></a> </li>
                          </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    {{-- <script>
        tt.map({
            key: 'yfpz8kRCWBBiIF0WZOIZLdtsH2DhAfBG',
            container: 'map',
            center:[39.20660000,9.13499000],
            style: 'tomtom://vector/1/basic-main',
            zoom:3
        });
      </script> --}}
</body>
</html>
