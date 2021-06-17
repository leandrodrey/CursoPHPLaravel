@extends('layouts.plantilla')

    @section('contenido')

        <h1>Alta de una nueva categoria</h1>

        <div class="alert bg-light border border-white shadow round col-8 mx-auto p-4">

            <form action="/agregarCategoria" method="post">
                <div class="form-group">
                    <label for="catNombre">Nombre de la categoria</label>
                    <input type="text" name="catNombre"
                           class="form-control" id="catNombre" required>
                </div>
                <button class="btn btn-dark mr-3">Agregar categoria</button>
                <a href="/adminCategorias" class="btn btn-outline-secondary">
                    Volver a panel
                </a>
            </form>
        </div>



    @endsection

