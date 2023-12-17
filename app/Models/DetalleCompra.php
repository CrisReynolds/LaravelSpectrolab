<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class DetalleCompra
 *
 * @property int $id
 * @property float $cantidad
 * @property float $precio_compra
 * @property int $compra_id
 * @property int $insumo_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Compra $compra
 * @property Insumo $insumo
 *
 * @package App\Models
 */
class DetalleCompra extends Model
{
    protected $table = 'detalle_compras';

    protected $casts = [
        'compras_id' => 'int',
        'insumo_id' => 'int',
        'observacion_insumo',
        'importe',
        'cantidad'
    ];

    protected $fillable = [
        'compras_id',
        'insumo_id',
        'observacion_insumo',
        'importe',
        'cantidad',
        'punit',
        'cantstock',
        'punitstock'
    ];

    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }

    public function insumo()
    {
        return $this->belongsTo(Insumo::class);
    }
    /* Reporte */
    public function scopeReporte($query, $start_date, $end_date)
    {
        return $query->join('compras', 'compras.id', 'detalle_compras.compras_id')
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
}
