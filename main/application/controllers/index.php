<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller
{
	/**
	 * 
	 * 首页
	 * 
	 * 提供首页的逻辑层
	 * 
	 * @author Administrator
	 * @version Pulse index.php - 1.0.1.20130123 17:21
	 */
	private $rootPath;
	private $pageName = 'index';
	
	public function __construct()
	{
		parent::__construct();
		$this->rootPath = $this->config->item('root_path');
	}
	
	public function index()
	{
		
	}
}