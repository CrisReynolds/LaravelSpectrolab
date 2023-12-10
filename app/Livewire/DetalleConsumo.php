<?php

namespace App\Livewire;

use App\Models\Consumo;
use App\Models\DetalleCompra;
use App\Models\DetalleConsumo as ModelsDetalleConsumo;
use App\Models\Insumo;
use Livewire\Component;

class DetalleConsumo extends Component
{
    public $consumo_id, $insumo_id, $cantidad;
    public $btnSubmit = 0/* , $btnVerify = 1 */;
    /* OBJ */
    //public ;
    public function searchPosts()
    {
        if ($this->insumo_id == "") {
            return 0;
        }
        $stock = $this->stockByInsumo($this->insumo_id);
        if ($this->cantidad == "" || $this->cantidad <= 0) {
            session()->flash('verify', 'Incorrecto');
            $this->btnSubmit = 0;
        } else {
            if ($this->cantidad <= $stock) {
                session()->flash('verifyOk', 'Correcto');
                $this->btnSubmit = 1;
                //$this->btnVerify = 0;
            } else {
                session()->flash('verify', 'Incorrecto');
                $this->btnSubmit = 0;
            }
        }
    }
    protected $rules = [
        'insumo_id' => 'required',
        'cantidad' => 'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
    ];
    public function index($id)
    {
        return view('consumos.ver-detalle', compact('id'));
    }
    public function allStock()
    {
        $detallesConsumo = ModelsDetalleConsumo::selectRaw('insumo_id, sum(cantidad) as cant')
            ->groupBy('insumo_id')
            ->get();
        //dd($detalles[1]->cant);
        $idInsumo = array();
        $arrInsumo = array();
        $arrCant = array();
        foreach ($detallesConsumo as $consumo) {
            array_push($idInsumo, $consumo->insumo_id);
            //array_push($arrInsumo, $consumo->insumo->detalle);
            $cantidades = DetalleCompra::where('insumo_id', $consumo->insumo_id)
                ->selectRaw('insumo_id, sum(cantidad) as cant')
                ->groupBy('insumo_id')
                ->get();
            //dd($cantidades[0]->cant);
            array_push($arrInsumo, $cantidades[0]->insumo->detalle);
            array_push($arrCant, $cantidades[0]->cant - $consumo->cant);
        }
        //dd($arrInsumo);
        //dd($arrInsumo);
        $detailNoComsumo = DetalleCompra::whereNotIn(
                'insumo_id',
                $idInsumo
            )
            ->selectRaw('insumo_id, sum(cantidad) as cant')
            ->groupBy('insumo_id')
            ->get();
        $insumos = array();
        for ($x = 0; $x < count($arrInsumo); $x++) {
            $insumos[$idInsumo[$x]] = '(' . $arrCant[$x] . ') ' . $arrInsumo[$x];
        }
        foreach ($detailNoComsumo as $x) {
            $insumos[$x->insumo_id] = '(' . $x->cant . ') ' . $x->insumo->detalle;
        }
        return $insumos;
    }
    public function stockByInsumo($id)
    {
        $detallesConsumo = ModelsDetalleConsumo::where('insumo_id', $id)
            ->selectRaw('insumo_id, sum(cantidad) as cant')
            ->groupBy('insumo_id')
            ->get();
        $detallesCompra = DetalleCompra::where('insumo_id', $id)
            ->selectRaw('insumo_id, sum(cantidad) as cant')
            ->groupBy('insumo_id')
            ->get();
        if(count($detallesConsumo)>0){
            $totalStock = $detallesCompra[0]->cant - $detallesConsumo[0]->cant;
            return $totalStock;
        }else{
            $totalStock = $detallesCompra[0]->cant;
            return $totalStock;
        }

    }
    public function render()
    {

        //dd($miConsumo);
        $insumos = $this->allStock();

        $miConsumo = Consumo::findOrFail($this->consumo_id);
        $detalles = ModelsDetalleConsumo::where('consumos_id', $this->consumo_id)->get();
        //$insumos = DetalleCompra::orderBy('created_at')->get();

        $idInsumo = array();

        return view('livewire.detalle-consumo', compact('detalles', 'miConsumo', 'insumos'));
    }
    public function storeDetalleConsumo($id)
    {
        $this->validate();
        $detalleConsumo = ModelsDetalleConsumo::where('insumo_id', $this->insumo_id)->first();
        if ($detalleConsumo) {
            $detalleConsumo->update([
                'cantidad' => $this->cantidad,
            ]);
        }else{
            ModelsDetalleConsumo::create([
                'consumos_id' => $id,
                'insumo_id' => $this->insumo_id,
                'cantidad' => $this->cantidad,
            ]);
        }
        session()->flash('success', 'Detalle consumo registrada correctamente.');
    }
    public function deleteDetalleConsumo($id)
    {
        ModelsDetalleConsumo::find($id)->delete();
        //session()->flash('message', 'Post Deleted Successfully.');
    }
}
