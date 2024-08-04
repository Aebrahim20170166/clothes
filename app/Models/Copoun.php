<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Copoun
 * 
 * @property int $id
 * @property string $code
 * @property int $product_id
 * @property Carbon $expire_at
 * @property int|null $times
 * 
 * @property Product $product
 *
 * @package App\Models
 */
class Copoun extends Model
{
	protected $table = 'copouns';
	public $timestamps = false;

	protected $casts = [
		'product_id' => 'int',
		'expire_at' => 'datetime',
		'times' => 'int'
	];

	protected $fillable = [
		'code',
		'product_id',
		'expire_at',
		'times'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
