<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />

    <link rel="stylesheet" href="{{ asset('css/login.css') }}" type="text/css"/>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="menu navbar navbar-expand-md navbar-light shadow-sm">

                <a class="navbar-brand" href="{{ url('/home') }}" style="margin-left: 2%">
                    {{ 'Gestión de Actividades' }}
                    <! --   <img src="{{asset("logo/Actividades Andalucía.png")}}" width="50" height="50">
                    <! -- config('app.name', 'Laravel') -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto  animate__animated animate__bounceIn" style="margin-right: 2%">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                                </li>
                            @endif
                        @else
                            @role('encargado')
                            <li class="nav-item animate__backInLeft">
                                <a class="nav-link" href="{{ route('listado_usu') }}">{{ __('Listado de usuarios') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('crear_usuario') }}">{{ __('Añadir usuario') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('listado_actividades') }}">{{ __('Listado de Actividades') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('crear_actividad') }}">{{ __('Crear Actividad') }}</a>
                            </li>
                            @endrole
                            @role('profesor')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('mis_actividades') }}">{{ __('Mis Actividades') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('actividades') }}">{{ __('Todas las actividades') }}</a>
                            </li>
                            @endrole

                            <li class="nav-item dropdown" >

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if(Auth::user()->getFirstMedia()!=null)
                                        <img src="{{Auth::user()->getFirstMedia()->getUrl("thumb")}}">
                                    @else
                                        <img src="{{asset('storage/default/conversions/usuario-thumb.png')}}">
                                    @endif
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href='/perfil'>
                                        {{ __('Mi perfil') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>

        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
@yield('js')

</html>
