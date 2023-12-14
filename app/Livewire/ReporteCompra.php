<?php

namespace App\Livewire;

use App\Exports\ExportCompras;
use App\Models\DetalleCompra;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class ReporteCompra extends Component
{
    /* Filtro */
    public $start_date, $end_date;

    public function index()
    {
        return view('compras.reporte');
    }
    public function render()
    {
        if ($this->start_date != "" && $this->end_date != "") {
            $reporteCompras = DetalleCompra::join('compras', 'compras.id', 'detalle_compras.compras_id')
                ->join('insumos', 'insumos.id', 'detalle_compras.insumo_id')
                ->join('unidades', 'unidades.id', 'insumos.unidad_id')
                ->join('proveedores', 'proveedores.id', 'compras.proveedor_id')
                ->whereDate('fecha_compra', '>=', $this->start_date)
                ->whereDate('fecha_compra', '<=', $this->end_date)
                ->get([
                    'compras.id',
                    'fecha_compra',
                    'detalle_compras.cantidad',
                    'unidades.unidad_ref',
                    'insumos.detalle',
                    'insumos.marca',
                    'insumos.codigo',
                    'detalle_compras.importe',
                    //'detalle_compras.importe as unit',
                    DB::raw(' ROUND(detalle_compras.importe/detalle_compras.cantidad, 4) as unit'),
                    'proveedores.nombre',
                    'compras.num_factura',
                    'compras.num_vale_ingreso'

                ]);
            return view('livewire.reporte-compra', compact('reporteCompras'));
        }
        $now = now()->format('Y-m-d');
        $startDate = Carbon::now();
        $then = $startDate->firstOfMonth()->format('Y-m-d');
        //dd($then);
        //$reporteCompras = DetalleCompra::reporte()->get();
        $reporteCompras = DetalleCompra::join('compras', 'compras.id', 'detalle_compras.compras_id')
            ->join('insumos', 'insumos.id', 'detalle_compras.insumo_id')
            ->join('unidades', 'unidades.id', 'insumos.unidad_id')
            ->join('proveedores', 'proveedores.id', 'compras.proveedor_id')
            ->whereDate('fecha_compra', '>=', $then)
            ->whereDate('fecha_compra', '<=', $now)
            ->get([
                'compras.id',
                'fecha_compra',
                'detalle_compras.cantidad',
                'unidades.unidad_ref',
                'insumos.detalle',
                'insumos.marca',
                'insumos.codigo',
                'detalle_compras.importe',
                //'detalle_compras.importe as unit',
                DB::raw(' ROUND(detalle_compras.importe/detalle_compras.cantidad, 4) as unit'),
                'proveedores.nombre',
                'compras.num_factura',
                'compras.num_vale_ingreso'

            ]);
        return view('livewire.reporte-compra', compact('reporteCompras'));
    }
    /* Export  */
    public function export()
    {
        $now = now()->format('Y-m-d');
        if ($this->start_date != "" && $this->end_date != ""){
            return Excel::download(new ExportCompras($this->start_date, $this->end_date),  'compras_' . $now . '.xlsx');
        }
        else{

            $startDate = Carbon::now();
            $then = $startDate->firstOfMonth()->format('Y-m-d');
            return Excel::download(new ExportCompras($then, $now),  'compras_' . $now . '.xlsx');
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
