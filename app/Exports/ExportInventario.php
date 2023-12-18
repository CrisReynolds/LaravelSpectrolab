<?php

namespace App\Exports;

use App\Models\DetalleCompra;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportInventario implements FromCollection, ShouldAutoSize, WithHeadings
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
        'Marca',
        'Codigo',
        'Precio en Almacen'
    ];
    public function headings(): array
    {
        return $this->headings;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $start_date = $this->start_date;
        $end_date = $this->end_date;
        return DetalleCompra::join('insumos', 'insumos.id', 'detalle_compras.insumo_id')
        ->join('unidades', 'unidades.id', 'insumos.unidad_id')
        ->whereDate('detalle_compras.created_at', '>=', $start_date)
        ->whereDate('detalle_compras.created_at', '<=', $end_date)
        ->get([
            'detalle_compras.created_at',
            'detalle_compras.cantidad',
            'unidades.unidad_ref',
            'insumos.detalle',
            'insumos.marca',
            'insumos.codigo',
            DB::raw('ROUND(punitstock, 4) as precio')
        ]);
    }
}
