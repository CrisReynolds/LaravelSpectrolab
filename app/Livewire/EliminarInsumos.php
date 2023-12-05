<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Insumo;

class EliminarInsumos extends Component
{
    public $insumo;

    public function render()
    {
        return view('livewire.eliminar-insumos');
    }

    public function deleteInsumo($id)
    {
        try{
            Insumo::find($id)->delete();
            session()->flash('exito',"Insumo eliminado correctamente");
        }catch(\Exception $e){
            session()->flash('error',"Algo salio mal");
        }
    }
}
