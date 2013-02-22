<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sync extends CI_Controller
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
	private $pageName = 'utils/sync';
	
	public function __construct()
	{
		parent::__construct();
		$this->rootPath = $this->config->item('root_path');
		
		$this->load->helper('url');
	}
	
	public function sync_login()
	{
		$redirect = $this->input->get_post('redirect');
		$redirect = empty($redirect) ? 'user/index' : $redirect;

		$this->load->model('utils/check_user', 'check');
		$user = $this->check->validate();

 		$this->load->library('UcenterSync');
 		$result = $this->ucentersync->syncLogin($user->ucenter_uid);
		
 		$parameter = array(
 			'redirect'			=>	$redirect,
 			'sync_script'		=>	$result
 		);
		$this->load->view($this->pageName, $parameter);
	}
	
	public function sync_logout()
	{
		$redirect = $this->input->get_post('redirect');
		$redirect = empty($redirect) ? 'index' : $redirect;

 		$this->load->library('UcenterSync');
 		$result = $this->ucentersync->syncLogout();
		
 		$parameter = array(
 			'redirect'			=>	$redirect,
 			'sync_script'		=>	$result
 		);
		$this->load->view($this->pageName, $parameter);
	}
}
?>