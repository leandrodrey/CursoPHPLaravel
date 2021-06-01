<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function ()
{
    return view('welcome');
});

//Route::get('peticion', 'acción');
Route::get('/saludo', function()
{
    return 'Hola Mundo!!!';
});
Route::get('/prueba', function ()
{
    return view('primera');
});
#### plantillas
Route::get('/inicio', function ()
{
    return view('inicio');
});
#### listado de prueba usando raw SQL
Route::get('/listado', function()
{
    $regiones = DB::select("SELECT regID, regNombre
                                FROM regiones");
    dd($regiones);
});

################################
#### CRUD de regiones
Route::get('/adminRegiones', function()
{
    //obtenemos listado de regiones
    $regiones = DB::select("SELECT regID, regNombre
                                FROM regiones");
    //retornamos la vista pasando dato
    return view('adminRegiones', [ 'regiones'=>$regiones ] );
});
