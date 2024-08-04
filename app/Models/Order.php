<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * 
 * @property int $id
 * @property int $customer_id
 * @property int $status
 * @property int $total_price
 * 
 * @property Collection|OrderDetail[] $order_details
 *
 * @package App\Models
 */
class Order extends Model
{
	protected $table = 'orders';
	public $timestamps = false;

	protected $casts = [
		'customer_id' => 'int',
		'status' => 'int',
		'total_price' => 'int'
	];

	protected $fillable = [
		'customer_id',
		'status',
		'total_price'
	];

	public function order_details()
	{
		return $this->hasMany(OrderDetail::class);
	}
}
