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
Route::get('/agregarRegion', function()
{
    //retornamos vista del formulario
    return view('agregarRegion');
});
Route::post('/agregarRegion', function ()
{
    //capturamos datos enviados por el form
    $regNombre = $_POST['regNombre'];
    //guardamos en bDD
    DB::insert("INSERT INTO regiones
                           ( regNombre )
                    VALUES ( :regNombre )
                    ", [ $regNombre ] );
    //redirigimos con mensaje ok
    return redirect('/adminRegiones')
                ->with('mensaje', 'Región: '.$regNombre.' agregada correctamente');
});
################################
#### CRUD de destinos
Route::get('/adminDestinos', function ()
{
    $destinos = DB::select("
                SELECT destID, destNombre, regNombre, destPrecio
                    FROM regiones r, destinos d
                    WHERE r.regID = d.regID
                ");
    return view('adminDestinos',
                [ 'destinos'=>$destinos ]
            );
});
Route::get('/agregarDestino', function ()
{
    //obtener listado de regiones
    //$regiones = DB::select('SELECT regID, regNombre FROM regiones');
    $regiones = DB::table('regiones')
                        ->get();  // fetchAll()
    //retornar vista pasanmdo datos
    return view('agregarDestino', ['regiones'=>$regiones]);
});
