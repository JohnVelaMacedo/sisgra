<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
                            });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Graduado
Route::resource('/graduado', 'GraduadoController', [
    'except' => ['destroy', 'edit', 'show', 'create']
    ])->middleware('guest');
Route::resource('/escuela', 'escuelaController');

Route::get('/datos', 'GraduadoController@getDatos')->name('graduado.datos');
Route::get('/get-graduado/{id}', 'GraduadoController@getGraduado')->name('graduado.getGraduado');

Route::post('/up-graduado', 'escuelaController@store')->name('graduado.upGraduado');

Route::resource('/escuela', 'escuelaController');

Route::get('/datos', 'GraduadoController@getDatos')->name('graduado.datos');
Route::get('/hoja-vida', 'GraduadoController@getHojaVida')->name('graduado.hoja_vida');

// Admin
Route::resource('/admin', 'AdminController')->middleware('admin');
Route::resource('/facultades', 'ReporteGraduados');
Route::get('/facultadesdatos', 'ReporteGraduados@getDatos');
Route::get('/reportedatos', 'ReporteGeneral@getDatos');
Route::get('reporteexcel', 'ReporteGeneral@excel');
Route::get('reportegraduadospdf', 'ReporteGeneral@pdf');

// Verificar el logueo
Route::resource('/logueo', 'LogueoController', [
    'except' => ['create', 'show', 'edit', 'update', 'destroy']
]);

// Entidad
Route::resource('/entidad', 'EntidadController');

// Rutas alternas
Route::get('{path}', 'HomeController@index')->where('path', '([A-z\d-\/_.]+)?');