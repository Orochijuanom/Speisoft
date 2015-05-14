<?php namespace App\Services;

use App\Audit;
use Auth;
use App\Services\GetClientIp;

class AuditClass{

	private $attributes;
	private $table;
	private $ip;

	public function audit($model, $action){

		foreach ($model->getAttributes() as $attribute) {
			
			$this->attributes .= ' '.$attribute;

		}

		$this->table = $model->getTable();
		
		$ip = new GetClientIp();

		$this->ip = $ip->get_client_ip_server();


		Audit::create(
			[
				'action' => $action.' ||| '.$this->attributes,
				'model' => $this->table,
				'user_id' => Auth::user()->id,
				'fecha' => date('Y-m-d H:i:s'),
				'ip' => $this->ip
			]);


		return True;

	}

}