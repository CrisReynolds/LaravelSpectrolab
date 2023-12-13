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
        return DetalleCompra::reporte($this->start_date, $this->end_date)->get();
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
