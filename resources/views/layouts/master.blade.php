<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
	<title>Universidad Nacional de Ucayali</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/light-bootstrap-dashboard.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/my-style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/pe-icon-7-stroke.css') }}" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div class="wrapper" id="app">
        <div class="sidebar" data-color="dark" data-image="assets/img/sidebar-5.jpg">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a class="simple-text" style="text-decoration: none">
                        Universidad Nacional de Ucayali
                    </a>
                </div>

                <ul class="nav">
                    @switch(Auth()->user()->tipo)
                        @case(1)
                            <li>
                                <router-link to="/home">
                                    <i class="pe-7s-graph"></i>
                                    <p>Dashboard</p>
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/editar-admin">
                                    <i class="pe-7s-user"></i>
                                    <p>Editar Perfil</p>
                                </router-link>
                            </li>
                            @break
                        @case(2)
                            <li>
                                <router-link to="/home">
                                    <i class="pe-7s-graph"></i>
                                    <p>Dashboard</p>
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/editar-jefe">
                                    <i class="pe-7s-user"></i>
                                    <p>Editar Perfil</p>
                                </router-link>
                            </li>
                            @break
                        @case(3)
                            <li>
                                <router-link to="/home">
                                    <i class="pe-7s-graph"></i>
                                    <p>Dashboard</p>
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/editar-director">
                                    <i class="pe-7s-user"></i>
                                    <p>Editar Perfil</p>
                                </router-link>
                            </li>
                            @break
                        @case(4)
                            <li>
                                <router-link to="/home">
                                    <i class="pe-7s-graph"></i>
                                    <p>Dashboard</p>
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/ver-perfil">
                                    <i class="pe-7s-id"></i>
                                    <p>Ver Perfil</p>
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/editar-perfil">
                                    <i class="pe-7s-user"></i>
                                    <p>Editar Perfil</p>
                                </router-link>
                            </li>        
                            @break
                        @default
                            @break   
                    @endswitch
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            <i class="pe-7s-power"></i>
                            <p>Cerrar Sesión</p>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-default navbar-fixed">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right"></ul>
                    </div>
                </div>
            </nav>

            @yield('content')

            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul>
                            <li>UNU</li>
                        </ul>
                    </nav>
                    <p class="copyright pull-right">
                        &copy; 2018 <a href="http://www.unu.edu.pe" target="_blank">Universidad Nacional de Ucayali</a>
                    </p>
                </div>
            </footer>

        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/jquery-1.10.2.js') }}" type="text/javascript"></script>    
    <script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>    
    <script src="{{ asset('assets/js/bootstrap-checkbox-radio-switch.js') }}" type="text/javascript"></script>    
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/js/light-bootstrap-dashboard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/bootstrap-notify.js') }}" type="text/javascript"></script>
</body>
</html>