<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller
{
	/**
	 * 
	 * 用户中心首页
	 * 
	 * 提供用户中心首页的逻辑层
	 * 
	 * @author johnnyEven
	 * @version Pulse user/index.php - 1.0.1.20130129 09:50
	 */
	
	private $user;
	private $rootPath;
	private $pageName = 'user_index';
	
	public function __construct()
	{
		parent::__construct();
		$this->rootPath = $this->config->item('root_path');
		
		$this->load->model('utils/check_user', 'check');
		$this->user = $this->check->validate();
	}
	
	public function index()
	{
		$this->load->model('account');
	}
}
?>