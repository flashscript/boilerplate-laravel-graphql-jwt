<?php

namespace App\Http\Models\Account;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable implements JWTSubject
{
	use Notifiable;

	protected $fillable = [
		'email', 
		'password', 
	], 
	// $guarded = [
		// 'rol'
	// ],
	$hidden = [
		'password', 
		'remember_token', 
		// 'rol',
	], 
	$casts = [
		'email_verified_at' => 'datetime',
	];

	 /**
	 * Get the identifier that will be stored in the subject claim of the JWT.
	 *
	 * @return mixed
	 */
	public function getJWTIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Return a key value array, containing any custom claims to be added to the JWT.
	 *
	 * @return array
	 */
	public function getJWTCustomClaims()
	{
		return [
				// 'rol' => $this->rol,
		];
	}

	// public function setPasswordAttribute($pass) {
	//     return $this->attribute['password'] = bcrypt($pass);
	// }

		// end class
}
