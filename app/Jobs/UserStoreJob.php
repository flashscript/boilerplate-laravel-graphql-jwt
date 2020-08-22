<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Requests\UserStoreRequest;
use App\Http\Models\Account\User;

class UserStoreJob implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	private $email, $password;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct(UserStoreRequest $request)
	{
		$this->email = strtolower($request->email);
		$this->password = bcrypt($request->password);
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		return User::create([
			'email' => $this->email,
			'password' => $this->password,
		]);
	}
}
