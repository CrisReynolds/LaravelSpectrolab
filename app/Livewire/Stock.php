<?php

namespace App\Livewire;

use App\Exports\ExportInventario;
use App\Models\DetalleCompra;
use App\Models\DetalleConsumo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Stock extends Component
{
    /* Filtro */
    public $start_date, $end_date;
    public function allStock()
    {

        return DetalleCompra::join('insumos', 'insumos.id', 'detalle_compras.insumo_id')
        ->join('unidades', 'unidades.id', 'insumos.unidad_id')
        //->whereDate('fecha_compra', '>=', $then)
        //->whereDate('fecha_compra', '<=', $now)
        ->get([
            'detalle_compras.created_at',
            'detalle_compras.cantidad',
            'unidades.unidad_ref',
            'insumos.detalle',
            'insumos.marca',
            'insumos.codigo',
            DB::raw('ROUND(punitstock, 4) as precio')
        ]);

        $consumos = DetalleConsumo::orderBy('id','desc')->get();
        //sacar solo la cantidad
        $idInsumo = array();
        $arrCant = array();
        foreach($consumos as $consumo){
            array_push($idInsumo, $consumo->insumo_id);
            array_push($arrCant, $consumo->cantidad);
        }



        dd($idInsumo);

        //return $stock;

        $detallesConsumo = DetalleConsumo::selectRaw('insumo_id, sum(cantidad) as cant')
        ->groupBy('insumo_id')
        ->get();
        //dd($detallesConsumo);
        /* if(count($detallesConsumo) >= 0){
            return $detallesConsumo;
        } */
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
    public function render()
    {
        if ($this->start_date != "" && $this->end_date != "") {
            $inventario = $this->allStock();
            return view('livewire.stock', compact('inventario'));
        }
        $now = now()->format('Y-m-d');
        $startDate = Carbon::now();
        $then = $startDate->firstOfMonth()->format('Y-m-d');
        //dd($then);
        //$reporteCompras = DetalleCompra::reporte()->get();
        $inventario = DetalleCompra::join('insumos', 'insumos.id', 'detalle_compras.insumo_id')
            ->join('unidades', 'unidades.id', 'insumos.unidad_id')
            ->whereDate('detalle_compras.created_at', '>=', $then)
            ->whereDate('detalle_compras.created_at', '<=', $now)
            ->get([
                'detalle_compras.created_at',
                'detalle_compras.cantidad',
                'unidades.unidad_ref',
                'insumos.detalle',
                'insumos.marca',
                'insumos.codigo',
                DB::raw('ROUND(punitstock, 4) as precio')
            ]);
        return view('livewire.stock', compact('inventario'));
    }
    /* Export  */
    public function export()
    {
        $now = now()->format('Y-m-d');
        if ($this->start_date != "" && $this->end_date != "") {
            return Excel::download(new ExportInventario($this->start_date, $this->end_date),  'inventario_' . $now . '.xlsx');
        } else {

            $startDate = Carbon::now();
            $then = $startDate->firstOfMonth()->format('Y-m-d');
            return Excel::download(new ExportInventario($then, $now),  'inventario_' . $now . '.xlsx');
        }
    }
    public function consultar()
    {
        $this->start_date;
        $this->end_date;
        //dd(34);
        //$this->resetPage();
    }
}
