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
	private $pageName = 'user/index';
	
	public function __construct()
	{
		parent::__construct();
		$this->rootPath = $this->config->item('root_path');
		
		$this->load->model('utils/check_user', 'check');
		$this->user = $this->check->validate();
	}
	
	public function index()
	{
		var_dump($this->user);
		$this->load->model('feed');
		
		$feedResult = $this->feed->read(array(
			'account_id'	=>	$this->user->account_id
		), array(
			'orderby'		=>	array(
				'feed_time',
				'desc'
			)
		), 1);
		
		//检查安全等级
		$securityLevel = 0;
		if(!empty($this->user->account_email))
		{
			$securityLevel += 1;
		}
		if(!empty($this->user->account_mobile))
		{
			$securityLevel += 1;
		}
		
		//资料完整度
		$profileLevel = 0;
		if(!empty($this->user->account_nickname))
		{
			$profileLevel += 1;
		}
		if(!empty($this->user->account_birthday))
		{
			$profileLevel += 1;
		}
		if(!empty($this->user->account_country))
		{
			$profileLevel += 1;
		}
		if(!empty($this->user->account_city))
		{
			$profileLevel += 1;
		}
		if(!empty($this->user->account_job))
		{
			$profileLevel += 1;
		}
		$profileLevel = ($profileLevel / 5) * 100;
	}
}
?>