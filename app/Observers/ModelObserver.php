<?php namespace App\Observers;

use App\Services\AuditClass;


class ModelObserver{

	public function saving($model){
		
		return True;

	}

	public function saved($model){

		$audit = new AuditClass();

		$audit->audit($model);

		return True;
		
	}

	public function updating($model){

		return True;

	}

	public function updated($model){

		$audit = new AuditClass();

		$audit->audit($model);
		
		return True;

	}

	public function deleted($model){

		$audit = new AuditClass();

		$audit->audit($model);
		
		return True;


	}


}

