<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class Update extends Event {

	use SerializesModels;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */

	public $model;

	public function __construct($model)
	{
		
		$this->model = $model;

	}

}
