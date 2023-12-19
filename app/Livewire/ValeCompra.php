<?php

namespace App\Livewire;

use App\Models\Compra;
use App\Models\DetalleCompra;
use Livewire\Component;

class ValeCompra extends Component
{
    public $compra_id;
    public function index($id)
    {
        return view('compras.detalle.vale', compact('id'));
    }
    public function render()
    {
        $compra = Compra::findOrFail($this->compra_id);
        $detalle = DetalleCompra::where('compras_id', $this->compra_id)->get();
        $total = DetalleCompra::where('compras_id', $this->compra_id)
            ->selectRaw('sum(punit) as total')
            ->first();
        return view('livewire.vale-compra', compact('compra', 'detalle', 'total'));
    }
}
