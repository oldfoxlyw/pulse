<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Network
{
	public function Network()
	{

	}

	public function post($url, $data)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$output = curl_exec($ch);
		curl_close($ch);

		return $output;
	}
}

?>