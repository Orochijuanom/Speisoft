<?php namespace App\Observers;

use App\Services\AuditClass;


class ModelObserver{

	public function saving($model){
		
		return True;

	}

	public function saved($model){

		$audit = new AuditClass();

		$audit->audit($model, 'Saved');

		return True;
		
	}

	public function updating($model){

		return True;

	}

	public function updated($model){

		$audit = new AuditClass();

		$audit->audit($model, 'Updated');
		
		return True;

	}

	public function deleted($model){

		$audit = new AuditClass();

		$audit->audit($model, 'Deleted');
		
		return True;


	}


}

