<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CancelingReason
 * 
 * @property int $id
 * @property string $reason
 *
 * @package App\Models
 */
class CancelingReason extends Model
{
	protected $table = 'canceling_reasons';
	public $timestamps = false;

	protected $fillable = [
		'reason'
	];
}
