<?php

namespace App\Livewire;

use App\Models\Compra;
use App\Models\Proveedor;
use App\Models\User;
use App\Models\DetalleCompra;
use App\Models\Insumo;
use Livewire\Component;
use Livewire\WithPagination;
use Psy\Readline\Hoa\Console;

class Compras extends Component
{
    use WithPagination;
    public $fecha_compra, $fecha_entrega, $num_factura, $num_vale_ingreso, $compraId, $proveedor_id, $usuario_id;

    protected $rules = [
        'fecha_compra' => 'required|date',
        'fecha_entrega' => 'required|date',
        //'importe' => 'required|numeric',
        'num_factura' => 'required|integer',
        'num_vale_ingreso' => 'required|string',
        'proveedor_id' => 'required|integer',
        //'usuario_id' => 'required',

        // otras reglas de validación...
    ];

    public function render()
    {
        return view('livewire.compras', [
            'compras' => Compra::paginate(10),
            'proveedores' => Proveedor::all(),
            'usuarios' => User::all(),
        ]);
    }

    public $isOpen = 0;

    public function create()
    {
        $this->reset('fecha_compra', 'fecha_entrega'/* , 'importe' */, 'num_factura', 'num_vale_ingreso', 'proveedor_id'/* , 'usuario_id' */);
        $this->openModal();
    }
    public function openModal()
    {
        $this->isOpen = true;
    }
    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function store()
    {
        $this->validate();
        Compra::create([
            'fecha_compra' => $this->fecha_compra,
            'fecha_entrega' => $this->fecha_entrega,
            //'importe' => $this->importe,
            'num_factura' => $this->num_factura,
            'num_vale_ingreso' => $this->num_vale_ingreso,
            'proveedor_id' => $this->proveedor_id,
            'usuario_id' => auth()->user()->id,
        ]);
        session()->flash('success', 'Compra registrada correctamente.');

        $this->reset('fecha_compra', 'fecha_entrega', 'importe', 'num_factura', 'num_vale_ingreso', 'proveedor_id', 'usuario_id');
        $this->closeModal();
    }

    public function deleteCompra($id)
    {
        try {
            Compra::find($id)->delete();
            session()->flash('success', 'Compra eliminada correctamente');
        } catch (\Exception $e) {
            session()->flash('error', "Algo salio mal");
        }
    }

    public function edit($id)
    {
        $compra = Compra::findOrFail($id);
        $this->compraId = $id;
        $this->fecha_compra = $compra->fecha_compra;
        $this->fecha_entrega = $compra->fecha_entrega;
        //$this->importe = $compra->importe;
        $this->num_factura = $compra->num_factura;
        $this->num_vale_ingreso = $compra->num_vale_ingreso;
        $this->proveedor_id = $compra->proveedor_id;
        $this->usuario_id = $compra->usuario_id;
        $this->openModal();
    }

    public function update()
    {
        $this->validate();
        if ($this->compraId) {
            $compra = Compra::findOrFail($this->compraId);
            $compra->update([
                'fecha_compra' => $this->fecha_compra,
                'fecha_entrega' => $this->fecha_entrega,
                //'importe' => $this->importe,
                'num_factura' => $this->num_factura,
                'num_vale_ingreso' => $this->num_vale_ingreso,
                'proveedor_id' => $this->proveedor_id,
                'usuario_id' => $this->usuario_id,
            ]);
            session()->flash('success', 'Compra actualizada correctamente.');
            $this->closeModal();
            $this->reset('fecha_compra', 'fecha_entrega', 'importe', 'num_factura', 'num_vale_ingreso', 'proveedor_id', 'usuario_id');
        }
    }


}
