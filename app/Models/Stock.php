<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Stock
 * 
 * @property int $id
 * @property int $product_id
 * @property int $quantity
 * 
 * @property Product $product
 *
 * @package App\Models
 */
class Stock extends Model
{
	protected $table = 'stocks';
	public $timestamps = false;

	protected $casts = [
		'product_id' => 'int',
		'quantity' => 'int'
	];

	protected $fillable = [
		'product_id',
		'quantity'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
