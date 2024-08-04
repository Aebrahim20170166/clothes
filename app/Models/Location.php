<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Location
 * 
 * @property int $id
 * @property string $governorate
 * @property string $city
 * @property string $street_name
 * @property string $home_number
 * @property string $additional_info
 *
 * @package App\Models
 */
class Location extends Model
{
	protected $table = 'locations';
	public $timestamps = false;

	protected $fillable = [
		'governorate',
		'city',
		'street_name',
		'home_number',
		'additional_info'
	];
}
