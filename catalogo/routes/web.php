<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

###########################################
#### CRUD de marcas
use App\Http\Controllers\MarcaController;
Route::get('/adminMarcas', [ MarcaController::class, 'index' ]);
Route::get('/agregarMarca', [ MarcaController::class, 'create' ] );
