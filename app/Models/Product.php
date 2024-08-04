<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $price_before
 * @property int|null $num_stars
 * @property int|null $price_after
 * @property int $color
 * @property int $size
 * @property int $category_id
 * @property int $admin_id
 *
 * @property Category $category
 * @property User $user
 * @property Collection|Cart[] $carts
 * @property Collection|Copoun[] $copouns
 * @property Collection|Favourite[] $favourites
 * @property Collection|OrderDetail[] $order_details
 * @property Collection|ProductImage[] $product_images
 * @property Collection|Review[] $reviews
 * @property Collection|Stock[] $stocks
 * @property Collection|Story[] $stories
 *
 * @package App\Models
 */
class Product extends Model
{
	protected $table = 'products';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'description',
		'price_before',
		'color_id',
		'size_id',
		'category_id',
		'admin_id',
        "quantity",
        "image"
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function color()
	{
		return $this->belongsTo(Color::class);
	}

	public function size()
	{
		return $this->belongsTo(Size::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function carts()
	{
		return $this->hasMany(Cart::class);
	}

	public function copouns()
	{
		return $this->hasMany(Copoun::class);
	}

	public function favourites()
	{
		return $this->hasMany(Favourite::class);
	}

	public function order_details()
	{
		return $this->hasMany(OrderDetail::class);
	}

	public function product_images()
	{
		return $this->hasMany(ProductImage::class);
	}

	public function reviews()
	{
		return $this->hasMany(Review::class);
	}

	public function stocks()
	{
		return $this->hasMany(Stock::class);
	}

	public function stories()
	{
		return $this->hasMany(Story::class);
	}
}
