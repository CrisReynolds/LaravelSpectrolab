<?php

namespace App\Livewire;

use App\Exports\ExportConsumo;
use App\Models\Consumo;
use App\Models\User;
use App\Models\Solicitante;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Consumos extends Component
{
    use WithPagination;
    public $fecha_consumo,$consumoId,$usuario_id,$solicitante_id,$num_vale_salida,$observaciones,$parametro,$descripcion;
    /* Filtro */
    public $start_date, $end_date;

    protected $rules = [
        'fecha_consumo' => 'required|date',
        'num_vale_salida' => 'required|string',
        'solicitante_id' => 'required',
        // 'usuario_id' => 'required',

        // otras reglas de validación...
    ];

    public function render()
    {
        return view('livewire.consumos',[
            'consumos' => Consumo::paginate(10),
            'usuarios' => User::all(),
            'solicitantes' => Solicitante::all(),
        ]);
    }

    public $isOpen = 0;

    public function create()
    {
        $this->reset('consumoId','fecha_consumo','solicitante_id','num_vale_salida','observaciones','parametro','descripcion');
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
            'consumoId' => $this->consumoId,
            'fecha_consumo' => $this->fecha_consumo,
            'usuario_id' => auth()->user()->id,
            'solicitante_id' => $this->solicitante_id,
            'num_vale_salida' => $this->num_vale_salida,
            'observaciones' => $this->observaciones,
            'parametro' => $this->parametro,
            'descripcion' => $this->descripcion,
        ]);
        session()->flash('success', 'Consumo registrado correctamente.');

        $this->reset('fecha_consumo','usuario_id','solicitante_id','num_vale_salida','observaciones','parametro','descripcion','consumoId');
        $this->closeModal();
    }

    public function deleteConsumo($id)
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
        $this->usuario_id = $consumo->usuario_id;
        $this->solicitante_id = $consumo->solicitante_id;
        $this->num_vale_salida = $consumo->num_vale_salida;
        $this->observaciones = $consumo->observaciones;
        $this->parametro = $consumo->parametro;
        $this->descripcion = $consumo->descripcion;
        $this->openModal();
    }

    public function update()
    {
        $this->validate();
        if ($this->consumoId) {
            $consumo = Consumo::findOrFail($this->consumoId);
            $consumo->update([
                'fecha_consumo' => $this->fecha_consumo,
                'usuario_id' => $this->usuario_id,
                'solicitante_id' => $this->solicitante_id,
                'num_vale_salida' => $this->num_vale_salida,
                'observaciones' => $this->observaciones,
                'parametro' => $this->parametro,
                'descripcion' => $this->descripcion,
            ]);
            session()->flash('success', 'Consumo actualizado correctamente.');
            $this->closeModal();
            $this->reset('fecha_consumo','usuario_id','solicitante_id','num_vale_salida','observaciones','parametro','descripcion');
        }
    }

    /* Export  */
    public function export()
    {
        return Excel::download(new ExportConsumo($this->start_date, $this->end_date),  'consumos.xlsx');
    }
}

