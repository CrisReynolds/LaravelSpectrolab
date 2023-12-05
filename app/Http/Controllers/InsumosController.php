<?php

namespace App\Http\Controllers;
use App\Models\Insumo;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class InsumosController extends Controller
{
    public function index()
    {
        $insumos = Insumo::all();
        return view('insumos.registro_insumos')->with('insumos',$insumos);
    }

    public function confirmarInsumoEliminacion (Request $insumo)
    {
        $insumo->delete();
    }


    public function destroy($id)
    {
        $insumos = Insumo::find($id)->delete();
        session()->flash('exito',"Insumo eliminado correctamente");
        return view('insumos.registro_insumos')->with('insumos',$insumos);
    }

}
