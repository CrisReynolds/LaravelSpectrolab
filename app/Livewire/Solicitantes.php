<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Solicitante;
use Livewire\WithPagination;

class Solicitantes extends Component
{
    public $solicitante_ref,$solicitanteId;

    use WithPagination;

    public function render()
    {
        return view('livewire.solicitantes',[
            'solicitantes' => Solicitante::paginate(8),
        ]);
    }

    protected $rules = [
        'solicitante_ref' => 'required|string|min:3',
        // otras reglas de validación...
    ];

    public $isOpen = 0;

    public function create()
    {
        $this->reset('solicitante_ref','solicitanteId');
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
        Solicitante::create([
            'solicitante_ref' => $this->solicitante_ref,
        ]);
        session()->flash('success', 'Solicitante creado correctamente.');
        
        $this->reset('solicitante_ref','solicitanteId');
        $this->closeModal();
    }

    public function deleteUnidad($id)
    {
        try{
            Solicitante::find($id)->delete();
            session()->flash('success', 'Unidad eliminada correctamente');
        }catch(\Exception $e){
            session()->flash('error',"Algo salio mal");
        }
    }

    public function edit($id)
    {
        $solicitante = Solicitante::findOrFail($id);
        $this->solicitanteId = $id;
        $this->solicitante_ref = $solicitante->solicitante_ref;
        $this->openModal();
    }

    public function update()
    {
        $this->validate();
        if ($this->solicitanteId) {
            $solicitante = Solicitante::findOrFail($this->solicitanteId);
            $solicitante->update([
                'solicitante_ref' => $this->solicitante_ref,
            ]);
            session()->flash('success', 'Solicitante actualizado correctamente.');
            $this->closeModal();
            $this->reset('solicitante_ref', 'solicitanteId');
        }
    }

}
