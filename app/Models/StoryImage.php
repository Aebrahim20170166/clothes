<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StoryImage
 * 
 * @property int $id
 * @property int $story_id
 * @property string $image
 * 
 * @property Story $story
 *
 * @package App\Models
 */
class StoryImage extends Model
{
	protected $table = 'story_images';
	public $timestamps = false;

	protected $casts = [
		'story_id' => 'int'
	];

	protected $fillable = [
		'story_id',
		'image'
	];

	public function story()
	{
		return $this->belongsTo(Story::class);
	}
}
