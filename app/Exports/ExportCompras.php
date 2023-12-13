<?php

namespace App\Exports;

use App\Models\Compra;
use App\Models\DetalleCompra;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;

class ExportCompras implements FromCollection, ShouldAutoSize, WithHeadings//, WithStyles
{
    protected $start_date, $end_date;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }
    private $headings = [
        'No',
        'Fecha',
        'Cant.',
        'Unidad',
        'Detalle',
        'Marca',
        'Codigo',
        'Importe.',
        'P.Unit',
        'Proveedor',
        'Doc.',
        'No.Vale'
    ];
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $start_date = $this->start_date;
        $end_date = $this->end_date;
        return DetalleCompra::join('compras', 'compras.id', 'detalle_compras.compras_id')
        ->join('insumos', 'insumos.id', 'detalle_compras.insumo_id')
        ->join('unidades', 'unidades.id', 'insumos.unidad_id')
        ->join('proveedores', 'proveedores.id', 'compras.proveedor_id')
        ->whereDate('fecha_compra', '>=', $start_date)
        ->whereDate('fecha_compra', '<=', $end_date)
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
    }
    /* public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            'C'  => ['font' => ['size' => 16]],
        ];
    } */
    public function headings(): array
    {

        return $this->headings;
    }
}
