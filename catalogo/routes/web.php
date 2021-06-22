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
Route::post('/agregarMarca', [ MarcaController::class, 'store' ] );
Route::get('/modificarMarca/{id}', [ MarcaController::class, 'edit' ]);
Route::put('/modificarMarca', [ MarcaController::class, 'update' ]);
Route::get('/eliminarMarca/{id}', [ MarcaController::class, 'confirmarBaja' ] );

###########################################
#### CRUD de categorias
use App\Http\Controllers\CategoriaController;
Route::get('/adminCategorias', [ CategoriaController::class, 'index' ]);
Route::get('/agregarCategoria', [ CategoriaController::class, 'create' ]);

