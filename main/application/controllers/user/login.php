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
	private $pageName = 'user_login';
	
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
				'account_pass'		=>	do_hash(do_hash($accountPass, 'md5'))
			);
			$result = $this->account->read($parameter);
			
			if(result === FALSE)
			{
				$this->logs->write(array(
					'log_type'		=>	'USER_INVALID',
					'user_name'	=>	$accountName
				));
				$redirect = urlencode($this->rootPath . 'user/login?redirect=' . $redirectUrl);
				redirect("/message?info=USER_INVALID&redirect={$redirect}");
			}
			else
			{
				$row = $result[0];
				$checkCode = do_hash(do_hash($accountName . '#' . $row->account_pass, 'md5'));
				$cookie = array(
					'account_id'		=>		$row->account_id,
					'account_name'	=>		$accountName,
					'check_code'		=>		$checkCode
				);
				$cookieStr = json_encode($cookie);
	
				$this->load->helper('cookie');
				$cookie = array(
						'name'		=> 'user',
						'value'		=> $cookieStr,
						'expire'		=> $this->config->item('cookie_expire'),
						'domain'	=> $this->config->item('cookie_domain'),
						'path'		=> $this->config->item('cookie_path'),
						'prefix'		=> $this->config->item('cookie_prefix')
				);
				if($cookieRemain=='1') {
					$cookie['expire'] = $this->config->item('cookie_expire') * 30;
				}
	            $this->input->set_cookie($cookie);
	            
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
	            	redirect('/user/index');
				}
			}
		}
		else
		{
			$redirect = urlencode($this->rootPath . 'user/login?redirect=' . $redirectUrl);
			redirect("/message?info=USER_LOGIN_ERROR_NO_PARAM&redirect={$redirect}&auto_redirect=1&auto_delay=5");
		}
	}
}
?>