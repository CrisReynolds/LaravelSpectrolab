<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Compra
 * 
 * @property int $id
 * @property Carbon $fecha_compra
 * @property Carbon|null $fecha_entrega
 * @property float $importe
 * @property int|null $num_factura
 * @property int $num_vale_ingreso
 * @property int $proveedor_id
 * @property int $usuario_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Proveedor $proveedor
 * @property User $user
 * @property Collection|DetalleCompra[] $detalle_compras
 * @property Collection|DetalleConsumo[] $detalle_consumos
 *
 * @package App\Models
 */
class Compra extends Model
{
	protected $table = 'compras';

	protected $casts = [
		'fecha_compra' => 'date',
		'fecha_entrega' => 'date',
		'importe' => 'float',
		'num_factura' => 'int',
		'num_vale_ingreso' => 'string',
		'proveedor_id' => 'int',
		'usuario_id' => 'int'
	];

	protected $fillable = [
		'fecha_compra',
		'fecha_entrega',
		'importe',
		'num_factura',
		'num_vale_ingreso',
		'proveedor_id',
		'usuario_id'
	];

	public function proveedor()
	{
		return $this->belongsTo(Proveedor::class, 'proveedor_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'usuario_id');
	}

	public function detalle_compra()
	{
		return $this->hasMany(DetalleCompra::class);
	}
}
