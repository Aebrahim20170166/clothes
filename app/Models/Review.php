<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Review
 * 
 * @property int $id
 * @property string $review
 * @property int $product_id
 * @property int $num_stars
 * @property int $reviewer
 * 
 * @property Product $product
 * @property User $user
 *
 * @package App\Models
 */
class Review extends Model
{
	protected $table = 'reviews';
	public $timestamps = false;

	protected $casts = [
		'product_id' => 'int',
		'num_stars' => 'int',
		'reviewer' => 'int'
	];

	protected $fillable = [
		'review',
		'product_id',
		'num_stars',
		'reviewer'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'reviewer');
	}
}
