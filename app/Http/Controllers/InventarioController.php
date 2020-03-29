<?php

namespace App\Http\Controllers;

use App\Inventario;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // VERIFICAR SI YA ESTA ESE PRODUCTO EN ESA BODEGA
        $idBodega = $request->id_bodega;
        $idProducto = $request->id_producto;
        $InvCantidad = $request->cantidad;
        $datos = array();
        $datos = Inventario::where('id_bodega', '=', $idBodega)->where('id_producto', '=', $idProducto)->get();
        // return $datos;
        $dato = count($datos);
        if($dato > 0){
            $id = $datos[0];
            $invCant = $datos[3];
        }
        
        if($dato == 0){
            // return($datos.'VACIO');
            // GUARDAR LOS DATOS
            $inventario = new Inventario();
            $inventario->id_bodega = $idBodega;
            $inventario->id_producto = $idProducto;
            $inventario->cantidad = $InvCantidad;
            $inventario->save();
            // var_dump($inventario);
            return $inventario;
        }else{
            
            $inventario = Inventario::find($id);
            // $inventario->id_bodega = $idBodega;
            // $inventario->id_producto = $idProducto;
            $cantidadInv = $InvCantidad + $invCant;
            // $inventario->cantidad = $cantidadInv;
            // $inventario->save();
            // return $InvCantidad;
            // return $inventario;
            // var_dump($inventario);
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function show(Inventario $inventario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventario $inventario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventario $inventario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventario $inventario)
    {
        //
    }
}
