<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Insumo;
use App\Models\Unidad;
use App\Models\Proveedor;
use App\Models\Categoria;
use Livewire\WithPagination;

class RegistrarInsumos extends Component
{
    use WithPagination;

    public string $search = '';
    public $detalle,$insumoId,$unidad_id,$proveedor_id,$categoria_id,$precio,$marca,$stock_minimo,$es_narcotico=0,$codigo;

    public function render()
    {
        return view('livewire.registrar-insumos',[
            'insumos' => Insumo::where('detalle', 'like', "%$this->search%")->paginate(10),
            'unidades' => Unidad::all(),
            'proveedores' => Proveedor::all(),
            'categorias' => Categoria::all(),
        ]);
    }

    protected $rules = [
        'detalle' => 'required|string',
        'unidad_id' => 'required|integer',
        'proveedor_id' => 'required',
        'categoria_id' => 'required|integer',
        //'precio' => 'required|numeric',
        // otras reglas de validación...
    ];

    public $isOpen = 0;

    public function create()
    {
        $this->reset('detalle','insumoId','unidad_id','proveedor_id','categoria_id',/* 'precio', */'es_narcotico','marca','stock_minimo','codigo');
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

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function busqueda(){
        $this->resetPage();
    }

    public function store()
    {
        $this->validate();
        Insumo::create([
            'detalle' => $this->detalle,
            'unidad_id' => $this->unidad_id,
            'proveedor_id' => $this->proveedor_id,
            'categoria_id' => $this->categoria_id,
            'codigo' => $this->codigo,
            //'precio' => $this->precio,
            'marca' => $this->marca,
            'es_narcotico' => $this->es_narcotico,
            'stock_minimo' => $this->stock_minimo,
        ]);
        session()->flash('success', 'Artículo creado correctamente.');

        $this->reset('detalle','insumoId','unidad_id','proveedor_id','categoria_id',/* 'precio', */
                    'es_narcotico','marca','stock_minimo','codigo');
        $this->closeModal();
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

    public function edit($id)
    {
        $insumo = Insumo::findOrFail($id);
        $this->insumoId = $id;
        $this->detalle = $insumo->detalle;
        $this->unidad_id = $insumo->unidad_id;
        $this->proveedor_id = $insumo->proveedor_id;
        $this->categoria_id = $insumo->categoria_id;
        //$this->precio = $insumo->precio;
        $this->marca = $insumo->marca;
        $this->es_narcotico = $insumo->es_narcotico;
        $this->stock_minimo = $insumo->stock_minimo;
        $this->codigo = $insumo->codigo;
        $this->openModal();
    }

    public function update()
    {
        $this->validate();
        if ($this->insumoId) {
            $insumo = insumo::findOrFail($this->insumoId);
            $insumo->update([
                'detalle' => $this->detalle,
                'unidad_id' => $this->unidad_id,
                'proveedor_id' => $this->proveedor_id,
                'categoria_id' => $this->categoria_id,
                //'precio' => $this->precio,
                'marca' => $this->marca,
                'es_narcotico' => $this->es_narcotico,
                'stock_minimo' => $this->stock_minimo,
                'codigo' => $this->codigo,
            ]);
            session()->flash('success', 'Artículo actualizado correctamente.');
            $this->closeModal();
            $this->reset('detalle','insumoId','unidad_id','proveedor_id','categoria_id',/* 'precio', */
                        'es_narcotico','marca','stock_minimo','codigo');
        }
    }


}
