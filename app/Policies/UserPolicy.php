<?php

namespace App\Policies;

use App\Http\Models\Account\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
	use HandlesAuthorization;

	/**
	 * Create a new policy instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	public function isAdmin(): bool
	{
		return (auth()->user()->rol === 'admin')? true : false;
	}

	// end class
}
