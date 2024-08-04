<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Story
 * 
 * @property int $id
 * @property string $name
 * @property int $product_id
 * 
 * @property Product $product
 * @property Collection|StoryImage[] $story_images
 *
 * @package App\Models
 */
class Story extends Model
{
	protected $table = 'stories';
	public $timestamps = false;

	protected $casts = [
		'product_id' => 'int'
	];

	protected $fillable = [
		'name',
		'product_id'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function story_images()
	{
		return $this->hasMany(StoryImage::class);
	}
}
