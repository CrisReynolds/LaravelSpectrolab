<?php

namespace App\Livewire;

use App\Exports\ExportConsumo;
use App\Models\DetalleConsumo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class ReporteConsumo extends Component
{
    /* Filtro */
    public $start_date, $end_date;
    public function index()
    {
        return view('consumos.reporte');
    }
    public function render()
    {
        if ($this->start_date != "" && $this->end_date != "") {
            $reporteConsumos = DetalleConsumo::join('consumos', 'consumos.id', 'detalle_consumos.consumos_id')
            ->join('solicitantes', 'solicitantes.id', 'consumos.solicitante_id')
            ->join('insumos', 'insumos.id', 'detalle_consumos.insumo_id')
            ->join('unidades', 'unidades.id', 'insumos.unidad_id')
            ->join('proveedores', 'proveedores.id', 'insumos.proveedor_id')
            ->whereDate('fecha_consumo', '>=', $this->start_date)
            ->whereDate('fecha_consumo', '<=', $this->end_date)
            ->get([
                'fecha_consumo',
                'detalle_consumos.cantidad',
                'unidades.unidad_ref',
                'insumos.detalle',
                'insumos.marca',
                'insumos.codigo',
                'solicitantes.solicitante_ref',
                'consumos.num_vale_salida'
            ]);
            return view('livewire.reporte-compra', compact('reporteConsumos'));
        }
        $now = now()->format('Y-m-d');
        $startDate = Carbon::now();
        $then = $startDate->firstOfMonth()->format('Y-m-d');
        //dd($then);
        //$reporteCompras = DetalleCompra::reporte()->get();
        $reporteConsumos = DetalleConsumo::join('consumos', 'consumos.id', 'detalle_consumos.consumos_id')
        ->join('solicitantes', 'solicitantes.id', 'consumos.solicitante_id')
        ->join('insumos', 'insumos.id', 'detalle_consumos.insumo_id')
        ->join('unidades', 'unidades.id', 'insumos.unidad_id')
        ->join('proveedores', 'proveedores.id', 'insumos.proveedor_id')
        ->whereDate('fecha_consumo', '>=', $then)
        ->whereDate('fecha_consumo', '<=', $now)
        ->get([
            'fecha_consumo',
            'detalle_consumos.cantidad',
            'unidades.unidad_ref',
            'insumos.detalle',
            'insumos.marca',
            'insumos.codigo',
            'solicitantes.solicitante_ref',
            'consumos.num_vale_salida'
        ]);
        return view('livewire.reporte-consumo', compact('reporteConsumos'));
    }
    /* Export  */
    public function export()
    {
        $now = now()->format('Y-m-d');
        if ($this->start_date != "" && $this->end_date != "") {
            return Excel::download(new ExportConsumo($this->start_date, $this->end_date),  'consumo_'. $now.'.xlsx');
        } else {

            $startDate = Carbon::now();
            $then = $startDate->firstOfMonth()->format('Y-m-d');
            return Excel::download(new ExportConsumo($then, $now),  'consumo_' . $now . '.xlsx');
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
