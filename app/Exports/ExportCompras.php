<?php

namespace App\Exports;

use App\Models\Compra;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;

class ExportCompras implements FromCollection, ShouldAutoSize, WithHeadings//, WithStyles
{
    private $headings = [
        'ID',
        'Name',
        'Class',
        'Status',
        'Teacher',
        'Class',
        'Status',
        'Teacher'
    ];
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Compra::all();
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
