@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Registrar</div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('logueo.store') }}" class="form-horizontal">
                            {{ csrf_field() }}
                            
                            <div class="form-row">
                                <div class="col-md-7">
                                    <label for="nombre_completo">Nombre Completo:</label>
                                    <input type="text" name="nombre_completo" id="nombre_completo" 
                                        placeholder="Ingrese su nombre completo" class="form-control" required autofocus 
                                        onkeypress="return soloLetras(event)">
                                </div>
                                <div class="col-md-5">
                                    <label for="dni">DNI:</label>
                                    <input type="text" name="dni" id="dni" placeholder="Ingrese su DNI" class="form-control" 
                                        required onkeypress="return valida(event)" maxlength="8" minlength="8">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-7">
                                    <label for="correo">Correo:</label>
                                    <input type="email" name="correo" id="correo" placeholder="Ingrese su correo" class="form-control" 
                                        required>
                                </div>
                                <div class="col-md-5 mt-4">
                                    <label for="celular">Celular: </label>
                                    <input type="text" name="telefono" id="telefono" placeholder="Ingrese su número de celular" 
                                        class="form-control" required onkeypress="return valida(event)" maxlength="9">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="anio_nacimiento" class="mb-0">Fecha de Nacimiento: </label>
                                    <input type="date" name="anio_nacimiento" id="anio_nacimiento" 
                                        class="form-control px-0" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="genero" class="mb-0">Género: </label>
                                    <select class="form-control px-0" required name="genero" id="genero">
                                        <option value="">Elija una opción</option> 
                                        <option value="M">Masculino</option> 
                                        <option value="F">Femenino</option> 
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="pais" class="mb-0">País: </label>
                                    <select class="form-control px-0" required name="pais" id="pais">
                                        <option value="">Elija una opción</option> 
                                        @foreach ($pais as $p)
                                            <option value="{{$p->idPais}}">{{ $p->Nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="pais" class="mb-0">Departamento: </label>
                                    <select class="form-control px-0" required name="departamento" id="departamento">
                                        <option value="">Elija una opción</option> 
                                        @foreach ($departamento as $d)
                                            <option value="{{$d->DepartamentoEstado}}">{{ $d->Nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="pais" class="mb-0">Distrito: </label>
                                    <select class="form-control px-0" required name="distrito" id="distrito">
                                        <option value="">Elija una opción</option> 
                                        <option value="calleria">Calleria</option> 
                                        <option value="coronel-portillo">Coronel Portillo</option> 
                                        <option value="manantay">Manantay</option> 
                                        <option value="coronel-portillo">Coronel Portillo</option> 
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="direccion" class="mb-0">Dirección: </label>
                                    <input type="text" name="direccion" id="direccion" placeholder="Ingrese su dirección" 
                                        class="form-control px-0" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="estado_civil" class="mb-0">Estado Civil: </label>
                                    <select class="form-control px-0" required name="estado_civil" id="estado_civil">
                                        <option value="">Elija una opción</option> 
                                        @foreach ($estado_civil as $e)
                                            <option value="{{ $e->id }}">{{ $e->descripcion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="discapacidad" class="mb-0">Discapacidad: </label>
                                    <select class="form-control px-0" required name="discapacidad" id="discapacidad">
                                        <option value="">Elija una opción</option> 
                                        @foreach ($discapacidad as $d)
                                            <option value="{{$d->id}}">{{ $d->descripcion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="cantidad_hijos" class="mb-0">Cantidad de Hijos: </label>
                                    <input type="number" name="cantidad_hijos" id="cantidad_hijos" class="form-control px-0" 
                                        max="9" min="0" value="0" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="facultad" class="mb-0">Facultad: </label>
                                    <select class="form-control px-0" required name="facultad" id="facultad">
                                        <option value="">Elija una opción</option> 
                                        @foreach ($facultad as $f)
                                            <option value="{{$f->id}}">{{ $f->Nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="escuela" class="mb-0">Escuela: </label>
                                    <select class="form-control px-0" required name="escuela" id="escuela">
                                        <option value="">Elija una opción</option> 
                                        @foreach ($escuela as $e)
                                            <option value="{{$e->idEscuela}}">{{ $e->Nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="anio_ingreso" class="mb-0">Año de Ingreso: </label>
                                    <input type="date" class="form-control px-0" required name="anio_ingreso" id="anio_ingreso">
                                </div>
                                <div class="col-md-6">
                                    <label for="anio_egreso" class="mb-0">Año de Egreso: </label>
                                    <input type="date" class="form-control px-0" required name="anio_egreso" id="anio_egreso">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="anio_bachiller" class="mb-0">Año de Bachillerato: </label>
                                    <input type="text" class="form-control px-0" required minlength="4" maxlength="4"name="anio_bachiller" 
                                        id="anio_bachiller" placeholder="Ingrese su año de Bachillerato" onkeypress="return valida(event)">
                                </div>
                                <div class="col-md-6">
                                    <label for="anio_titulo" class="mb-0">Año de Titulación: </label>
                                    <input type="text" class="form-control px-0" minlength="4" maxlength="4"name="anio_titulo" 
                                        id="anio_titulo" placeholder="Ingrese su año de Titulacion" onkeypress="return valida(event)">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-block text-uppercase" id="btn-registrar">Registrarse</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection