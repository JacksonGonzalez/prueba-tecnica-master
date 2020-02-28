<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sql = 'SELECT pro.id, pro.nombre, pro.estado FROM productos as pro';
        return DB::select($sql);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productoBodega()
    {
        $sql = 'SELECT inv.id, bod.nombre as nombreBodega, pro.nombre as nombreProducto, inv.cantidad, inv.created_at FROM bodegas bod, inventarios inv, productos pro WHERE inv.id_bodega = bod.id AND inv.id_producto = pro.id ORDER BY bod.nombre, pro.nombre';
        return DB::select($sql);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        $id = $request->id;
        $estado = $request->estado;
        if($estado == 1){
            $estadoCambiado = '0';
        }else{
            $estadoCambiado = '1';
        }
        $producto = Producto::findOrFail($id);
        $producto->estado = $estadoCambiado;
        $producto->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
