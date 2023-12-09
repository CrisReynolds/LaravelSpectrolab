<?php

namespace App\Livewire;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Insumo;
use Livewire\Component;

class DetalleCompras extends Component
{
    public $compra_id;
    public $compras_id, $insumo_id, $observacion_insumo, $cantidad, $importe;
    public function index($id)
    {
        return view('compras.ver-detalle-compras', compact('id'));
    }
    public function render()
    {
        $compra = Compra::findOrFail($this->compra_id);
        $detalles = DetalleCompra::where('compras_id', $this->compra_id)->get();
        $insumos = Insumo::orderBy('detalle')->get();
        return view('livewire.detalle-compras', compact('compra','detalles','insumos'));
    }
    public function storeDetalleCompra($id)
    {
        $this->validate([
            //'compras_id' => 'required',
            'insumo_id' => 'required',
            'importe' => 'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
            'cantidad' => 'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
        ]);
        DetalleCompra::create([
            'compras_id' => $id,
            'insumo_id' => $this->insumo_id,
            'observacion_insumo' => $this->observacion_insumo,
            'cantidad' => $this->cantidad,
            'importe' => $this->importe
        ]);
        try {

            //$this->resetFields();
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }
    public function deleteDetalleCompra($id)
    {
        DetalleCompra::find($id)->delete();
        //session()->flash('message', 'Post Deleted Successfully.');
    }
}
