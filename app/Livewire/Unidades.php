<?php

namespace App\Livewire;

use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Models\Unidad;
use Livewire\WithPagination;

class Unidades extends Component
{
    use WithPagination;

    public $unidad_ref,$unidadId;

    protected $rules = [
        'unidad_ref' => 'required|string',
        // otras reglas de validación...
    ];

    protected $listeners = [
        'deleteUnidadListner'=>'deleteUnidad'
    ];
    
    public function render()
    {
        return view('livewire.unidades',[
            'unidades' => Unidad::paginate(10),
        ]);
    }

    public $isOpen = 0;

    public function create()
    {
        $this->reset('unidad_ref','unidadId');
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
        Unidad::create([
            'unidad_ref' => $this->unidad_ref,
        ]);
        session()->flash('success', 'Unidad creada correctamente.');
        
        $this->reset('unidad_ref',);
        $this->closeModal();
    }

    public function deleteUnidad($id)
    {
        try{
            Unidad::find($id)->delete();
            session()->flash('success', 'Unidad eliminada correctamente');
        }catch(\Exception $e){
            session()->flash('error',"Algo salio mal");
        }
    }

    public function edit($id)
    {
        $unidad = Unidad::findOrFail($id);
        $this->unidadId = $id;
        $this->unidad_ref = $unidad->unidad_ref;
        $this->openModal();
    }

    public function update()
    {
        $this->validate();
        if ($this->unidadId) {
            $unidad = Unidad::findOrFail($this->unidadId);
            $unidad->update([
                'unidad_ref' => $this->unidad_ref,
            ]);
            session()->flash('success', 'Unidad actualizada correctamente.');
            $this->closeModal();
            $this->reset('unidad_ref', 'unidadId');
        }
    }

    
}
