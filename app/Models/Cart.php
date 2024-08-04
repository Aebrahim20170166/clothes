<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cart
 * 
 * @property int $id
 * @property int $product_id
 * @property int $customer_id
 * @property int $quantity
 * 
 * @property User $user
 * @property Product $product
 *
 * @package App\Models
 */
class Cart extends Model
{
	protected $table = 'carts';
	public $timestamps = false;

	protected $casts = [
		'product_id' => 'int',
		'customer_id' => 'int',
		'quantity' => 'int'
	];

	protected $fillable = [
		'product_id',
		'customer_id',
		'quantity'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'customer_id');
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
