<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bind_email extends CI_Controller
{
	/**
	 * 
	 * 修改个人资料
	 * 
	 * 提供修改个人资料的逻辑层
	 * 
	 * @author johnnyEven
	 * @version Pulse user/change_profile.php - 1.0.1.20130129 09:50
	 */
	
	private $user;
	private $rootPath;
	private $pageName = 'user/bind_email';
	
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
	
	public function submit()
	{
		$accountEmail = $this->input->post('accountEmail', TRUE);
	}
}
?>