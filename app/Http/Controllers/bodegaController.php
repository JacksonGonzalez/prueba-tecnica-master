<?php

namespace App\Http\Controllers;

use App\bodega;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class bodegaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return bodega::orderBy('created_at', 'ASC')->get();
        return DB::select('SELECT bod.*, user.foto FROM bodegas bod, users user WHERE bod.id_responsable = user.id ORDER BY bod.created_at ASC');
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bodegasActivas()
    {
        // return bodega::orderBy('created_at', 'ASC')->get();
        return bodega::where('estado', 1)->get();         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bodega = new bodega();
        $bodega->nombre = $request->nombreBodega;
        $bodega->id_responsable = $request->id_responsable;
        $bodega->estado = $request->estado;
        $bodega->save();
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
     * @param  int  $id  Request $request, 
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
        $bodega = bodega::findOrFail($id);
        $bodega->estado = $estadoCambiado;
        $bodega->save();

        // return $id.$estadoCambiado;
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
