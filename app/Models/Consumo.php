<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Consumo
 * 
 * @property int $id
 * @property Carbon $fecha_consumo
 * @property int $num_vale_salida
 * @property string|null $observaciones
 * @property string|null $parametro
 * @property string|null $descripcion
 * @property int $usuario_id
 * @property int $destino_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Destino $destino
 * @property User $user
 *
 * @package App\Models
 */
class Consumo extends Model
{
	protected $table = 'consumos';

	protected $casts = [
		'fecha_consumo' => 'datetime',
		'num_vale_salida' => 'int',
		'usuario_id' => 'int',
		'solicitante_id' => 'int'
	];

	protected $fillable = [
		'fecha_consumo',
		'num_vale_salida',
		'observaciones',
		'parametro',
		'descripcion',
		'usuario_id',
		'solicitante_id'
	];

	public function solicitante()
	{
		return $this->belongsTo(Solicitante::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'usuario_id');
	}

	public function detalle_consumo()
	{
		return $this->hasMany(DetalleConsumo::class);
	}

}
