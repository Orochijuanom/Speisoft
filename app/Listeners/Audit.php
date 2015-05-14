<?php namespace App\Listeners;

use App\Events\Create;
use App\Events\Update;

use App\Services\AuditClass;

class Audit {

	public function Create($event){

		$audit = new AuditClass();

		$audit->audit($event->model, 'Se ha creado un registro');
		
		return True;

	}

	public function Update($event){

		dd($event->model);
		
		return True;

	}

	public function subscribe($events){

		$events->listen(
			'App\Events\Create',
			'App\Listeners\Audit@Create'
			);

		$events->listen(
			'App\Events\Update',
			'App\Listeners\Audit@Update'
			);

	}

}
