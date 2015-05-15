<?php namespace App\Listeners;

use App\Events\Audit;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

use App\Services\AuditClass;

class AuditHandler {

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
	 * @param  Audit  $event
	 * @return void
	 */
	public function handle(Audit $event)
	{
		
		$audit = new AuditClass();

		$audit->audit($event->model, $event->action);
		
		return True;

	}

}
