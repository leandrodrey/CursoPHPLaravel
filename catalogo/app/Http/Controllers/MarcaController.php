<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //obtenemos listado de marcas
        //DB::select('SELECT sarasa from marcas')
        //DB::table('marcas')->get();
        //$marcas = Marca::all();
        $marcas = Marca::paginate(7);
        //retornamos vista con datos
        return view('adminMarcas', ['marcas'=>$marcas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agregarMarca');
    }

    /**
     * método de validación de formulario
     * @param Request $request
     */
    private function validarForm(Request $request)
    {
        $request->validate(
                        [ 'mkNombre' => 'required|min:2|max:30' ],
                        [
                          'mkNombre.required'=>'El campo "Nombre de la marca" es obligatorio',
                          'mkNombre.min' => 'El campo "Nombre de la marca" debe tener al menos 2 caractéres.',
                          'mkNombre.max' => 'El campo "Nombre de la marca" debe tener 30 caractéres como máximo.'
                        ]
                    );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //capturar lo que envió el form
        $mkNombre = $request->mkNombre; //$_POSTˆ['mkNombre']
        //validar
        $this->validarForm($request);
        //instanciacion, asignacion, guardar
        $Marca = new Marca;
        $Marca->mkNombre = $mkNombre;
        $Marca->save();
        //redirección + mensaje ok
        return redirect('adminMarcas')
                ->with([ 'mensaje'=>'Marca: '.$mkNombre.' agregada correctamente' ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //obtenemos datos de una marca
        $Marca = Marca::find($id);
        //retornamos vista con datos
        return view('modificarMarca', [ 'Marca'=>$Marca ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $mkNombre = $request->mkNombre;
        //validacion
        $this->validarForm($request);
        //obtenemos un marca por su id
        $Marca = Marca::find( $request->idMarca );
        //modificación de atributos
        $Marca->mkNombre = $mkNombre;
        //guardar en bdd
        $Marca->save();
        //redirigir con mensaje ok
        //redirección + mensaje ok
        return redirect('adminMarcas')
            ->with([ 'mensaje'=>'Marca: '.$mkNombre.' modificada correctamente' ]);
    }

    /**
     * Método para chequear si hay un producto de una marca
     * @param $idMarca
     * @return int
     */
    private function productoPorMarca($idMarca)
    {
        //$check = Producto::where('idMarca', $idMarca)->first();
        //$check = Producto::firstWhere('idMarca', $idMarca);
        $check = Producto::where('idMarca', $idMarca)->count();
        return $check;
    }

    public function confirmarBaja($idMarca)
    {
        //obtener datos de una marca por su id
        $Marca = Marca::find($idMarca);
        ## chequear si NO hay productos e ese marca
        if ( $this->productoPorMarca($idMarca) == 0 ){
            //retornamos vista para confirmar baja
            return view('eliminarMarca',
                        [ 'Marca' => $Marca ]
                    );
        }
        return redirect('/adminMarcas')
                            ->with([
                                'mensaje' => 'No se puede eliminar la marca: '.$Marca->mkNombre.' ya que tiene productos relacionados.',
                                'clase'   => 'danger'
                            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $idMarca  = $request->idMarca;
        $mkNombre = $request->mkNombre;
        //Marca::where('idMarca', $idMarca)->delete();
        Marca::destroy($idMarca);
        //redirección + mensaje ok
        return redirect('adminMarcas')
            ->with([ 'mensaje'=>'Marca: '.$mkNombre.' eliminada correctamente' ]);
    }

}
