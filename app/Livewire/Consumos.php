<?php

namespace App\Livewire;

use App\Models\Consumo;
use Livewire\Component;
use Livewire\WithPagination;

class Consumos extends Component
{
    use WithPagination;
    public $fecha_consumo,$consumoId;

    protected $rules = [
        //'unidad_ref' => 'required|string|min:3',
        // otras reglas de validación...
    ];
    
    public function render()
    {
        return view('livewire.consumos',[
            'consumos' => Consumo::paginate(10),
        ]);
    }

    public $isOpen = 0;

    public function create()
    {
        $this->reset('consumoId');
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
        Consumo::create([
            'fecha_consumo' => $this->fecha_consumo,
        ]);
        session()->flash('success', 'Consumo registrado correctamente.');
        
        $this->reset('fecha_consumo');
        $this->closeModal();
    }

    public function deleteUnidad($id)
    {
        try{
            Consumo::find($id)->delete();
            session()->flash('success', 'Consumo eliminado correctamente');
        }catch(\Exception $e){
            session()->flash('error',"Algo salio mal");
        }
    }

    public function edit($id)
    {
        $consumo = Consumo::findOrFail($id);
        $this->consumoId = $id;
        $this->fecha_consumo = $consumo->fecha_consumo;
        $this->openModal();
    }

    public function update()
    {
        $this->validate();
        if ($this->consumoId) {
            $consumo = Consumo::findOrFail($this->consumoId);
            $consumo->update([
                'fecha_consumo' => $this->fecha_consumo,
            ]);
            session()->flash('success', 'Consumo actualizado correctamente.');
            $this->closeModal();
            $this->reset('fecha_consumo', 'unidadId');
        }
    }

    
}

