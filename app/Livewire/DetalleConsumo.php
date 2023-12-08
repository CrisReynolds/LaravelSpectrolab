<?php

namespace App\Livewire;

use App\Models\Consumo;
use App\Models\DetalleConsumo as ModelsDetalleConsumo;
use App\Models\Insumo;
use Livewire\Component;

class DetalleConsumo extends Component
{
    public $consumo_id, $insumo_id, $cantidad;
    protected $rules = [
        'insumo_id' => 'required',
        'cantidad' => 'required',
    ];
    public function index($id){
        return view('consumos.ver-detalle', compact('id'));
    }
    public function render()
    {
        $miConsumo = Consumo::findOrFail($this->consumo_id);
        $detalles = ModelsDetalleConsumo::where('consumos_id', $this->consumo_id)->get();
        $insumos = Insumo::orderBy('detalle')->get();

        return view('livewire.detalle-consumo', compact('detalles', 'miConsumo','insumos'));
    }
    public function storeDetalleConsumo($id)
    {
        $this->validate();
        ModelsDetalleConsumo::create([
            'consumos_id' => $id,
            'insumo_id' => $this->insumo_id,
            'cantidad' => $this->cantidad,
        ]);
        session()->flash('success', 'Detalle consumo registrada correctamente.');

    }
    public function deleteDetalleConsumo($id)
    {
        ModelsDetalleConsumo::find($id)->delete();
        //session()->flash('message', 'Post Deleted Successfully.');
    }
}
