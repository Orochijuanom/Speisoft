<?php namespace App\Observers;

use App\Services\AuditClass;


class ModelObserver{


	public function updating($model){
		
		return True;

	}

	public function updated($model){

		return True;
		
	}

	public function creating($model){

		return True;

	}

	public function created($model){

		return True;
	}

	public function deleted($model){

		return True;

	}


}

