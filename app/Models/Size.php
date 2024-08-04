<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Size
 *
 * @property int $id
 * @property int $size
 * @property string $size-name
 *
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class Size extends Model
{
	protected $table = 'sizes';
	public $timestamps = false;

	protected $casts = [
		'size' => 'int'
	];

	protected $fillable = [
		'size',
		'name'
	];

	public function products()
	{
		return $this->hasMany(Product::class, 'size');
	}
}
