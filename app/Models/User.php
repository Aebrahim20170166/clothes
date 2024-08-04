<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string|null $image
 * @property string $username
 * @property int $role_id
 * @property string|null $address
 * @property string|null $phone
 * @property int|null $status
 * @property string|null $wallet_number
 *
 * @property Role $role
 * @property Collection|Cart[] $carts
 * @property Collection|Favourite[] $favourites
 * @property Collection|Product[] $products
 * @property Collection|Review[] $reviews
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
	protected $table = 'users';
	public $timestamps = false;

	protected $casts = [
		'role_id' => 'int',
		'status' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'email',
		'password',
		'image',
		'username',
		'role_id',
		'address',
		'phone',
		'status',
		'wallet_number',
        'token',
        'device_token'
	];

	public function role()
	{
		return $this->belongsTo(Role::class);
	}

	public function carts()
	{
		return $this->hasMany(Cart::class, 'customer_id');
	}

	public function favourites()
	{
		return $this->hasMany(Favourite::class, 'customer_id');
	}

	public function products()
	{
		return $this->hasMany(Product::class, 'admin_id');
	}

	public function reviews()
	{
		return $this->hasMany(Review::class, 'reviewer');
	}
}
