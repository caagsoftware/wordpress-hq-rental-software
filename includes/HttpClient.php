<?php

/*
 * Http Client Class for Api Requests
 */
class HttpClient
{
	private $data;
	private $tenant;
	private $user;
	private $final_token;

	function __construct()
	{
		$this->data = array();
		$this->tenant = get_caag_rental_tenant_token();
		$this->user = get_caag_rental_user_token();
		$this->final_token = base64_encode($this->tenant . ':' . $this->user);
	}

	/*
	 * Http Get Request
	 */
	public function get($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization: Basic '.$this->final_token
		));

		if(curl_error($ch)){
			echo 'error:' . curl_error($ch);
		}
		if(curl_exec($ch) === false){
			echo 'Curl error: ' . curl_error($ch);
		}else{
			$data = curl_exec($ch);
		}
		curl_close($ch);
		$this->data = json_decode($data);
		return $this->data;
	}

}
