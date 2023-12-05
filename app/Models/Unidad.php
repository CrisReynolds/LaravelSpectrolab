<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Unidad
 * 
 * @property int $id
 * @property string $unidad_ref
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Insumo[] $insumos
 *
 * @package App\Models
 */
class Unidad extends Model
{
	use HasFactory;
	protected $table = 'unidades';

	protected $fillable = [
		'unidad_ref'
	];

	protected $rules = [
        'unidad_ref' => 'required|min:3',
        // otras reglas de validación...
    ];


	public function insumo()
	{
		return $this->hasMany(Insumo::class, 'unidad_id');
	}
}
