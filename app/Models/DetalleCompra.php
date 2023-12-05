<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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
		'compra_id' => 'int',
		'insumo_id' => 'int'
	];

	protected $fillable = [
		'compra_id',
		'insumo_id'
	];

	public function compra()
	{
		return $this->belongsTo(Compra::class);
	}

	public function insumo()
	{
		return $this->belongsTo(Insumo::class);
	}
}
