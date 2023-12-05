<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Destino
 * 
 * @property int $id
 * @property string $destino_ref
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Consumo[] $consumos
 *
 * @package App\Models
 */
class Solicitante extends Model
{
	protected $table = 'solicitantes';

	protected $fillable = [
		'solicitante_ref'
	];

	public function consumo()
	{
		return $this->hasMany(Consumo::class);
	}

}
