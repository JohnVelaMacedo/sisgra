<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Universidad Nacional de Ucayali</title>
    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    @guest 
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Universidad Nacional de Ucayali') }}
                        </a>
                    @else   
                        @switch(Auth::user()->tipo)
                            @case(1)
                                <a class="navbar-brand" href="{{ url('/admin') }}">
                                    {{ config('app.name', 'Laravel') }}
                                </a>    
                                @break
                            @case(2)
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    Jefe Departamento <span class="caret"></span>
                                </a>
                                @break
                            @case(3)
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    Director Escuela <span class="caret"></span>
                                </a>
                                @break
                            @case(4)
                                <a class="navbar-brand" href="{{ url('/graduado') }}">
                                    {{ config('app.name', 'Laravel') }}
                                </a>
                                @break
                            @default
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                @break        
                        @endswitch
                    @endguest
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="/">Iniciar Sesión</a></li>
                            <li><a href="{{ route('logueo.index') }}">Registrar</a></li>
                        @else
                            <li class="dropdown">
                                @switch(Auth::user()->tipo)
                                    @case(1)
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                            Super Admin <span class="caret"></span>
                                        </a>    
                                        @break
                                    @case(2)
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                            Jefe Departamento <span class="caret"></span>
                                        </a>
                                        @break
                                    @case(3)
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                            Director Escuela <span class="caret"></span>
                                        </a>
                                        @break
                                    @case(4)
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                            Graduado <span class="caret"></span>
                                        </a>
                                        @break
                                    @default
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                            {{ Auth::user()->name }} <span class="caret"></span>
                                        </a>
                                        @break        
                                @endswitch

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Cerrar Sesión
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $('#pais').change(function(e) {
            var id = $(this).val();
            $('#departamento').html(`<option value="">Elija una opción</option>`);
            axios.get(`/getDepa/${id}`)
                .then(data => {
                    if (data.data.length !== 0) {
                        let datos = data.data;
                        datos.forEach((e, i) => {
                            let departamento = document.getElementById('departamento');
                            departamento.innerHTML += `<option value="${e.DepartamentoEstado}">${e.Nombre}</option>`;
                        });
                    } else {
                        console.log('no hay datos');
                    }
                }).catch(error => {
                    console.log(error);
                })
        }); 

        $('#facultad').change(function(e) {
            var id = $(this).val();
            $('#escuela').html(`<option value="">Elija una opción</option>`);
            axios.get(`/getEsc/${id}`)
                .then(data => {
                    if (data.data.length !== 0) {
                        let datos = data.data;
                        datos.forEach((e, i) => {
                            let facultad = document.getElementById('escuela');
                            escuela.innerHTML += `<option value="${e.idEscuela}">${e.Nombre}</option>`;
                        });
                    } else {
                        console.log('no hay datos');
                    }
                }).catch(error => {
                    console.log(error);
                });
        });

        function valida(e){
            tecla = (document.all) ? e.keyCode : e.which;

            //Tecla de retroceso para borrar, siempre la permite
            if (tecla==8){
                return true;
            }
                
            // Patron de entrada, en este caso solo acepta numeros
            patron =/[0-9]/;
            tecla_final = String.fromCharCode(tecla);
            return patron.test(tecla_final);
        }

        function soloLetras(e) {
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toLowerCase();
            letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
            especiales = [8, 39];

            tecla_especial = false
            for(var i in especiales) {
                if(key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }

            if(letras.indexOf(tecla) == -1 && !tecla_especial)
                return false;
        }
    </script>
</body>
</html>
