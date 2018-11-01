<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Graduado;
use App\Pais;
use App\DepartamentoEstado;
use App\EstadoCivil;
use App\Discapacidad;
use App\Facultad;
use App\GradoGraduado;
use App\EscuelaProfesional;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre_completo' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:users',
            'dni' => 'required|number|max:8',
            'celular' => 'required|number|max:9',
            'anio_nacimiento' => 'required|date',
            'genero' => 'required',
            'pais' => 'required',
            'departamento' => 'required',
            'distrito' => 'required',
            'direccion' => 'required|string',
            'estado_civil' => 'required',
            'cantidad_hijos' => 'integer|max:9',
            'discapacidad' => 'required',
            'facultad' => 'required',
            'escuela' => 'required',
            'anio_ingreso' => 'required|date',
            'anio_egreso' => 'required|date',
            'anio_bachiller' => 'required',
            'anio_titulo' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    protected function index()
    {
        $pais = Pais::all();
        $discapacidad = Discapacidad::all();
        $escuela = EscuelaProfesional::all();
        $facultad = Facultad::all();
        $departamento = DepartamentoEstado::all();
        $estado_civil = EstadoCivil::all(); 
        return view('auth.register', compact('pais', 'discapacidad', 'escuela', 'facultad', 'departamento', 'estado_civil'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // Creando Graduado
        Graduado::create([
            'DNI' => $data['dni'],
            'Nombre' => $data['nombre_completo'],
            'Telefono' => $data['celular'],
            'Correo' => $data['correo'],
            'AnioNacimiento' => $data['anio_nacimiento'],
            'Genero' => $data['genero'],
            'PaisResidencia' => $data['pais'],
            'EstadoDepartamento' => $data['departamento'],
            'DistritoCiudad' => $data['distrito'],
            'Dirección' => $data['direccion'],
            'EstadoCivil' => $data['estado_civil'],
            'CantHijos' => $data['cantidad_hijos'],
            'Discapacidad' => $data['discapacidad'],
            'Facultad' => $data['facultad'],
            'Escuela' => $data['escuela'],
            'Ingreso' => $data['anio_ingreso'],
            'egreso' => $data['anio_egreso'],
            'AnioBachiller' => $data['anio_bachiller'],
            'AnioTitulo' => $data['anio_titulo']
        ]);

        // Creando GradoGraduado
        GradoGraduado::create([
            'idGraduado' => $data['dni'],
            'anioGraduacion' => $data['anio_bachiller'],
        ]);
        
        $grado_graduado = new GradoGraduado();
        
        if ($data['anio_titulo']) {
            $grado_graduado->Grado = 2;
        } else {
            $grado_graduado->Grado = 1;
        }
        
        // Creando User
        User::create([
            'id' => $data['dni'],
            'user' => $data['dni'],
            'password' => bcrypt($data['password']),
            'tipo' => 4,
            'estado' => 0,
        ]);
            
        $grado_graduado->save();

        // return Graduado::create([
        //     'DNI' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => bcrypt($data['password']),
        // ]);
        return redirect('/');
    }
}
