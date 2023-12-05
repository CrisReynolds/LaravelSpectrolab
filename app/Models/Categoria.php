<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Categoria
 * 
 * @property int $id
 * @property int $cod_ref
 * @property string $cat_ref
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Insumo[] $insumos
 *
 * @package App\Models
 */
class Categoria extends Model
{
	protected $table = 'categorias';

	protected $casts = [
		'cod_ref' => 'int'
	];

	protected $fillable = [
		'cod_ref',
		'cat_ref'
	];

	public function insumo()
	{
		return $this->hasMany(Insumo::class);
	}
}
