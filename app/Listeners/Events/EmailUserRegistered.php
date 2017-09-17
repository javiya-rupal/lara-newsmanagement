<?php namespace App\Handlers\Events;

use App\Events\UserRegistered;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class EmailUserRegistered {
	protected $user;

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  UserRegistered  $event
	 * @return void
	 */
	public function handle(UserRegistered $event)
	{
	    $regUser = $event->user;
		\Mail::send('emails.registration', ['username' => $regUser->name, 'email' => $regUser->email,
            'verification_code' => $regUser->verification_code], function($message) use($regUser)
		{
		    $message->to($regUser->email, $regUser->name)->subject('Welcome! Confirm your account with crossover');
		});
	}

}
