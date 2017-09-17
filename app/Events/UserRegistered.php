<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class UserRegistered extends Event {

	use SerializesModels;
	
	public $userObject;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($userObject)
	{
		$this->user = $userObject;
	}

}
