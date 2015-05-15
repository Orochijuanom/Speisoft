<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class Audit extends Event {

	use SerializesModels;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */

	public $model;
	public $action;

	public function __construct($model, $action)
	{
	
		$this->model = $model;
		$this->action = $action;
	}

}
