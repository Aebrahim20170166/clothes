<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Favourite
 * 
 * @property int $id
 * @property int $customer_id
 * @property int $product_id
 * 
 * @property User $user
 * @property Product $product
 *
 * @package App\Models
 */
class Favourite extends Model
{
	protected $table = 'favourites';
	public $timestamps = false;

	protected $casts = [
		'customer_id' => 'int',
		'product_id' => 'int'
	];

	protected $fillable = [
		'customer_id',
		'product_id'
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
