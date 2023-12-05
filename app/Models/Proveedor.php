<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Proveedor
 * 
 * @property int $id
 * @property string|null $ciudad
 * @property string|null $correo
 * @property string|null $direccion
 * @property string $nombre
 * @property string|null $telefono
 * @property string|null $fax
 * @property int $nit
 * @property string|null $persona_contacto
 * @property string $productos
 * @property string|null $representante
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Compra[] $compras
 *
 * @package App\Models
 */
class Proveedor extends Model
{
	protected $table = 'proveedores';

	protected $casts = [
		'nit' => 'int'
	];

	protected $fillable = [
		'ciudad',
		'correo',
		'direccion',
		'nombre',
		'telefono',
		'fax',
		'nit',
		'persona_contacto',
		'productos',
		'representante'
	];

	protected $rules = [
        'nombre' => 'required|string|min:3',
        'nit' => 'required|integer|',
        'productos' => 'required|string',
        // 'ciudad' => 'nullable|string',
        // 'correo' => 'nullable|email',
        // 'direccion' => 'nullable|string',
        // 'telefono' => 'nullable|string',
        // 'fax' => 'nullable|string',
        // 'persona_contacto' => 'nullable|string',
        // 'representante' => 'nullable|string',
        
        // otras reglas de validación...
    ];

	public function compra()
	{
		return $this->hasMany(Compra::class, 'proveedor_id');
	}
}
