<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Categoria;

class Categorias extends Component
{
    use WithPagination;

    public string $search = '';
    public $cod_ref,$cat_ref,$categoriaId;

    protected $rules = [
        'cod_ref' => 'required|unique:categorias|int',
        'cat_ref' => 'required|string',
        // otras reglas de validación...
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $categorias = Categoria::where('cat_ref', 'like', "%$this->search%")->paginate(5);
        return view('livewire.categorias',[
            'categorias' => $categorias,
        ]);
    }

    public function busqueda(){
        $this->resetPage();
    }

    public $isOpen = 0;

    public function create()
    {
        $this->reset('cat_ref','cod_ref','categoriaId');
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
        Categoria::create([
            'cat_ref' => $this->cat_ref,
            'cod_ref' => $this->cod_ref,
        ]);
        session()->flash('success', 'Categoria creada correctamente.');
        
        $this->reset('cat_ref','cod_ref');
        $this->closeModal();
    }

    public function deleteCategoria($id)
    {
        try{
            Categoria::find($id)->delete();
            session()->flash('success', 'Categoria eliminada correctamente');
        }catch(\Exception $e){
            session()->flash('error',"Algo salio mal");
        }
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        $this->categoriaId = $id;
        $this->cat_ref = $categoria->cat_ref;
        $this->cod_ref = $categoria->cod_ref;
        $this->openModal();
    }

    public function update()
    {
        $this->validate();
        if ($this->categoriaId) {
            $categoria = Categoria::findOrFail($this->categoriaId);
            $categoria->update([
                'cat_ref' => $this->cat_ref,
                'cod_ref' => $this->cod_ref,
            ]);
            session()->flash('success', 'Categoria actualizada correctamente.');
            $this->closeModal();
            $this->reset('cat_ref','cod_ref', 'categoriaId');
        }
    }

}
