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
    'except' => ['destroy', 'edit', 'show', 'store', 'create']
]);
Route::get('/datos', 'GraduadoController@getDatos')->name('graduado.datos');

// Admin
Route::resource('/admin', 'AdminController')->middleware('admin');

// Verificar el logueo
Route::resource('/logueo', 'LogueoController', [
    'except' => ['create', 'show', 'edit', 'update', 'destroy']
]);

// Rutas alternas
Route::get('{path}', 'HomeController@index')->where('path', '([A-z\d-\/_.]+)?');