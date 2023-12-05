<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Insumo;

class Insumos extends Controller
{
    public function edit ($id){
        $insumo = Insumo::find($id);
        return view('insumos.edit',compact('insumo'));
    }
    public function update (Request $request, $id){
        $insumo = Insumo::find($id);
        $insumo->nombre = $request->nombre;
        $insumo->cantidad = $request->cantidad;
        $insumo->save();
        return redirect()->route('insumos.index');
    }

}
