<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class logs extends CI_Model {
	private $logTable = 'pulse_log';
	
	public function __construct() {
		parent::__construct();
	}
	
	public function write($parameter) {
		if(!empty($parameter) && !empty($parameter['log_type'])) {
			$relativePage      =	$this->input->server('REQUEST_URI');
			$relativeMethod    =	$this->input->server('REQUEST_METHOD');
			$relativeParameter =	json_encode($_REQUEST);
			$currentTime       =	date("Y-m-d H:i:s", time());
			
			$currentUser = empty($parameter['user_name']) ? '' : $parameter['user_name'];
			$row = array(
				'log_type'         =>	$parameter['log_type'],
				'log_account_name' =>	$currentUser,
				'log_uri'          =>	$relativePage,
				'log_method'       =>	$relativeMethod,
				'log_parameter'    =>	$relativeParameter,
				'log_time_local'   =>	$currentTime,
				'partner'			=>	$parameter['partner']
			);
			$this->db->insert($this->logTable, $row);
		}
	}

	public function write_account($parameter)
	{
		if(!empty($parameter['account_id']) && !empty($parameter['role_id']) &&
			!empty($parameter['product_id']) && !empty($parameter['server_id']) &&
			is_numeric($parameter['action_type']))
		{
			$parameter['log_time'] = time();
			$parameter['log_ip'] = $this->input->post('ip');
			if(empty($parameter['log_ip']))
			{
				$parameter['log_ip'] = $this->input->ip_address();
			}

			$db = $this->database->load('logdb', TRUE);
			$db->insert('log_account_role', $parameter);
		}
	}
}
?>