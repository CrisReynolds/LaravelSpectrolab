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
        $detComp = DetalleCompra::where('insumo_id', $this->insumo_id)->where('cantstock','>', 0)->first();
        if(!$detComp){
            return 0;
        }
        if($this->cantidad > $detComp->cantstock){
            $detComp->cantstock = 0;
            $detComp->punitstock = 0;
            $detComp->save();
            ModelsDetalleConsumo::create([
                'consumos_id' => $id,
                'insumo_id' => $this->insumo_id,
                'cantidad' => $detComp->cantidad,
                'importe' => $detComp->importe,
                'punit' => $detComp->importe/ $detComp->cantidad,
                'detcompra_id' => $detComp->id
            ]);

            /* Creando otra fila para el restante */
            $detComp2 = DetalleCompra::where('insumo_id', $this->insumo_id)->where('cantstock', '>', 0)->first();
            //dd($this->cantidad);
            $dif = $this->cantidad - $detComp->cantidad; //2
            $ctck = $detComp2->cantidad - $dif; // 5-2 = 3
            $detComp2->cantstock = $ctck ;
            if($ctck <= 0){
                $detComp2->punitstock = 0;
            }else{
                $detComp2->punitstock = $detComp2->importe/$ctck;
            }
            $detComp2->save();
            ModelsDetalleConsumo::create([
                'consumos_id' => $id,
                'insumo_id' => $this->insumo_id,
                'cantidad' => $dif,
                'importe' => $detComp2->importe,
                'punit' => $detComp2->importe / $dif,
                'detcompra_id' => $detComp2->id
            ]);

        }else if($this->cantidad == $detComp->cantstock){ //4 == 4
            $detComp3 = DetalleCompra::where('insumo_id', $this->insumo_id)->where('cantstock', '>', 0)->first();

            $detComp3->cantstock = 0; //0
            $detComp3->punitstock = 0;
            $detComp3->save();
            ModelsDetalleConsumo::create([
                'consumos_id' => $id,
                'insumo_id' => $this->insumo_id,
                'cantidad' => $this->cantidad,
                'importe' => $detComp3->importe,
                'punit' => $detComp3->importe / $this->cantidad,
                'detcompra_id' => $detComp3->id
            ]);
        } else if ($this->cantidad < $detComp->cantstock) { //2 < 3
            $detComp4 = DetalleCompra::where('insumo_id', $this->insumo_id)->where('cantstock', '>', 0)->first();
            //dd($this->cantidad);
            $ctck = $detComp4->cantstock - $this->cantidad; // 3
            $detComp4->cantstock = $ctck; //3
            $detComp4->punitstock = $detComp4->importe / $ctck;
            $detComp4->save();
            ModelsDetalleConsumo::create([
                'consumos_id' => $id,
                'insumo_id' => $this->insumo_id,
                'cantidad' => $this->cantidad,
                'importe' => $detComp4->importe,
                'punit' => $detComp4->importe / $this->cantidad,
                'detcompra_id' => $detComp4->id
            ]);
        }else{
            dd('No hay casos');
        }
        /* $detalleConsumo = ModelsDetalleConsumo::where('insumo_id', $this->insumo_id)->where('consumos_id', $id)->first();
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
        } */
        session()->flash('success', 'Detalle consumo registrada correctamente.');
    }
    public function deleteDetalleConsumo($id)
    {
        $detalleconsumo = ModelsDetalleConsumo::find($id);
        $detallecompra = DetalleCompra::find($detalleconsumo->detcompra_id);
        if($detallecompra){
            $add = $detallecompra->cantstock + $detalleconsumo->cantidad;
            $detallecompra->cantstock = $detallecompra->cantstock + $detalleconsumo->cantidad;
            $detallecompra->punitstock = $add;
            $detallecompra->save();
        }
        $detalleconsumo->delete();
        //session()->flash('message', 'Post Deleted Successfully.');
    }
}
