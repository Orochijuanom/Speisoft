<?php namespace App\Services;

class GetClientIp{

	private $ipaddress;

	function get_client_ip_server() {

	    
	    
	    if (getenv('HTTP_CLIENT_IP'))

	        $this->ipaddress = getenv('HTTP_CLIENT_IP');

	    else if(getenv('HTTP_X_FORWARDED_FOR'))

	        $this->ipaddress = getenv('HTTP_X_FORWARDED_FOR');

	    else if(getenv('HTTP_X_FORWARDED'))

	        $this->ipaddress = getenv('HTTP_X_FORWARDED');

	    else if(getenv('HTTP_FORWARDED_FOR'))

	        $this->ipaddress = getenv('HTTP_FORWARDED_FOR');

	    else if(getenv('HTTP_FORWARDED'))

	        $this->ipaddress = getenv('HTTP_FORWARDED');

	    else if(getenv('REMOTE_ADDR'))

	        $this->ipaddress = getenv('REMOTE_ADDR');

	    else

	        $this->ipaddress = 'UNKNOWN';

	 
	    return $this->ipaddress;

	}

}