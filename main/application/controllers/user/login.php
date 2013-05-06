<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
	/**
	 * 
	 * 用户中心登录页面
	 * 
	 * 提供用户中心登录验证与登出的逻辑层
	 * 
	 * @author johnnyEven
	 * @version Pulse user/login.php - 1.0.1.20130129 10:08
	 */
	private $rootPath;
	private $pageName = 'user/login';
	
	public function __construct()
	{
		parent::__construct();
		$this->rootPath = $this->config->item('root_path');
		
		$this->load->helper('url');
	}
	
	public function index()
	{
		$redirectUrl = $this->input->get('redirect', TRUE);

		$this->load->model('utils/check_user', 'check');
		$user = $this->check->validate(false);
		if(!empty($user))
		{
			if(!empty($redirectUrl))
			{
				redirect(urldecode($redirectUrl));
			}
			else
			{
				redirect('/user/index');
			}
		}
		else
		{
			$this->load->view($this->pageName);
		}
	}
	
	public function submit()
	{
		$redirectUrl = $this->input->post('redirect', TRUE);
		$accountName = $this->input->post('accountName', TRUE);
		$accountPass = $this->input->post('accountPass', TRUE);
		$cookieRemain = $this->input->post('cookieRemain', TRUE);
		$isAjaxRequest = $this->input->post('isAjaxRequest', TRUE);
		
		if(!empty($accountName) && !empty($accountPass))
		{
			$this->load->model('account');
			$this->load->model('utils/logs');
			$this->load->helper('security');
			
			$parameter = array(
				'account_name'		=>	$accountName,
				'account_pass'		=>	encrypt_pass($accountPass)
			);
			$result = $this->account->read($parameter);
			
			if($result === FALSE)
			{
				$this->logs->write(array(
					'log_type'	=>	'USER_INVALID',
					'user_name'	=>	$accountName
				));
				showMessage(MESSAGE_TYPE_ERROR, 'USER_INVALID', '', 'user/login?redirect=' . $redirectUrl, true, 5);
			}
			else
			{
				$row = $result[0];
				$cookie = array(
					'account_id'	=>		$row->account_id,
					'account_name'	=>		$accountName,
					'uid'			=>		$row->ucenter_uid
				);
				$cookieStr = json_encode($cookie);
				$this->load->helper('ucenter_sync');
				$cookieStr = _authcode($cookieStr, 'ENCODE');
	
				$this->load->helper('cookie');
				$cookie = array(
						'name'		=> 'user',
						'value'		=> $cookieStr,
						'expire'	=> $this->config->item('cookie_expire'),
						'domain'	=> $this->config->item('cookie_domain'),
						'path'		=> $this->config->item('cookie_path'),
						'prefix'	=> $this->config->item('cookie_prefix')
				);
				if($cookieRemain=='1') {
					$cookie['expire'] = strval(intval($this->config->item('cookie_expire')) * 30);
				}
	            $this->input->set_cookie($cookie);
	            
	            $this->account->update($row->account_id, array(
	            	'account_lastlogin'	=>	time()
	            ));
				$this->logs->write(array(
					'log_type'		=>	'USER_LOGIN',
					'user_name'	=>	$accountName
				));
				
				if($isAjaxRequest == '1') {
					$parameter = array(
						'message'		=>	'USER_LOGIN',
						'user'				=>	$row
					);
					echo json_encode($parameter);
				} else {
					$redirectUrl = empty($redirectUrl) ? 'user/index' : $redirectUrl;
					showSyncLogin($redirectUrl);
// 					showMessage(MESSAGE_TYPE_SUCCESS, 'USER_LOGIN_SUCCESS', $result, $redirectUrl, true, 5);
				}
			}
		}
		else
		{
			showMessage(MESSAGE_TYPE_ERROR, 'USER_LOGIN_ERROR_NO_PARAM', '', 'user/login?redirect=' . $redirectUrl, true, 5);
		}
	}
	
	public function out()
	{
		$this->load->helper('cookie');
		
		$cookie = array(
			'name'		=> 'user',
			'domain'	=> $this->config->item('cookie_domain'),
			'path'		=> $this->config->item('cookie_path'),
			'prefix'	=> $this->config->item('cookie_prefix')
		);
		delete_cookie($cookie);
		
// 		$this->load->library('UcenterSync');
// 		$result = $this->ucentersync->syncLogout();
		
		showSyncLogout('index');
// 		showMessage(MESSAGE_TYPE_SUCCESS, 'USER_LOGOUT', $result, 'index', true, 5);
	}
}
?>