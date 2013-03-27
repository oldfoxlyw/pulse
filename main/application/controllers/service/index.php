<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller
{
	/**
	 * 
	 * 客服中心首页
	 * 
	 * 客服中心首页
	 * 
	 * @author johnnyEven
	 * @version Pulse service/index.php - 1.0.1.20130327 14:55
	 */
	
	private $user;
	private $rootPath;
	private $pageName = 'service/index';
	
	public function __construct()
	{
		parent::__construct();
		$this->rootPath = $this->config->item('root_path');
		
		$this->load->model('utils/check_user', 'check');
		$this->user = $this->check->validate();
	}
	
	public function index()
	{

	}
}