<?php

namespace App\Livewire;

use App\Models\Proveedor;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Proveedores extends Component
{
    use WithPagination;
    public $nombre,$ciudad,$correo,$direccion,$telefono,$fax,$nit,$persona_contacto,$productos,$representante,$ProveedorId;

    protected $rules = [
        'nombre' => 'required|string|min:3',
        'nit' => 'required|integer|regex:/^\d{10}$/',
        'productos' => 'required|string',
        'ciudad' => 'nullable|string',
        'correo' => 'nullable|email',
        'direccion' => 'nullable|string',
        'telefono' => 'nullable|string',
        'fax' => 'nullable|string',
        'persona_contacto' => 'nullable|string',
        'representante' => 'nullable|string',
        
        // otras reglas de validación...
    ];
    
    public function render()
    {
        return view('livewire.proveedores',[
            'proveedores' => Proveedor::paginate(5),
        ]);
    }

    public $isOpen = 0;

    public function create()
    {
        $this->reset('nombre','ProveedorId','ciudad','correo','direccion','telefono','fax','nit','productos','persona_contacto','representante');
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
        Proveedor::create([
            'nombre' => $this->nombre,
            'nit' => $this->nit,
            'productos' => $this->productos,
            'ciudad' => $this->ciudad,
            'correo' => $this->correo,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'fax' => $this->fax,
            'persona_contacto' => $this->persona_contacto,
            'representante' => $this->representante,
        ]);
        session()->flash('success', 'Proveedor creado correctamente.');
        
        $this->reset('nombre','ProveedorId','ciudad','correo','direccion','telefono','fax','nit','productos','persona_contacto','representante');
        $this->closeModal();
    }

    public function deleteUnidad($id)
    {
        try{
            Proveedor::find($id)->delete();
            session()->flash('success', 'Proveedor eliminado correctamente');
        }catch(\Exception $e){
            session()->flash('error',"Algo salio mal");
        }
    }

    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $this->ProveedorId = $id;
        $this->nombre = $proveedor->nombre;
        $this->nit = $proveedor->nit;
        $this->productos = $proveedor->productos;
        $this->ciudad = $proveedor->ciudad;
        $this->correo = $proveedor->correo;
        $this->direccion = $proveedor->direccion;
        $this->telefono = $proveedor->telefono;
        $this->fax = $proveedor->fax;
        $this->persona_contacto = $proveedor->persona_contacto;
        $this->representante = $proveedor->representante;
        $this->openModal();
    }

    public function update()
    {
        $this->validate();
        if ($this->ProveedorId) {
            $proveedor = Proveedor::findOrFail($this->ProveedorId);
            $proveedor->update([
                'nombre' => $this->nombre,
                'nit' => $this->nit,
                'productos' => $this->productos,
                'ciudad' => $this->ciudad,
                'correo' => $this->correo,
                'direccion' => $this->direccion,
                'telefono' => $this->telefono,
                'fax' => $this->fax,
                'persona_contacto' => $this->persona_contacto,
                'representante' => $this->representante,
            ]);
            session()->flash('success', 'Proveedor actualizado correctamente.');
            $this->closeModal();
            $this->reset('nombre','ProveedorId','ciudad','correo','direccion','telefono','fax','nit','productos','persona_contacto','representante');
        }
    }

    
}
