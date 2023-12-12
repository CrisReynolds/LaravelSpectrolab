<?php

namespace App\Exports;

use App\Models\Consumo;
use App\Models\DetalleConsumo;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportConsumo implements FromCollection, ShouldAutoSize, WithHeadings
{
    protected $start_date, $end_date;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }
    private $headings = [
        'Fecha',
        'Cant.',
        'Unidad',
        'Detalle',
        'Marca/Proveedor',
        'Codigo',
        'Nombre.',
        'No.Boleta'
    ];
    public function headings(): array
    {
        return $this->headings;
    }
    public function collection()
    {
        $start_date = $this->start_date;
        $end_date = $this->end_date;

        return DetalleConsumo::join('consumos', 'consumos.id', 'detalle_consumos.consumos_id')
            ->join('solicitantes', 'solicitantes.id', 'consumos.solicitante_id')
            ->join('insumos', 'insumos.id', 'detalle_consumos.insumo_id')
            ->join('unidades', 'unidades.id', 'insumos.unidad_id')
            ->join('proveedores', 'proveedores.id', 'insumos.proveedor_id')
            ->whereDate('fecha_consumo', '>=', $start_date)
            ->whereDate('fecha_consumo', '<=', $end_date)
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
    }
}
