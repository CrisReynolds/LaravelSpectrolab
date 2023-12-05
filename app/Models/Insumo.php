<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Insumo
 * 
 * @property int $id
 * @property string|null $codigo
 * @property string $detalle
 * @property string|null $marca
 * @property float $precio
 * @property float|null $stock
 * @property int|null $stock_minimo
 * @property bool $es_narcotico
 * @property int $unidad_id
 * @property int $categoria_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Categoria $categoria
 * @property Unidad $unidad
 * @property Collection|DetalleCompra[] $detalle_compras
 * @property Collection|DetalleConsumo[] $detalle_consumos
 *
 * @package App\Models
 */
class Insumo extends Model
{
	protected $table = 'insumos';

	protected $casts = [
		'precio' => 'float',
		'stock' => 'float',
		'stock_minimo' => 'int',
		'es_narcotico' => 'bool',
		'unidad_id' => 'int',
		'categoria_id' => 'int'
	];

	protected $fillable = [
		'codigo',
		'detalle',
		'precio',
		'stock',
		'stock_minimo',
		'es_narcotico',
		'unidad_id',
		'categoria_id'
	];

	protected $listeners = [
        'deleteInsumoListner'=>'deleteInsumo'
    ];

	public function categoria()
	{
		return $this->belongsTo(Categoria::class);
	}

	public function unidad()
	{
		return $this->belongsTo(Unidad::class, 'unidad_id');
	}

	public function proveedor()
	{
		return $this->belongsTo(Proveedor::class, 'proveedor_id');
	}

	public function detalle_compra()
	{
		return $this->hasMany(DetalleCompra::class);
	}

	public function detalle_consumo()
	{
		return $this->hasMany(DetalleConsumo::class);
	}
}
