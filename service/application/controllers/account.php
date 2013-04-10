<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller
{
	/**
	 * 
	 * 用户平台帐户相关操作
	 * 
	 * @author johnnyEven
	 * @version Pulse/service account.php - 1.0.1.20130409 10:52
	 */
	private $rootPath;
	
	public function __construct()
	{
		parent::__construct();
		$this->rootPath = $this->config->item('root_path');
		
		$this->load->helper('url');
	}
	
	public function login($format = 'json')
	{
		$userName = $this->input->post('userName', TRUE);
		$userPass = $this->input->post('userPass', TRUE);


		if(!empty($userName) && !empty($userPass))
		{
			$this->load->model('maccount');
			$this->load->model('utils/logs');
			$this->load->helper('security');
			
			$parameter = array(
				'account_name'		=>	$userName,
				'account_pass'		=>	encrypt_pass($userPass)
			);
			$result = $this->maccount->read($parameter);
			
			if($result === FALSE)
			{
				// $this->logs->write(array(
				// 	'log_type'		=>	'USER_INVALID',
				// 	'user_name'	=>	$accountName
				// ));
				$parameter = array(
					'errors'	=>	'ACCOUNT_LOGIN_FAIL'
				);
				echo $this->return_format->format($parameter, $format);
			}
			else
			{
				$row = $result[0];
	            $this->maccount->update($row->account_id, array(
	            	'account_lastlogin'	=>	time()
	            ));
				// $this->logs->write(array(
				// 	'log_type'		=>	'USER_LOGIN',
				// 	'user_name'	=>	$accountName
				// ));
				$parameter = array(
					'message'		=>	'ACCOUNT_LOGIN_SUCCESS',
					'accountId'		=>	$row->account_id
				);
				echo $this->return_format->format($parameter, $format);
			}
		}
		else
		{
			$parameter = array(
				'errors'	=>	'ACCOUNT_LOGIN_ERROR_NO_PARAM'
			);
			echo $this->return_format->format($parameter, $format);
		}
	}

	public function register($format = 'json')
	{
		$userName = $this->input->post('userName', TRUE);
		$userPass = $this->input->post('userPass', TRUE);


		if(!empty($userName) && !empty($userPass))
		{
			$this->load->model('maccount');
			$this->load->helper('security');

			$result = $this->maccount->read(array(
				'account_name'	=>	$userName
			));
			if(!empty($result))
			{
				$parameter = array(
					'errors'	=>	'ACCOUNT_CHECK_ERROR_DUPLICATE'
				);
				echo $this->return_format->format($parameter, $format);
			}
			else
			{
				$parameter = array(
					'account_name'		=>	$userName,
					'account_pass'		=>	encrypt_pass($userPass),
					'account_regtime'	=>	time(),
				);
				$accountId = $this->maccount->create($parameter);

				$parameter = array(
					'message'	=>	'ACCOUNT_REGISTER_SUCCESS',
					'accountId'	=>	$accountId
				);
				echo $this->return_format->format($parameter, $format);
			}
		}
		else
		{
			$parameter = array(
				'errors'	=>	'ACCOUNT_REGISTER_ERROR_NO_PARAM'
			);
			echo $this->return_format->format($parameter, $format);
		}
	}

	public function check_duplicate($format = 'json')
	{
		$userName = $this->input->post('userName', TRUE);

		if(!empty($userName))
		{
			$this->load->model('maccount');
			
			$result = $this->maccount->read(array(
				'account_name'	=>	$userName
			));
			if(!empty($result))
			{
				$parameter = array(
					'errors'	=>	'ACCOUNT_CHECK_ERROR_DUPLICATE'
				);
				echo $this->return_format->format($parameter, $format);
			}
			else
			{
				$parameter = array(
					'message'	=>	'ACCOUNT_CHECK_SUCCESS'
				);
				echo $this->return_format->format($parameter, $format);
			}
		}
		else
		{
			$parameter = array(
				'errors'	=>	'ACCOUNT_CHECK_ERROR_NO_PARAM'
			);
			echo $this->return_format->format($parameter, $format);
		}
	}
}
?>