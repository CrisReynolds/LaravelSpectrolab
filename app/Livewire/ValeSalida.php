<?php

namespace App\Livewire;

use App\Models\Consumo;
use App\Models\DetalleConsumo;
use Livewire\Component;

class ValeSalida extends Component
{
    public $consumo_id;
    public function index($id)
    {
        return view('consumos.detalle.vale', compact('id'));
    }
    public function render()
    {
        $consumo = Consumo::findOrFail($this->consumo_id);
        $detalle = DetalleConsumo::where('consumos_id', $this->consumo_id)->get();
        return view('livewire.vale-salida', compact('detalle', 'consumo'));
    }
}
