<?php

namespace App\Livewire;

use App\Models\DetalleCompra;
use App\Models\DetalleConsumo;
use Livewire\Component;

class Stock extends Component
{
    public function allStock()
    {
        $detallesConsumo = DetalleConsumo::selectRaw('insumo_id, sum(cantidad) as cant')
        ->groupBy('insumo_id')
        ->get();
        //dd($detalles[1]->cant);
        $idInsumo = array();
        $arrInsumo = array();
        $arrCant = array();
        foreach ($detallesConsumo as $consumo) {
            array_push($idInsumo, $consumo->insumo_id);
            //array_push($arrInsumo, $consumo->insumo->detalle);
            $cantidades = DetalleCompra::where('insumo_id', $consumo->insumo_id)
                ->selectRaw('insumo_id, sum(cantidad) as cant')
                ->groupBy('insumo_id')
                ->get();
            //dd($cantidades[0]->cant);
            array_push($arrInsumo, $cantidades[0]->insumo->detalle);
            array_push($arrCant, $cantidades[0]->cant - $consumo->cant);
        }
        //dd($arrInsumo);
        //dd($arrInsumo);
        $detailNoComsumo = DetalleCompra::whereNotIn(
            'insumo_id',
            $idInsumo
        )
            ->selectRaw('insumo_id, sum(cantidad) as cant')
            ->groupBy('insumo_id')
            ->get();
        $insumos = array();
        for ($x = 0; $x < count($arrInsumo); $x++) {
            $insumos[$idInsumo[$x]] = '(' . $arrCant[$x] . ') ' . $arrInsumo[$x];
        }
        foreach ($detailNoComsumo as $x) {
            $insumos[$x->insumo_id] = '(' . $x->cant . ') ' . $x->insumo->detalle;
        }
        return $insumos;
    }
    public function render()
    {
        $inventario = $this->allStock();
        return view('livewire.stock', compact('inventario'));
    }
}
