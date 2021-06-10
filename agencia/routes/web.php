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
Route::get('/modificarRegion/{id}', function($id)
{
    //obtenemos datos de la region
    /*
     $Region = DB::select("
                    SELECT regID, regNombre
                        FROM regiones
                        WHERE regID = :regID",
                        [$id]
                    );
    */
    $Region = DB::table('regiones')
                    ->where('regID', $id)
                    ->first();
    //retornamos vista con datos
    return view('modificarRegion',['Region'=>$Region]);
});
Route::post('/modificarRegion', function()
{
    //capturamos datos
    $regID = $_POST['regID'];
    $regNombre = $_POST['regNombre'];
    //modificamos
    /*
    DB::update('
                UPDATE regiones
                    set regNombre = ?
                    where regID = ?',
                [$regNombre, $regID]
        );
    */
    DB::table('regiones')
            ->where( 'regID', $regID )
            ->update( [ 'regNombre'=>$regNombre ] );
    //redirigimos + mensaje ok
    return redirect('/adminRegiones')
            ->with('mensaje', 'Región: '.$regNombre.' modificada correctamente');
});
Route::get('/eliminarRegion/{id}', function($id)
{
    //obtenemos datos de una región por su id
    $Region = DB::table('regiones')
                    ->where('regID', $id)
                    ->first();
    //retornamos vista de confirmación de baja
    return view('eliminarRegion', [ 'Region'=>$Region ]);
});
Route::post('/eliminarRegion', function()
{
    //capturamos datos
    $regNombre = $_POST['regNombre'];
    $regID = $_POST['regID'];
    //eliminamos
    DB::table('regiones')
            ->where('regID', $regID)
            ->delete();
    //redirigimos + mensaje ok
    return redirect('/adminRegiones')
        ->with('mensaje', 'Región: '.$regNombre.' eliminada correctamente');
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
Route::post('/agregarDestino', function()
{
    //capturamos datos enviados por el form
    $destNombre = $_POST['destNombre'];
    $regID = $_POST['regID'];
    $destPrecio = $_POST['destPrecio'];
    $destAsientos = $_POST['destAsientos'];
    $destDisponibles = $_POST['destDisponibles'];
    //insertamos
    /*DB::insert("
                INSERT INTO destinos
                        (destNombre, regID, destPrecio, destAsientos, destDisponibles)
                    VALUE
                        (:destNombre, :regID, :destPrecio, :destAsientos, :destDisponibles)",
                [$destNombre, $regID, $destPrecio, $destAsientos, $destDisponibles]
        );
    */
    DB::table('destinos')
            ->insert(
                [
                    'destNombre'=>$destNombre,
                    'regID'=>$regID,
                    'destPrecio'=>$destPrecio,
                    'destAsientos'=>$destAsientos,
                    'destDisponibles'=>$destDisponibles
                ]
            );
    //redirección con mensaje ok
    return redirect('/adminDestinos')
                ->with(['mensaje'=>'Destino: ' . $destNombre . ' agregado correctamente']);
});
Route::get('/modificarDestino/{id}', function($id)
{
    //obtenemos datos de un destino por su id
    $Destino = DB::table('destinos')
                    ->where('destID', $id)
                    ->first();
    //obtenemos listado de regiones
    $regiones = DB::table('regiones')->get();
    //retornamos vista + datos
    return view('modificarDestino',
                    [
                        'Destino'=>$Destino,
                        'regiones'=>$regiones
                    ]
                );
});
Route::post('/modificarDestino', function()
{
    //capturamos datos enviados por el form
    $destNombre = $_POST['destNombre'];
    $regID = $_POST['regID'];
    $destPrecio = $_POST['destPrecio'];
    $destAsientos = $_POST['destAsientos'];
    $destDisponibles = $_POST['destDisponibles'];
    $destID = $_POST['destID'];
    //modificamos
    DB::table('destinos')
            ->where( 'destID', $destID )
            ->update(
                [
                    'destNombre'        =>  $destNombre,
                    'regID'             =>  $regID,
                    'destPrecio'        =>  $destPrecio,
                    'destAsientos'      =>  $destAsientos,
                    'destDisponibles'   =>  $destDisponibles
                ]
            );
    //redirección + mensaje ok
    return redirect('/adminDestinos')
        ->with(['mensaje'=>'Destino: ' . $destNombre . ' modificado correctamente']);
});
