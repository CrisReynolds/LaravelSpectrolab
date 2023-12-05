<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Insumo;
use Livewire\WithPagination;

class RegistrarInsumos extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.registrar-insumos',[
            'insumos' => Insumo::paginate(5),
        ]);
    }

    public function deleteInsumo($id)
    {
        try{
            Insumo::find($id)->delete();
            session()->flash('success',"El registro se eliminó correctamente");
        }catch(\Exception $e){
            session()->flash('error',"Algo salio mal");
        }
    }

    
}
