<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DetalleConsumo
 *
 * @property int $id
 * @property float $cantidad
 * @property float $precio_consumo
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
class DetalleConsumo extends Model
{
	protected $table = 'detalle_consumos';

	protected $casts = [
		'consumos_id' => 'int',
		'insumo_id' => 'int'
	];

	protected $fillable = [
		'consumos_id',
		'insumo_id',
        'cantidad',
        'importe',
        'punit',
        'detcompra_id'
	];

	public function consumo()
	{
		return $this->belongsTo(Consumo::class);
	}

	public function insumo()
	{
		return $this->belongsTo(Insumo::class);
	}
}
